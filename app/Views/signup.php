<?php view('layouts/header'); ?>

    <div class="container">

        <?php if (isset($_SESSION['errors'])): ?><!--  displaying errrors     -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <ul class="alert alert-warning text-lg-center">
                    <?php

                    foreach ($_SESSION['errors'] as $msg) {
                        echo "<li>" . $msg . "</li>" . PHP_EOL;
                    }
                    unset($_SESSION['errors']);
                    ?>
                </ul>
            </div>
        </div>
        <?php endif ?>
        <div class="card">
            <div class="card-header"><?php echo "SignUp form" ?> </div>

            <div class="card-body">
                <form id="app" action="/" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Full name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="birthDate" class="col-2 col-form-label">Date of birth</label>
                        <div class="col-10">
                            <input class="form-control" type="date" id="birthDate" name="birthDate">
                        </div>
                    </div>

                    <div class="custom-file">
                        <input type="file" id="file" name="file">
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <button type="submit" name="submit" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php view('layouts/footer'); ?>