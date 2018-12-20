<?php
class SO_Post_Get {
	private $balise_debut = "SO_MAJ_DEBUT";
	private $balise_fin = "SO_MAJ_FIN";
	 
	/* so_sendToHost
	 * ~~~~~~~~~~
	 * Params:
	 *   $host      - Just the hostname.  No http:// or
	 /path/to/file.html portions
	 *   $method    - get or post, case-insensitive
	 *   $path      - The /path/to/file.html part
	 *   $data      - The query string, without initial question mark
	 *   $useragent - If true, 'MSIE' will be sent as
	 the User-Agent (optional)
	 *
	 * Examples:
	 *   sendToHost('www.google.com','get','/search','q=php_imlib');
	 *   sendToHost('www.example.com','post','/some_script.cgi',
	 *              'param=First+Param&second=Second+param');
	 *
	 * Retourne la chaine réponse ou FALSE si problème connexion
	 *
	 */
	function so_sendToHost($host,$method,$path,$data)
	{
		$method = strtoupper($method);

		// ajout de balises pour repérer la chaine de retour dans la reponse HTTP
		$data = "balise_debut=".$this->balise_debut."&balise_fin=".$this->balise_fin."&".$data;
		// si methode GET ==> integre $data avec le $path
		if ($method == 'GET')
		{
			$path .= '?'.$data;
		}

		// Header info to connect to the server
		$header = "";
		$header .= "$method $path HTTP/\r\n";
		$header .= "HOST: $host \r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($data) . "\r\n";
		$header .= "Connection: close\r\n\r\n";

		// Ouverture connexion avec serveur
		$fp = fsockopen ($host, 80, $errno, $errstr, 0);

		//Pas de connexion ==> retour erreur
		if (!$fp)
		{
			$message = "Erreur connexion pour appel methode $method : $errno $errstr";
			so_traiteErreur($message);
			return FALSE;
		}

		// si methode POST ==> integre $data après $header
		if ($method == 'POST')
		{
			$header .= $data;
		}

		// envoie requete
		fputs ($fp, $header);

		// evite une éventuelle attente
		flush();


		// Receive POST request
		$reponse = "";
		while ( !feof($fp) )
		{
			$reponse .= fread($fp,8);
		}

		// ferme la connexion
		fclose($fp);

		$this->so_extrait_reponse( $reponse);

		return $reponse;
	}


	/* extrait_reponse
	 * ~~~~~~~~~~~~~~~
	 * Params:
	 *  reponse    : issue de la requete
	 *
	 */
	private function so_extrait_reponse(&$reponse)
	{
		$pos_debut = strpos ($reponse, $this->balise_debut);
		$pos_fin = strpos ($reponse, $this->balise_fin);

		if ($pos_debut === FALSE)
		{
			$message = "Erreur réponse script : balise début introuvable";
			//so_traiteErreur($message);
			return FALSE;
		}

		if ($pos_fin === FALSE)
		{
			$message = "Erreur réponse script : balise fin introuvable";
			//so_traiteErreur($message);
			return FALSE;
		}

		$pos_debut += strlen($this->balise_debut);

		$reponse = substr($reponse, $pos_debut, $pos_fin - $pos_debut);

		return TRUE;
	}
}
?>