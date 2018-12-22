<?php
session_start();
if (!isset($_SESSION['id']) ||
    !isset($_SESSION['pseudo']) ||
    !isset($_SESSION['mail']))
{
  header('Location: index.php');
}
require("bdd_connection.php");
?>

<!-- Auteur : Antoine Couprie -->

<!-- START -->

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="Antoine COUPRIE" />
		<meta name="copyleft" content="Antoine COUPRIE - 2018" />
		<meta name="description" content="Site de partage de liste de souhait de Noël" />
		<meta name="keywords" content="noël christmas liste souhait wish list" />
		<meta name="viewport" content="width=device-width, user-scalable=no"/>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="scripts/style.css">
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<title>My Wishlists</title>
	</head>
	<body>
		<header>
			<nav>
				<ul id="onglets">
					<li><a href="index.php">Accueil</a></li>
					<li><a href="wishlists.php" class="current">Listes de souhait</a></li>
					<li><a href="users/disconnect.php">Disconnect</a></li>
				</ul>
			</nav>
		</header>

		<section class="mainSection">
            <?php
            echo "<span class=tabulation /> Bienvenue " . $_SESSION['pseudo'] . " !</span><p>";
            $request = $pdo->prepare('SELECT name FROM wishlist WHERE user_id = ?');
            $request->execute(array($_SESSION['id']));
            echo "Mes listes de souhaits :<ul>";
            while ($row = $request->fetch())
            {
                echo "<li>" . $row['name'] . "</li>";
            }
            $request->closeCursor();
            echo "</ul><form action='wishlist/new.php'><input id='new_wishlist_button' type='submit' value='>> Créer une nouvelle liste de souhait <<' /></form></p>";
            $request = $pdo->prepare('SELECT pseudo, name FROM wishlist INNER JOIN user ON user.id = wishlist.user_id WHERE user_id != ?');
            $request->execute(array($_SESSION['id']));
            echo "Les listes de souhaits des autres utilisateurs :<ul>";
            while ($row = $request->fetch())
            {
                echo "<li>" . $row['name'] . " de " . $row['pseudo'] . "</li>";
            }
            $request->closeCursor();
            echo "</ul>";
            ?>
		</section>
	</body>
</html>

<!-- THIS IS THE END -->