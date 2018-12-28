<?php
session_start();
if (!isset($_SESSION['id']) ||
    !isset($_SESSION['pseudo']) ||
    !isset($_SESSION['mail']))
{
  header('Location: index.php');
}
require("scripts/bdd_connection.php");
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
			<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
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

			# Display the wishlists of the current user
            $request = $pdo->prepare('SELECT id, name FROM wishlist WHERE user_id = ?');
            $request->execute(array($_SESSION['id']));
            echo "- Mes listes de souhaits :<ul>";
            while ($row = $request->fetch())
            {
                echo "<li><a href='wishlist/show.php?id=" . $row['id'] . "'>" . $row['name'] . "</a></li>";
            }
            echo "</ul><form action='wishlist/new.php'><input id='new_wishlist_button' type='submit' value='>> Créer une nouvelle liste de souhait <<' /></form></p>";
			$request->closeCursor();

			# Display the wishlists of the other users
            $request = $pdo->prepare('SELECT wishlist.id, pseudo, name FROM wishlist INNER JOIN user ON user.id = wishlist.user_id WHERE user_id != ?');
            $request->execute(array($_SESSION['id']));
            echo "- Les listes de souhaits des autres utilisateurs :<ul>";
            while ($row = $request->fetch())
            {
                echo "<li><a href='wishlist/show.php?id=" . $row['id'] . "'>" . $row['name'] . "</a> de " . $row['pseudo'] . "</li>";
            }
            echo "</ul>";
            $request->closeCursor();
            ?>
		</section>
	</body>
</html>

<!-- THIS IS THE END -->