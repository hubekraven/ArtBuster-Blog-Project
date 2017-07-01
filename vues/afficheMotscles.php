

<?php 
	if(isset($_SESSION["authentifie"]))
	{
		//affiche ce lien si l'usager est autentifié
	?>
		
		<i class="fa fa-hand-o-left" aria-hidden="true"></i><a href="index.php?action=afficheFormArticles"><?php echo traduction($langue,"articlePage")?></a>
		<a href="index.php?action=AfficheformInsertArticle"><?php echo traduction($langue,"articleCreate")?></a><br/>
<?php
	} 
?>

<br/><br/>
<h2><?php echo traduction($langue,"textKeyWord");?></h2>
<form name="afficheMoscles" method="GET" action="index.php?action=afficheMotscles.php">
<div class="center">
    <!--fieldset-->
    
<?php
	//---------------AFFICHAGE DE TOUS MOTS-CLES & DES ARTICLES SELON LE MOTS-CLES-------------------//
	//boucle de lecture de la table resultat de la requete
	//affiche la liste de tous les mots_cles
	while($rangee =  mysqli_fetch_assoc($donnees))
	{?>
		<br/><a href="index.php?action=afficheTousArticlesMotcle&mots_cles=<?php echo $rangee["mots_cles"];?>"><?php echo $rangee["mots_cles"];?></a>
<?php	
	}
	if(isset($donneesMotscles))
	{
		while($rangeeArticle = mysqli_fetch_assoc($donneesMotscles))
		{
			if($rangeeArticle!==null){
				if($langue=="anglais")
				{?>
					</article>
						<br/>
						<h1><?php echo traduction($langue,"articleTitle")?>
							<?php echo $rangeeArticle["titre_anglais"]; ?></h1>
							<p id="texte"><?php echo $rangeeArticle["texte_anglais"];?></p><br/>
							<b><?php echo traduction($langue,"articleAutor")?></b>
							<i><?php echo $rangeeArticle["prenom"]." ".$rangeeArticle["nom"]; ?></i><br/>
							
					<article>
										
		<?php	
				}
				else
				{?>
					<article>
						<br/>
						<h1><?php echo traduction($langue,"articleTitle")?>
							<?php echo $rangeeArticle["titre_francais"]; ?></h1>
							<p id="texte"><?php echo $rangeeArticle["texte_francais"];?></p><br/>
							<b><?php echo traduction($langue,"articleAutor")?></b>
							<i><?php echo $rangeeArticle["prenom"]." ".$rangeeArticle["nom"]; ?></i><br/>
					</article>
										
		<?php
				}?>
				<i class="fa fa-hand-o-left" aria-hidden="true"></i><a href="index.php?action=AfficheListeMostcles"><?php echo traduction($langue,"textKeyWord")?></a>
				<hr><br/>
<?php
			}
		}
	}?>
    <!--/fieldset-->
</div>

</form>
