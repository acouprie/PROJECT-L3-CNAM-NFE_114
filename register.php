<?php
require("bdd_connection.php");
require("register.html");

function DisplayError()
{
    echo "Une erreur est survenue, veuillez rééssayer. <br />
          Si l'erreur persiste, contactez l'administrateur à admin@example.com";
}

function ValidateMail($mail)
{
    if (isset($mail) &&
        filter_var($mail, FILTER_VALIDATE_EMAIL))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function ValidatePseudo($pseudo) {
    if (isset($pseudo) &&
        preg_match("/^[a-zA-Z]*$/",$pseudo) &&
        strlen($pseudo) > 5 &&
        strlen($pseudo) < 33)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function ValidatePassword($pwd, $conf_pwd)
{
    if (isset($pwd) &&
        isset($conf_pwd) &&
        $pwd == $conf_pwd &&
        strlen($pwd) > 5 &&
        strlen($pwd) < 33)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function UserExist($mail)
{
    global $pdo;
    $request = $pdo->prepare('SELECT id FROM user WHERE mail = ? LIMIT 1');
    $request->execute(array($mail));
    $count = $request->rowCount();
    if($count > 0) {
        return true;
    }
    else
    {
        return false;
    }
}

function processRegistration($mail, $pseudo, $pwd)
{
    global $pdo;
    $hash = password_hash($pwd, PASSWORD_DEFAULT);
    $request = $pdo->prepare('INSERT INTO user(pseudo, mail, password) VALUES(:pseudo, :mail, :password)');
    $request->execute(array(
        'pseudo' => $pseudo,
        'mail' => $mail,
        'password' => $hash
        ));
}

function ValidateFields($mail, $pseudo, $pwd, $conf_pwd)
{
    if (ValidateMail($mail) &&
        ValidatePseudo($pseudo) &&
        ValidatePassword($pwd, $conf_pwd) &&
        !UserExist($mail)
    )
    {
        return true;
    }
    else
    {
        DisplayError();
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    ValidateFields ($_POST['mail'],
                    $_POST['pseudo'],
                    $_POST['password'],
                    $_POST['conf_password']))
{
    processRegistration($_POST['mail'],
                        $_POST['pseudo'],
                        $_POST['password']);
    header('Location: index.php');
    exit();
}
?>
