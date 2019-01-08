<?php
session_start();
if (!isset($_SESSION['id']) ||
    !isset($_SESSION['pseudo']) ||
    !isset($_SESSION['mail']))
{
  header('Location: ../index.php');
}
require("../scripts/bdd_connection.php");
require("./new.html");

# Default error message
function DisplayError()
{
    echo "Une erreur est survenue, veuillez rééssayer. <br />
          Si l'erreur persiste, contactez l'administrateur à admin@example.com";
}

# Validate the Wishlist name and size
function ValidateName($name) {
    if (isset($name) && preg_match("/^[a-z A-Z0-9_.-]{2,32}$/",$name))
    {
        return true;
    }
    else
    {
        echo "Le nom doit faire entre 2 et 32 caractères et ne comporter que des lettres, espaces, chiffres et _.-";
        exit();
    }
}

# Validate the wish name and size
function ValidateWish($wish) {
    if (isset($wish) && preg_match("/^[a-z A-Z0-9_.-]{2,128}$/",$wish))
    {
        return true;
    }
    else
    {
        return false;
    }
}

# Extract wishes from form to an array
function extractWishes()
{
    $next_wish = true;
    $wishes = [];
    $i = 1;
    while ($next_wish)
    {
        $wish = $_POST['wish_' . $i];
        if (isset($wish))
        {
            if (validateWish($wish) == true)
            {
                $wishes[] = $wish;
            }
            else
            {
                echo $wish . " est invalide. Il doit faire entre 2 et 128 caractères et ne comporter que des lettres, espaces, chiffres et _.-";
                exit();
            }
        }
        else
        {
            $next_wish = false;
        }
        $i++;
    }
    return $wishes;
}

# Save wishes one by one
function saveWish($wishlist_id)
{
    global $pdo;
    $wishes = extractWishes();
    $arrlength = count($wishes);
    for($x = 0; $x < $arrlength; $x++) {
        $request = $pdo->prepare('INSERT INTO wish(name, wishlist_id) VALUES(:name, :wishlist_id)');
        $request->execute(array(
            'name' => $wishes[$x],
            'wishlist_id' => $wishlist_id
        ));
    }
}

function saveWishlist()
{
    global $pdo;
    $request = $pdo->prepare('INSERT INTO wishlist(user_id, name) VALUES(:user_id, :name)');
    $request->execute(array($_SESSION['id'], $_POST['name']));
    $wishlist_id = $request->fetch()['id'];
    $request->closeCursor();
    $request = $pdo->prepare('SELECT id FROM wishlist WHERE user_id = ? AND name = ? LIMIT 1');
    $request->execute(array($_SESSION['id'], $_POST['name']));
    $wishlist_id = $request->fetch()['id'];
    $request->closeCursor();
    saveWish($wishlist_id);
    header('Location: ../wishlists.php');
}

# Validate form
function ValidateFields($name)
{
    if (ValidateName($name))
    {
        return true;
    }
    else
    {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
    ValidateFields ($_POST['name']))
{
    try
    {
        saveWishlist();
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
        echo "Si l'erreur persiste, contactez l'administrateur à admin@example.com";
    }
    exit();
}
?>
