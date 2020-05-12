<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Mon profil</title>
</head>
<body>
	<h1>Mon profil</h1>
	<form method="POST" action="profil.php">
		
		<label>Pseudo actuel :</label>
		<input type="text" value="<?php echo $userinfo['user']; ?>" disabled><br /><br />
		<label>Entrez votre nouveau pseudo :</label>
		<input type="text" name="newpseudo" placeholder="..."><br /><br /><br />
		
		<label for="mail1">Votre mail actuel :</label>
		<input type="text" value="<?php echo $userinfo['mail']; ?>" disabled><br /><br />
		<label for="mail1">Entrez votre nouveau mail :</label>
		<input type="text" name="newmail" placeholder="..."><br /><br /><br />

		<label>Entrez votre nouveau mot de passe :</label>
		<input type="password" name="newmdp1" placeholder="..."><br /><br />
		<label>Confirmation du nouveau mot de passe :</label>
		<input type="password" name="newmdp2" placeholder="..." /><br /><br /><br />

		<input type="submit" name="submit" value="Mettre à jour mon profil !" />
	</form>
	<a href="index.php" id="home"><span>Retour page d'accueil</span></a>
</body>
</html>