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

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript" src="../scripts/reserve_wish.js"></script>

		<!--[if lt IE 9]>
			<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<title>Liste <?php $_GET['id'] ?></title>
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

			# Get the name of the wishlist
            $wishlist_name = $pdo->prepare('SELECT name FROM wishlist WHERE wishlist.id = ?');
			$wishlist_name->execute(array($wishlist_id));
			echo $wishlist_name->fetch()['name'];
			$wishlist_name->closeCursor();

			# Get the wishes of the wishlist
            $request = $pdo->prepare('SELECT wish.id, wish.name, wishlist.user_id, wish.reserved_by, user.pseudo FROM wish INNER JOIN wishlist ON wish.wishlist_id = wishlist.id LEFT JOIN user ON wish.reserved_by = user.id WHERE wish.wishlist_id = ?');
			$request->execute(array($wishlist_id));
			echo "<ul>";
			# Loop into the wishes
            while ($row = $request->fetch())
            {
				# if wishlist belongs to current user
				if ($row['user_id'] == $_SESSION['id'])
				{
					echo "<li>".$row['name']."</li>";
				}
				# else if it is reserved by a user
				elseif (isset($row['reserved_by']))
				{
					# if it is reserved by current user
					if ($row['reserved_by'] == $_SESSION['id'])
					{
						echo "<li id='list_".$row['id']."'>".$row['name']."<span class='tabulation' /><input id='checkbox_".$row['id']."' type='checkbox' checked='checked' onclick=\"reserve_wish('remove','".$_SESSION['pseudo']."','".$row['name']."',".$row['id'].");\" />Reservé par vous";
					}
					else
					{
						echo "<li id='list_".$row['id']."'>".$row['name']."<span class='tabulation' /><input id='checkbox_".$row['id']."' type='checkbox' checked='checked' disabled='disabled' />Reservé par ".$row['pseudo'];
					}
				}
				# Permit reservation of a wish
				else
				{
					echo "<li id='list_".$row['id']."'>".$row['name']."<span class='tabulation' /><input type='checkbox' onclick=\"reserve_wish('reserve','".$_SESSION['pseudo']."','".$row['name']."',".$row['id'].");\"/>Réservez le !</li>";
				}
            }
            echo "</ul>";
            $request->closeCursor();
            ?>
		</section>
		<br />
	</body>
</html>

<!-- THIS IS THE END -->

