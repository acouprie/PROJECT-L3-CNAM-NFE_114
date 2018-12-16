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

		<title>My Christmas Wishlist</title>

	</head>

	<body>
		<header>

			<?php
				if(isset($_GET['login']) && $_GET['login'] == 'false')
				{
        			echo "Mauvais e-mail et/ou mot de passe";
				}
			?>
			<nav>
				<ul id="onglets">
					<li><a href="index.php" class="current">Accueil</a></li>
				</ul>
                <div class="login">
                    <form action="register.php">
                        <input type="submit" value="S'enregistrer" />
                    </form>
                </div>
                <div class="login">
                    <form action="login.php" method="post">
                        email : <input type="text" name="mail" autofocus required />
                        mot de passe : <input type="password" name="password" required />
                        <input type="submit" value="Connexion" />
                    </form>
                </div>
			</nav>

		</header>

		<!-- central top image -->
		<div id="sectiona">
			<img src="images/santa_rodolf.jpg" class="banniere" alt="banniere"/>
		</div>


		<!-- central bottom presentation -->
		<section class="mainSection">

			<h1><span class=tabulation></span>Qui sommes-nous ?</h1>
            <p>
                <span class=tabulation></span>Nous sommes une start-up avec une idée révolutionnaire : créer un site web où chacun pourra y déposer sa liste de souhait de cadeaux de Noël, les autres utilisateurs n'auront qu'à choisir dans la liste un cadeau à offrir et seront avertis si une idée est prise ce qui évitera d'offrir plusieurs fois le même cadeau.<br />
                <span class=tabulation></span>Une idée révolutionnaire on vous dit, connectez vous sans attendre !
            </p>

		</section>

		<!-- aside left list example -->
		<aside class="asideG">

            <span class=tabulation>* Ma super liste *<br />
    		<ul id="wishlist-example">
                <li><input type="checkbox" name="poney" />Un poney</li>
                <li><input type="checkbox" name="sabre" checked />Un sabre laser</li>
                <li><input type="checkbox" name="poupée" checked />Une maison de poupée</li>
                <li><input type="checkbox" name="amour" />L'amour</li>
                <li><input type="checkbox" name="jet" checked />Un jet privé</li>
                <li><input type="checkbox" name="poulpe" checked />Un poulpe</li>
    		</ul>

		</aside>

		<!-- aside right sites marchands -->
		<aside class="asideD">

            Sites marchands :<br />
            <br />
            <a href="http://www.amazon.fr"><img src="images/amazon.png" alt="amazon">
            <a href="http://www.cdiscount.com"><img src="images/cdiscount.jpg" alt="cdiscount">
            <br />
            <a href="http://www.priceminister.fr"><img src="images/priceminister.png" alt="priceminister">
            <a href="http://www.rueducommerce.fr"><img src="images/ruecommerce.png" alt="rue du commerce">
            <br />
            <a href="http://www.fnac.fr"><img src="images/fnac.png" alt="fnac">
            <a href="http://www.boulanger.com"><img src="images/boulanger.png" alt="boulanger">
            <br />
		</aside>

	</body>

</html>

<!-- THIS IS THE END -->