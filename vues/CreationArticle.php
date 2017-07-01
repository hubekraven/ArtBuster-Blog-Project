<h1  class="Titre"><?php echo traduction($langue,"textCreateForm");?></h1>

<br/><br/>
<?php 
	if(isset($_SESSION["authentifie"]))
	{
		//affiche ce lien si l'usager est autentifié
	?>
		
		<i class="fa fa-hand-o-left" aria-hidden="true"></i><a href="index.php?action=afficheFormArticles"><?php echo traduction($langue,"articlePage")?></a>
		<br/><br/><br/>
<?php
	} 
?>

<form action="" method="POST">

	<?php echo traduction("francais","articleTitle");?><input type="text" size="60" name="<?php echo "titre_francais";?>"/>
	<?php echo traduction("anglais","articleTitle");?><input type="text" size="60" name="<?php echo "titre_anglais";?>"/><br/><br/>
	<?php echo traduction("francais","articleZone");?><textarea rows="25" cols="50"name="<?php echo "texte_francais";?>"></textarea>
	<?php echo traduction("anglais","articleZone");?><textarea rows="25" cols="50"name="<?php echo "texte_anglais";?>"></textarea><br/><br/>
	<br/><br/>
	<?php echo traduction($langue,"textKeyWord");?><input type="text" size="50" name="<?php echo "mots_cles";?>"/>
	<input type="hidden" name="action" value="InsertArticle"/><br/><br/>
	
	<input type="submit" name="<?php echo traduction($langue,"articleInsert");?>"/>
</form>