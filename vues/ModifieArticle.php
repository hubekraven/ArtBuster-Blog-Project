

<h2 class="Titre"><?php echo traduction($langue,"textModifyForm")?></h2>
<br/><br/>
<?php 
	if(isset($_SESSION["authentifie"]))
	{
		//affiche ce lien si l'usager est autentifié
	?>
		
		<i class="fa fa-hand-o-left" aria-hidden="true"></i><a href="index.php?action=afficheFormArticles"><?php echo traduction($langue,"articlePage")?></a>
		<a href="index.php?action=AfficheformInsertArticle"><?php echo traduction($langue,"articleCreate")?></a><br/><br/><br/>
<?php
	} 
?>

<form action="" method="POST">
<?php
$rangee =  mysqli_fetch_assoc($donnees);
if( $rangee > 0 )
	{?>
	
	<?php echo traduction("francais","articleTitle");?><input type="text" size="60" name="<?php echo "titre_francais";?>" value="<?php echo $rangee["titre_francais"]?>"/>
	<?php echo traduction("anglais","articleTitle");?><input type="text" size="60" name="<?php echo "titre_anglais";?>" value="<?php echo $rangee["titre_anglais"]?>"/><br/><br/>
	<?php echo traduction("francais","articleZone");?><textarea rows="25" cols="50"name="<?php echo "texte_francais";?>"><?php echo $rangee["texte_francais"]?></textarea>
	<?php echo traduction("anglais","articleZone");?><textarea rows="25" cols="50"name="<?php echo "texte_anglais";?>"><?php echo $rangee["texte_anglais"]?></textarea><br/><br/>
	<br/><br/>
	<!--input type="hidden" name="idArticle" value="<?php echo $_SESSION["Article"];?>"/-->
	<input type="hidden" name="action" value="modifieArticle"/>
	<input type="submit" value="<?php echo traduction($langue,"articleModify");?>"/><br/><br/>
	
	<?php
	}
	else
	{
		 echo traduction($langue,"ErrorModify")."<a href='index.php'>".traduction($langue,"articlePage")."</a>";
	}
?>		
	
</form>
