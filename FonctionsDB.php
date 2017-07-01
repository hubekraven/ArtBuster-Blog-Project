<?php
	$connexion = connectDB();
	
	function connectDB()
	{
		$laConnexion = mysqli_connect("localhost", "e1595075", "760429");
		//$laConnexion = mysqli_connect("localhost", "root", "");
			
		if(!$laConnexion)
		{
			//la connexion n'a pas fonctionné
			die("Erreur de connexion à la base de données. " . mysqli_connect_error());
		}
		
		
		 $selected = mysqli_select_db($laConnexion, "e1595075");

		if(!$selected)
		{
			die("La base de données n'existe pas.");
		}
		
		mysqli_query($laConnexion, "SET NAMES 'utf-8'");
		return $laConnexion;
	}
	//fonction d'execusion de requetes. la fonction reçoit en paramettre une requete et retourne le resultats de la requete
	function executeRequete($requete)
	{
		global $connexion;
		$resultats = mysqli_query($connexion, $requete);
		return $resultats;
	}
	
	//recuper tout les articles
	function getAllArticles()
	{ 
			return executeRequete("SELECT idArticle,titre_anglais,titre_francais,texte_anglais,texte_francais,
								TP_usager.nom,TP_usager.prenom,username FROM article JOIN TP_usager ON auteur= username 
								ORDER BY idArticle DESC");	
			
	}
	//recuper un article
	function getUnArticle($idArticle,$auteur)
	{ 
		global $connexion;
		$auteur=mysqli_real_escape_string($connexion,$auteur);
		$idArticle=mysqli_real_escape_string($connexion,$idArticle);
		//echo $titre_francais;
			return executeRequete("SELECT idArticle,titre_anglais,titre_francais,texte_anglais,texte_francais,
								TP_usager.nom,TP_usager.prenom FROM article JOIN TP_usager ON auteur= username wHERE idArticle =".$idArticle." AND auteur = '". $auteur ."'");	
			
	}
	//recuper tous articles associé a un mots_clé
	function getMotcleAllArticles($mots_cles)
	{ 
		global $connexion;
		//$auteur=mysqli_real_escape_string($connexion,$auteur);
		$mots_cles=mysqli_real_escape_string($connexion, $mots_cles);
		//echo $titre_francais;
			return executeRequete("SELECT mots_cles,idArticle,titre_anglais,titre_francais,texte_anglais,texte_francais, TP_usager.nom,TP_usager.prenom FROM article 
								JOIN TP_usager ON auteur= username JOIN article_motscles ON articleId=idArticle 
								JOIN motscles ON motsclesid=idMotscles WHERE mots_cles ='".$mots_cles."'");			
	}
	//recuper TOUS les mots-clés ordonné et les class par leur nombre d'occurence dans un article
	function getAllMotscles()
	{	
		return executeRequete("SELECT idMotscles, mots_cles, COUNT(*) AS Nb_Articles_lies FROM motscles 
								JOIN article_motscles ON motsclesid=IdMotscles GROUP BY mots_cles ORDER BY COUNT(*) DESC ");		
	}
	//recuper tes mots clé de l'article dont IDarticle est passé en paramettre
	function getArticleMotscles($idArticle)
	{
		
		return executeRequete("SELECT idArticle,mots_cles FROM motscles 
								JOIN article_motscles ON motsclesid=IdMotscles
								JOIN article ON	articleId=idArticle	WHERE idArticle = " .$idArticle);	
		
	}
	function getUnMotscle($mots_cles)
	{
		global $connexion;
		$mots_cles=mysqli_real_escape_string($connexion, $mots_cles);
		//echo "test" . $mots_cles;
		return executeRequete("SELECT idMotscles,mots_cles FROM motscles 
									WHERE mots_cles ='".$mots_cles."'");	
		
	}
	
	//fonction d'insertion d'article. Recois en paramettre//
	//$titre_anglais,$titre_francais,$texte_anglais,$texte_francais, $auteur passés en pamettre //
	//par le formulaire de creation article//
	function insertArticle($titre_anglais,$titre_francais,$texte_anglais,$texte_francais, $auteur)
	{
		global $connexion;
		$titre_anglais=mysqli_real_escape_string($connexion,$titre_anglais);
		$titre_francais=mysqli_real_escape_string($connexion,$titre_francais);
		$texte_anglais=mysqli_real_escape_string($connexion,$texte_anglais);
		$texte_francais=mysqli_real_escape_string($connexion,$texte_francais);
		$auteur=mysqli_real_escape_string($connexion, $auteur);
		return executeRequete("INSERT INTO article(titre_anglais,titre_francais,texte_anglais,texte_francais, auteur) VALUES('" . $titre_anglais. "','" . $titre_francais . "','" . $texte_anglais . "','" . $texte_francais . "','" . $auteur . "')");	
		//return mysqli_insert_id($connexion);							
	}
	
	////fonction d'insertion de mots_cles. Recois en paramettre un mots_cles
	function insertMotcles($mots_cles)
	{
		global $connexion;
		$mots_cles=mysqli_real_escape_string($connexion,$mots_cles);
		//$username = mysqli_real_escape_string($connexion, $_POST['username']);
		return executeRequete("INSERT INTO motscles(mots_cles) VALUES
								('" . $mots_cles. "')");		
	}
	//function fait une insertion dans la table Article_motscles a partir des valeur passés en paramettre
	function insertArticle_motscles($IdArticle,$IdMotscle){
		global $connexion;
		$IdArticle=mysqli_real_escape_string($connexion,$IdArticle);
		$IdMotscle=mysqli_real_escape_string($connexion,$IdMotscle);
		return executeRequete("INSERT INTO article_motscles (articleId,motsclesId) VALUES (".$IdArticle.",".$IdMotscle.")");
		
	}
	//function qui fait la modification d'un article a partir de l'IDarticle passé en paramettre
	function modifieArticle($idArticle, $titre_anglais, $titre_francais,$texte_anglais, $texte_francais)
	{
		global $connexion;
		
		$idArticle=mysqli_real_escape_string($connexion,$idArticle);
		$titre_anglais=mysqli_real_escape_string($connexion,$titre_anglais);
		$titre_francais=mysqli_real_escape_string($connexion,$titre_francais);
		$texte_anglais=mysqli_real_escape_string($connexion,$texte_anglais);
		$texte_francais=mysqli_real_escape_string($connexion,$texte_francais);
		return executeRequete("UPDATE article SET titre_anglais = '". $titre_anglais ."', titre_francais = '". $titre_francais ."' ,texte_anglais = '". $texte_anglais ."', texte_francais = '". $texte_francais ."' WHERE idArticle = " . $idArticle);		
	}
	//fonction qui reçoit en paramettre le nom d'usager et recuper le mot de passe dans la base de données 
	function MotDePasse($username)
	{
		global $connexion;
		$requete = "SELECT password FROM TP_usager WHERE username = '" . mysqli_real_escape_string($connexion, $username) . "'";
		$resultat = ExecuteRequete($requete);
		$motDePasse = mysqli_fetch_assoc($resultat)["password"];
		return $motDePasse;
	}
	
?>