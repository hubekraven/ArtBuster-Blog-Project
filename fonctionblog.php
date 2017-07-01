<?php
	
	function traduction($langue,$text){
			//cree un nouveau fichier de type DOM
			$document = new DOMDocument();
			//valide le document
			$document->validateOnParse = true;
		//selon la langue lance le fichier
		if($langue=="anglais")
		{
			$document->Load('blog_En.xml');
		}
		else
		{
			$document->Load('blog_Fr.xml');
			//print_r($document);
		}
		//recuper l'element dont l'Id est égale au paramettre
		$elem = $document->getElementById($text);
		//recuper le contenu de ce noeux
		$valeur= $elem->nodeValue;
		//retourn le coutenu
		return $valeur ; 
	}
	
?>
