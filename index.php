<?php
	session_start();
	$langue="";

					//verifie si la langue est changée
					if(isset($_REQUEST["langue"]))
					{	// passée le choix langue à la variable $langue
						$langue = $_REQUEST["langue"];
						
						//création du cookie
						setcookie("langue", $langue, time() + (60 * 60 * 24 * 365));
						
					}
					else
					{	//si le cookie existe deja
						if(isset($_COOKIE["langue"]))
						{    //lance la langue du cookie
							$langue = $_COOKIE["langue"];						
						}
						
					}
	require_once("FonctionsDB.php");
	require_once("fonctionblog.php");
?>
<html lang=fr>
<link rel="stylesheet" href="assets/css/styles.css">
<link rel="stylesheet" href="css/monStyle.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/hmtl; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Affiche Articles</title>

<body>

<div class="container">
			<div class="header">
				<h1 class="header-heading">Art Busters</h1>
			</div>
			<div class="nav-bar">
				
			</div>
			<div class="content">
				<div class="main">

					<h1>BLOG</h1>
					<hr>
		<form method="GET">
			<?php echo traduction($langue,"textLanguage")?>
			<select name="langue" onchange="submit(this.form)">
				<option value="francais"<?php if($langue=="francais") echo "selected=selected";?>>Fr
				</option>
				<option value="anglais"<?php if($langue=="anglais") echo "selected=selected";?>>En
				</option>
			</select> <br/>
		</form>
		<?php 
			if(isset($_SESSION["authentifie"]))
			{ 
		?>		<br/><div class="conteneur">
						<div id="greetings">
								<i class="fa fa-user fa-2x" aria-hidden="true"></i><?php echo traduction($langue,"textGreetings")." ".$_SESSION["authentifie"]; ?>
						</div>
					</div>	
		
				<div class="aGauche"><br/><a href="index.php?action=logout"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i><?php echo traduction($langue,"textLogout");?></a></div>
		<?php	
			}
			else
			{
		?>
				<a href="index.php?action=afficheLoginPage"><?php echo traduction($langue,"textLogin");?></a>
		<?php	
			}
		?>
	
	<body>

		<?php
			$action = "";
			
			//aller chercher le paramètre action
			if(isset($_REQUEST["action"]))
				$action = $_REQUEST["action"];
			
			//structure d'un controleur
			switch($action)
			{	
			//-----------POUR L'AFFICHAGE DU FORMULAIRE d'AJOUT----//
				case "AfficheformInsertArticle":
					//afficher le formulaire d'ajout
					require_once("vues/CreationArticle.php");
				break;
			//-----------POUR L'AFFICHAGE DU FORMULAIRE DE MODIFICATION---------// 
				case "AfficheformModifieArticle":
					//verifie qu'un id d'article est passé en paramettre
					if(isset($_REQUEST["idArticle"]))
					{   //saissi l'auteur autentifié
						$auteur=$_SESSION["authentifie"];
						//va chercher l'article dans la base de donne
						$donnees = getUnArticle($_REQUEST["idArticle"],$auteur);
						require_once("vues/ModifieArticle.php");
					}
					
				break;
			//-----------POUR L'AFFICHAGE DES MOTS CLES----//
				case "AfficheListeMostcles":
					//afficher les mots-cles
					$donnees=getAllMotscles();
					require_once("vues/afficheMotscles.php");
				break;
			//-----------POUR L'AFFICHAGE DES  ARTICLES LIES À UN MOT-CLE----//
				case "afficheTousArticlesMotcle":
				//verifie qu'un mot clé est passé en paramettre
					if(isset($_REQUEST["mots_cles"]))
					{
						//va recuperer dans la base de donnees tous les articles associés a ce mots
						$donneesMotscles=getMotcleAllArticles($_REQUEST["mots_cles"]);
						//ressaisi tous les mots clé pour les reafficher
						$donnees=getAllMotscles();
						require_once("vues/afficheMotscles.php");
					}else{
						$donnees=getAllMotscles();
						require_once("vues/afficheMotscles.php");
					}
				break;
				
			//-----------POUR L'AFFICHAGE DU FORMULAIRE LOGIN IN----//
				case "afficheLoginPage":
				if(!isset($_SESSION["grainDeSel"]))
					{        //crée la session
							$_SESSION["grainDeSel"] = rand(1, 10000);
					}
					//afficher le formulaire d'ajout
					require_once("vues/LoginPage.php");
				break;
			//-------------------POUR LOGIN USAGER-----------------//	
				case "autentification":
					//verifie l'existance de la session si non 
					
					//verifie que le nom usager et mot de passe ont ete saissi
					if(isset($_POST["username"]) && isset($_POST["password"]))
					{
							//saissi le mot de pass dans la base de données				
						$motDePasseMD5 = MotDePasse($_POST["username"]);
						//applique l'encryptage MD5
						$motDePasseGrainSel = md5($motDePasseMD5 . $_SESSION["grainDeSel"]);
						if($motDePasseGrainSel == $_POST["password"])
						{
							//echo "esta autentificado";
							$_SESSION["authentifie"] = $_POST["username"];
							header("Location: index.php");
						}
						else
							//affiche une erreur de login si l'autentification n'est pas un succes
							$message = "<br/><div class='notification'>".traduction($langue,"ErrorLogin")."</div>";
							echo $message;
					}
						require_once("vues/LoginPage.php");	
				break;
			//-----------POUR LE LOG OUT DE LA SESSION-----------//
				case "logout":
					//afficher le formulaire d'ajout
					if(isset($_SESSION["authentifie"]))
					{
						session_destroy();
						header("Location: index.php");
					}
				break;
			//-----------POUR L'INSERTION D'ARTICLE------------// 
				case "InsertArticle":
					//verifie que les champs sont remplis
					if(isset($_REQUEST["titre_anglais"]) && isset($_REQUEST["titre_francais"])&& isset($_REQUEST["texte_anglais"])&& isset($_REQUEST["texte_francais"])&& isset($_SESSION["authentifie"]))
					{	
						$titre_anglais=$_REQUEST["titre_anglais"]; 
						$titre_francais=$_REQUEST["titre_francais"];
						$texte_anglais=$_REQUEST["texte_anglais"];
						$texte_francais=$_REQUEST["texte_francais"];
						//verification que aucun champs n'est vide
						if($titre_anglais!=="" && $titre_francais !=="" && $texte_anglais !=="" && $texte_francais !=="")
						{
							//insertion d'articles
							insertArticle($titre_anglais,$titre_francais,$texte_anglais,$texte_francais,$_SESSION["authentifie"]);
							//recuper Id du texte
							$idArticle=mysqli_insert_id($connexion);
								echo"<br/><div class='notification'>".traduction($langue,"messageArticleInsert_2")."</div>";
								
							//verifie qu'un mot-cle est passé en paramettre
							if(isset($_REQUEST["mots_cles"]))
							{
								$mots_cles=$_REQUEST["mots_cles"];
								//verifie que le champs n'est pas vide
								if($mots_cles!==""){
									//slipt sur les mots passés en paramettre
									$tabMotsCles= explode("&", $_REQUEST["mots_cles"]);
									//boucle sur chaque mot-clé et verifie qu'il nest pas dans la base de données
									foreach($tabMotsCles As $nouveauMot)
									{
										$donnees=getUnMotscle($nouveauMot);								
										$resultatMoscles=mysqli_fetch_assoc($donnees);//cherche le mot dans la base de donneée
										//si le resultat de la recherche ne retourne aucune rangée 
										if($resultatMoscles<=0)
										{
											//insert le mot-cle dans la base de donné
											insertMotcles($nouveauMot);		
											$idMotscles=mysqli_insert_id($connexion);
											insertArticle_motscles($idArticle,$idMotscles);// fait le lien entre le mot-clé et l'article
										}
										else
										{
											//si non, recuper l' Id du mots-cle
											$idMotscles=$resultatMoscles["idMotscles"];
											//$erreurMotcles=traduction($_SESSION["langagueUsager"],"errKeyword");
											echo "<br/><u>".$nouveauMot."</u> ".traduction($langue,"messageKeyWordInsert_2");
											insertArticle_motscles($idArticle,$idMotscles);// fait le lien entre le mot-clé et l'article	
										}
									}
								}
								//si non affiche un message
								else
								{
									////affiche ce message
									echo"<br/><div class='notification'>".traduction($langue,"messageKeyWordInsert_1")."</div>";
								}
							}	
						}
						// si il y a un champs vide affiche un message
						else
						{
							echo"<br/><div class='notification'>".traduction($langue,"messageArticleInsert_1")."</div>";
							//affiche la vue creation article
							require_once("vues/CreationArticle.php");
						}
					}
				break;
			//-----------POUR LA MODIFICATION D'ARTICLE------------// 
				case "modifieArticle":
				//verifie que les valeur de modification sont passée en paramettre
					if(isset($_REQUEST["idArticle"]) && isset($_REQUEST["titre_anglais"]) && isset($_REQUEST["titre_francais"])&& isset($_REQUEST["texte_anglais"])&&isset($_REQUEST["texte_francais"])/*&& isset($_REQUEST["auteur"])*/)
					{
						//modifie l'article
						modifieArticle($_REQUEST["idArticle"],$_REQUEST["titre_anglais"], $_REQUEST["titre_francais"], $_REQUEST["texte_anglais"],$_REQUEST["texte_francais"]);
						//$idArticle=mysqli_insert_id($connexion);
						echo"<br/>".traduction($langue,"messageArticleModify_1")." ".$_REQUEST["idArticle"]." ".traduction($langue,"messageArticleModify_2")."<a href='index.php?action=afficheFormArticles'>".traduction($langue,"articlePage")."</a>";
					}	
				break;
			//-----------POUR L'AFFICHAGE DES ARTICLES--------//
				case "afficheFormArticles":							
				default:
				
					//aller vers la page par défaut - affiche les articles
					$donnees = getAllArticles();
					//$langue="";
					
						//verifie si une selection de langue est faite
					
					//afficher la liste
					require_once("vues/AfficheArticles.php");
					//require_once("Fonctionblog.php");

				break;		
			}
		?>
		<div class="footer">
				&copy; Copyright 2016
			</div>
		</div>


	</form>
</div>
</body>
</html>