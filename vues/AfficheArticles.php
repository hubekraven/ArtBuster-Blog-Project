
<form name="Affichearticle" method="GET" action="index.php?action=afficheArticle.php">
<?php
if (isset($_SESSION["authentifie"]))

{
	//affiche le lien creation d'article si l'usager est autentifié
?>	
<a href="index.php?action=AfficheformInsertArticle"><?php echo traduction($langue,"articleCreate")?></a>
<?php	
}
?>


<div class="center">

<a href="index.php?action=AfficheListeMostcles"><?php echo traduction($langue,"textKeyWord")?></a><br/>    
<?php
	//---------------AFFICHAGE DES ARTICLES SELON LA LANGUE-------------------//
	//boucle de lecture de la table resultat de la requete
	//affiche les articles selon le choix de la langue de l'utilisateur
	while($rangee =  mysqli_fetch_assoc($donnees))
	{
		if($langue=="anglais"){
?>		
			<article>
				<br/>
				<h3><?php echo traduction($langue,"articleTitle")?>
					<?php echo $rangee["titre_anglais"]; ?></h3>
					<?php 
					//---------------AFFICHAGE DU LIEN MODIFICATION DES ARTICLES (ANGLAIS)-------------------//
					//verifie que la session usager est initié 
						if (isset($_SESSION["authentifie"])&& ($_SESSION["authentifie"]==$rangee["username"]))
						{
						//et affiche le lien de modification pour les articles de l'usager connecté
						?>
							
							<!--input type="hidden" name="idArticle" method="GET" value="<?//php echo $_SESSION["Article"];?>"/-->
							<a href="index.php?action=AfficheformModifieArticle&idArticle=<?php echo $rangee["idArticle"]?>"><?php echo traduction($langue,"articleModify")?></a>
							
						<?php
								
						}
						?>
				<p id="texte"><?php echo $rangee["texte_anglais"]; ?></p><br/>

<?php
		}else{
?>
			<article>
				<br/>
				<h3><?php echo traduction($langue,"articleTitle")?>
					<?php echo $rangee["titre_francais"]; ?></h3>
					<?php 
					//---------------AFFICHAGE DU LIEN MODIFICATION DES ARTICLES (FRANÇAIS)-------------------//
					//verifie que la session usager est initié et affiche le lien de modification pour les articles de l'usager connecté
					if (isset($_SESSION["authentifie"])&& ($_SESSION["authentifie"]==$rangee["username"]))
					{
						//et affiche le lien de modification pour les articles de l'usager connecté
					?>
						<input type="hidden" name="idArticle" method="GET" value="<?php echo $rangee["idArticle"];?>"/>
						<a href="index.php?action=AfficheformModifieArticle&idArticle=<?php echo $rangee["idArticle"]?>">
							<?php echo traduction($langue,"articleModify")?></a>
					<?php
							
					}
					?>
				<p id="texte"><?php echo $rangee["texte_francais"];?></p><br/>

<?php
		    }		
?>
				<b><?php echo traduction($langue,"articleAutor")?></b>
				<i><?php echo $rangee["prenom"]." ".$rangee["nom"]; ?></i><br/>
				<b><?php echo traduction($langue,"textKeyWord")?></b>
				<?php 
					//---------------AFFICHAGE DES MOTS-CLÉS-------------------	//
						$ListeMocle=getArticleMotscles($rangee["idArticle"]);//recuper tout les mocles associés à l' article
					while($LesMots =  mysqli_fetch_assoc($ListeMocle))
					{
						echo '<i>-'.$LesMots["mots_cles"].'</i>';//affiche chaque mot-clé
					}
				?>
				<hr><br/>
			</article>
<?php	
	}
?>    
    <!--/fieldset-->
</div>

</form>
