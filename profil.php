<?php
session_start();
require('Database/coDatabase.php');
require (__DIR__ .'/model/user.php');

if (!isset($_SESSION['login'])) {
	header ('Location: index.php');
	exit();
}

$userinfo = user::profil_user();

#PSEUDO
if (!empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $userinfo['pseudo'])
{
	$newpseudo = htmlspecialchars(trim($_POST['newpseudo']));
	$updatelogin = user::update_login();
	$_SESSION['login'] = $newpseudo;
	header('Location: index.php?login='.$_SESSION['login']);
}


# MAIL
if(!empty($_POST['newmail']) AND $_POST['newmail'] != $userinfo['mail'])
{
	if(filter_var($_POST['newmail'], FILTER_VALIDATE_EMAIL))
	{
		$newmail = htmlspecialchars(strtolower(trim($_POST['newmail'])));
		$updatemail = user::update_mail();
		$_SESSION['mail'] = $newmail;
		header('Location: index.php?login='.$_SESSION['login']);
	}
}

# MOT DE PASSE

if(!empty($_POST['newmdp1']) AND !empty($_POST['newmdp2']))
{	
	$pass1 = trim($_POST['newmdp1']);
	$pass2 = trim($_POST['newmdp2']);

	if($pass1 == $pass2)
	{
		$updatepwd = user::update_pwd();
		header('Location: index.php?login='.$_SESSION['login']);
	}
	else
	{
		echo "Vos deux mot de passe ne correspondent pas !";
	}
}

require ('profil.html.php');
?>


