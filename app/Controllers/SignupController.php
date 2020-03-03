<?php

namespace App\Controllers;


class SignupController
{

    public function showSignUpForm()
    {
        return view('signup');      //returning view for signup form
    }

    public function saveToJson()        // method for validating form and saving data to json
    {
        $name = $_POST['name'];
        $birthDate = $_POST['birthDate'];

        if (empty($name)) {                                 //validating name field
            $msg = 'The Full name field must be filled';
            $_SESSION['errors'][] = $msg;
        }
        if ( $this->validateAge($birthDate)) {      //validating birthDate field
            $msg = 'You must be over 18 ';
            $_SESSION['errors'][] = $msg;
        }
        if (isset($_FILES["file"])) {                   // validating uploaded file

            $fileName = $_FILES["file"]["name"];                // getting file info
            $fileTmpName = $_FILES["file"]["tmp_name"];
            $fileSize = $_FILES["file"]["size"];
            $fileError = $_FILES["file"]["error"];
            $fileType = $_FILES["file"]["type"];

            $newFileName = time() . '_' . $fileName;        // creating new unique file name

            $allowed = array('image/jpeg', 'image/png');            //allowed image types

            if (in_array($fileType, $allowed)) {        // if allowed type image
                //Image code
                if ($fileError === 0) {                             //no upload errors
                    if ($fileSize < 5000000) {                      // checking image size

                        $fileDestination = 'uploads/' . $newFileName;      //path where to save image
                        if (!file_exists('uploads/')) {           // create folder if not exist
                            mkdir('uploads/', 0777, true);
                        }

                        move_uploaded_file($fileTmpName, $fileDestination); // move uploaded file
                                                                                                // to chosen dir
                        $file = "data.json";
                        $arr = array(                       // preparing data for json file
                            'full_name' => $name,
                            'birthday' => $birthDate,
                            'image_path' => $fileDestination
                        );
                        $json_string = json_encode($arr);   // creating json string
                        file_put_contents($file, $json_string); // save json to file

                    } else {
                        $msg = "Your file is too big!";
                        $_SESSION['errors'][] = $msg;           // writing error to session
                    }
                } else {
                    $msg = "There was an error while uploading your file!";
                    $_SESSION['errors'][] = $msg;
                }
            } else {

                if ($fileError == 4) {                          // upload errors
                    $msg = "You haven't uploaded any file";
                } else {
                    $msg = "Supported image types are jpeg and png";
                }
                $_SESSION['errors'][] = $msg;
            }
        }

        if (isset($_SESSION['errors'])) {   // check if there are errors
            return view('signup');
        }
       return view('displayJSON', ['user_data' => json_decode($json_string, true)]);// return
                                                                                //view with json as array
    }

    private function validateAge(string $then): bool        // function for validating age
    {
        // $then will first be a string-date
        $then = strtotime($then);
        //The age to be over, over +18
        $min = strtotime('+18 years', $then);
        return (time() < $min) || empty($then);
    }
}