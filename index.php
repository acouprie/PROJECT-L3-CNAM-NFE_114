<?php
# handle parameter GET login=false
if(isset($_GET['login']) && $_GET['login'] == 'false')
{
    echo "Mauvais e-mail et/ou mot de passe";
}
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript" src="scripts/extand_aside.js"></script>

		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<title>My Christmas Wishlist</title>

	</head>

	<body>
		<header>

			<nav>
				<ul id="onglets">
					<li><a href="index.php" class="current">Accueil</a></li>
					<li><a href="users/register.php">S'enregistrer</a></li>
				</ul>
                <div class="login">
                    <form action="users/login.php" method="post">
                        email : <input type="text" name="mail" autofocus required />
                        mot de passe : <input type="password" name="password" required />
                        <input type="submit" value="Connexion" />
                    </form>
                </div>
			</nav>

		</header>

		<div>

		<!-- aside left list example -->
		<aside id="asideLeft">

           <img src="images/list-example.png" id="wishlist-example" alt="wishlist-example"/>

		</aside>

		<!-- central top image -->
		<div id="banner">
			<div class="content">
				<img src="images/santa_rodolf.jpg" class="banniere" alt="banniere"/>
			</div>
		</div>

		<!-- aside right sites marchands -->
		<aside id="asideRight">

            Sites marchands :<br />
            <br />
            <a href="https://www.amazon.fr/"><img src="images/amazon.png" alt="amazon"></a>
            <a href="https://www.cdiscount.com/"><img src="images/cdiscount.jpg" alt="cdiscount"></a>
            <br />
            <a href="https://fr.shopping.rakuten.com/"><img src="images/priceminister.png" alt="priceminister"></a>
            <a href="https://www.rueducommerce.fr/"><img src="images/ruecommerce.png" alt="rue du commerce"></a>
            <br />
            <a href="https://www.fnac.com/"><img src="images/fnac.png" alt="fnac"></a>
            <a href="https://www.boulanger.com/"><img src="images/boulanger.png" alt="boulanger"></a>
            <br />
		</aside>
		</div>


		<!-- central bottom presentation -->
		<section class="mainSection">

			<h1><span class=tabulation /></span>Qui sommes-nous ?</h1>
            <p>
                <span class=tabulation /></span>Nous sommes une start-up avec une idée révolutionnaire : créer un site web où chacun pourra y déposer sa liste de souhait de cadeaux de Noël, les autres utilisateurs n'auront qu'à choisir dans la liste un cadeau à offrir et seront avertis si une idée est prise ce qui évitera d'offrir plusieurs fois le même cadeau.<br />
                <span class=tabulation /></span>Une idée révolutionnaire on vous dit, connectez vous sans attendre !
            </p>

		</section>
	</body>

</html>

<!-- THIS IS THE END -->
