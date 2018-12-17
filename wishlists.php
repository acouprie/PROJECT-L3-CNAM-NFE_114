<?php
session_start();
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
		<meta name="viewport"	 content="width=device-width, user-scalable=no"/>
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
					<li><a href="disconnect.php">Disconnect</a></li>
				</ul>
			</nav>

		</header>

		<section class="mainSection">
        <?php
            echo "<span class=tabulation /> Bienvenue " . $_SESSION['pseudo'];
        ?>
        <br />
        <br />
        Mes listes de souhaits :
        <?php
        $request = $pdo->prepare('SELECT name FROM wishlist WHERE user_id = ?');
        $request->execute(array($_SESSION['id']));
        echo "<ul>";
        while ($donnees = $request->fetch())
        {
        ?>
            <li>
                <?php echo $donnees['name']; ?>
            </li>
        <?php
        }
        $request->closeCursor();
        ?>
        </ul>
        <br />
        Les listes de souhaits des autres utilisateurs :
        <?php
        $request = $pdo->prepare('SELECT pseudo, name FROM wishlist INNER JOIN user ON user.id = wishlist.user_id WHERE user_id != ?');
        $request->execute(array($_SESSION['id']));
        echo "<ul>";
        while ($donnees = $request->fetch())
        {
        ?>
            <li>
                <?php echo $donnees['pseudo']; ?>
                <br />
                <?php echo $donnees['name']; ?>
            </li>
        <?php
        }
        $request->closeCursor();
        ?>
        </ul>
        <br />

		</section>

		<!-- aside left list example -->
		<aside class="asideG">
        <a href="my_wishlist/new">Créer une liste de souhait</a>
		</aside>

		<!-- aside right sites marchands -->
		<aside class="asideD">

		</aside>

	</body>

</html>

<!-- THIS IS THE END -->
