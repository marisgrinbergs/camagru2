<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="flexmodel.css">
    <title>Inscription</title>
</head>
<body>
    <h1>Créer un compte</h1>
    <form method="POST" action="inscription.php">
        <label for="pseudo">Identifiant: <br></label><input type="text" name="login" id="pseudo"><br>
        <label for="email">Votre addresse mail: <br></label><input type="mail" name="mail" id="email"><br>
        <label for="mdp">Mot de passe: <br></label><input type="password" name="passwd" id="mdp"><br>
        <label for="confirm_mdp">Confirmer le Mot de passe: <br></label><input type="password" name="confmdp" id="confmdp"><br>
        <input type="submit" name="form_inscription" value="Créer un compte"/><br>
        <a href="connexion.html" id="creation-cancel-button"><span>Vous avez déjà un compte?</span></a>
        <a href="index.php" id="home"><span>Retour page d'accueil</span></a>        
    </form>
</body>
</html>