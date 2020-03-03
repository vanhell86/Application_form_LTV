<?php


use App\Models\User;
use Core\AuthManager;
use Core\Database;
use Core\FlashMessage;
use Core\Managers\ErrorManager\ErrorsManager;
use Core\Managers\InputManager\InputManager;
use Core\Validation;


function view(string $path, array $vars = [])       // return view files
{
    extract($vars);
    include(__DIR__ . '/app/Views/' . $path . '.php');
}

function config(string $key, string $defaultValue = ''): string     // getting config info
{
    $defaultValue = !empty($defaultValue) ? $defaultValue : $key;   // if empty then key
    [$fileName, $configKey] = explode('.', $key, 2);    //spliting key in two parts
    $config = include __DIR__ . '/config/' . $fileName . '.php';    //including neccessary config file

    return $config[$configKey] ?? $defaultValue;//return config value or defaultValue
}


