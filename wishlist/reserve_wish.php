<?php
require("../scripts/bdd_connection.php");
session_start();
# Reserve a wish by a user
if ($_GET['action'] == 'reserve')
{
    $request = $pdo->prepare('UPDATE wish SET reserved_by = :reserved_by WHERE ID = :id');
    $request->execute(array(
        'reserved_by' => $_SESSION['id'],
        'id' => $_GET['wish_id']
        ));
    echo "reserved!";
}
# Remove reservation of a wish by a user
elseif ($_GET['action'] == 'remove')
{
    $request = $pdo->prepare('UPDATE wish SET reserved_by = NULL WHERE ID = :id');
    $request->execute(array(
        'id' => $_GET['wish_id']
        ));
    echo "Dismiss !";
}
?>