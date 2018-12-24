<?php
session_start();
if (!isset($_SESSION['id']) ||
    !isset($_SESSION['pseudo']) ||
    !isset($_SESSION['mail']))
{
  header('Location: ../index.php');
}
require("../bdd_connection.php");
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
		<meta name="viewport"	 content="width=device-width, user-scalable=no"/>
		<meta charset="utf-8" />

		<link rel="stylesheet" href="../scripts/style.css">

		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<title>Nouvelle liste de souhait</title>
	</head>

	<body>
		<header>
			<nav>
				<ul id="onglets">
					<li><a href="../index.php">Accueil</a></li>
					<li><a href="../wishlists.php">Les listes</a></li>
					<li><a href="../users/disconnect.php">Disconnect</a></li>
				</ul>
			</nav>
		</header>

		<section class="mainSection">
            <?php
            $wishlist_id = $_GET['id'];
            $request = $pdo->prepare('SELECT wishlist.name, wish.name FROM wishlist INNER JOIN wish ON wish.wishlist_id = wishlist.id WHERE wish.wishlist_id = ?');
            $request->execute(array($wishlist_id));
            echo "<ul>";
            while ($row = $request->fetch())
            {
                echo "<li>" . $row['name'] . "</li>";
            }
            echo "</ul>";
            $request->closeCursor();
            ?>
		</section>
		<br />
	</body>
</html>

<!-- THIS IS THE END -->

