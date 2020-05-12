<?php
	session_start();
	require('Database/coDatabase.php');
	require (__DIR__ .'/model/user.php');

  // S'il y a une session alors on ne retourne plus sur cette page  
    if (isset($_SESSION['login'])){
        header('Location: index.php');
        exit;
    }
    // Si la variable "$_Post" contient des informations alors on les traite
    if(!empty($_POST)){
        extract($_POST);
		$valid = true;

		//$login = htmlspecialchars(trim($login));
		$req = ("UPDATE users SET n_mdp = 0 WHERE user = ?");
		$nmdp = user::createStatement($req);
		$nmdp->bindParam(1, $login);
		$nmdp->execute();

 
        if (isset($_POST['form_connexion'])){
			$login = htmlspecialchars(trim($login));
			$passwd = trim(($passwd));
 
			if (empty($login) || (empty($passwd)))
			{
				$valid = false;
			}
			if (empty($_POST['login']) and empty($_POST['passwd']))
			{
				$valid = false;
			}
			
            // Si le token n'est pas vide alors on ne l'autorise pas à accéder au site
           // if($req['token'] <> NULL){
            //	$valid = false;
            //    $er_mail = "Le compte n'a pas été validé";	
            }
 
            // S'il y a un résultat alors on va charger la SESSION de l'utilisateur en utilisateur les variables $_SESSION
		  
			/*
			
			if ($valid && $userexist == 1){
				$userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['id']; // id de l'utilisateur unique pour les requêtes futures
                $_SESSION['login'] = $userinfo['login'];
				$_SESSION['mail'] = $userinfo['mail'];
				echo 'Vous êtes connecté ici!';
                header('Location:  index.php');
                exit;
			} 

			*/
		}
			$resultat = user::connect_user();
			$isPasswordCorrect = password_verify($_POST['passwd'], $resultat['passwd']);
			
			if (!$resultat)
			{
					echo 'Mauvais identifiant ou mot de passe 1!';
			}
			else
			{
					if ($isPasswordCorrect && $valid === true) {
						//session_start();
						$_SESSION['login'] = $resultat['user'];
						$_SESSION['mail'] = $resultat['mail'];
						echo "le login est $login";
						//header('Location: index.php');
						//exit;
						echo 'Vous êtes connecté !';
					}
			else 
			{
				echo "connexion failed";
			}
		//	if(isset ($er_login) )  
        }
?>