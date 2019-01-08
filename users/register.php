<?php
require("../scripts/bdd_connection.php");
require("./register.html");

function ValidateMail($mail)
{
    if (isset($mail) &&
        filter_var($mail, FILTER_VALIDATE_EMAIL))
    {
        return true;
    }
    else
    {
        echo "Erreur relative à l'e-mail. ";
        exit();
    }
}

function ValidatePseudo($pseudo) {
    if (isset($pseudo) && preg_match("/^[a-z A-Z0-9_.-]*$/",$pseudo))
    {
        return true;
    }
    else
    {
        echo "Erreur relative au pseudonyme. ";
        exit();
    }
}

function ValidatePassword($pwd, $conf_pwd)
{
    if (isset($pwd) &&
        isset($conf_pwd) &&
        $pwd == $conf_pwd &&
        preg_match("/^[a-zA-Z0-9!@#\$%\^\&*+=_-]{6,32}$/",$pwd))
    {
        return true;
    }
    else
    {
        echo "Erreur relative au mot de passe. ";
        exit();
    }
}

# Check if a user exist
function UserExist($mail)
{
    global $pdo;
    $request = $pdo->prepare('SELECT id FROM user WHERE mail = ? LIMIT 1');
    $request->execute(array($mail));
    $count = $request->rowCount();
    if($count > 0) {
        echo "L'utilisateur existe déjà";
        exit();
    }
    else
    {
        return false;
    }
}

# Register a new user
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
    header('Location: ../index.php');
}

# Check the data from the form
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
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    ValidateFields ($_POST['mail'],
                    $_POST['pseudo'],
                    $_POST['password'],
                    $_POST['conf_password']))
{
    try
    {
        processRegistration($_POST['mail'],
                            $_POST['pseudo'],
                            $_POST['password']);
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
        echo "Si l'erreur persiste, contactez l'administrateur à admin@example.com";
    }
    exit();
}
?>
