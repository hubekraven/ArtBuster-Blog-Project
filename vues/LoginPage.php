<?php
//require_once("index.php");   

$nomdusager="";
$motdepasse="";
?>	

<!DOCTYPE html>           
<html>
	<head>
		
		<script type="text/javascript" src="md5.js"></script>
		<script type="text/javascript"> 
			function encrypte()
			{
				var passwordEncrypte = md5(document.loginForm.password.value);
				var grainSel = document.loginForm.grainSel.value;
				var passwordPlusGrainSel = md5(passwordEncrypte + grainSel);
							
				var username = document.loginForm.username.value;			
				
				document.formEncrypte.password.value = passwordPlusGrainSel;
				document.formEncrypte.username.value = username;
				alert(username + " " + passwordPlusGrainSel);
				document.formEncrypte.submit();			
			}
		</script>
	<style type="text/css">
	   
	</style>
	</head>
	<body>
 		<form name="loginForm" method="POST" action="index.php?action=autentification">
			<div class="center">
				<!--fieldset-->
				
				<p class="sansserif"><font color="black"><h2><legend id="Bienvenue"><h2><legend><?php echo traduction($langue,"textWelcome");?></legend></h2></font></p>
				<font color="black"><?php echo traduction($langue,"textUsername");?></font>
				   
					<input type="text" name="username" value="<?php echo $nomdusager;?>"/><span></span>
					<br>
					
					<?php echo traduction($langue,"textPassword");?>     
					<input type="password" name="password" value="<?php echo $motdepasse;?>"/><span></span>
					<br>
					<input type="hidden" name="grainSel" value="<?php echo $_SESSION["grainDeSel"];?>"/><br/>
					<input type="button" value="<?php echo traduction($langue,"loginValidade");?>" onclick="encrypte();"/></br></br>
					<!--/fieldset-->
			</div>

		</form>
		<form name="formEncrypte" method="POST" action="index.php?action=autentification">
			<input type="hidden" name="username"/>		
			<input type="hidden" name="password"/>		
		</form>
			<span></span>

</body>
</html>