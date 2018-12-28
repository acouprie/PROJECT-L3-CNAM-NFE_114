<?php
# Set up the DB connection assigned to $pdo
try
{
    $pdo = new PDO('mysql:host=localhost;dbname=christmas;charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>
