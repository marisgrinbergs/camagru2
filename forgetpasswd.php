<?php
session_start();
require ('Database/coDatabase.php');
require (__DIR__ .'/model/user.php');

if (isset($_SESSION['id']))
{
    header('Location: index.php');
    exit;
}

if(!empty($_POST))
{
    extract($_POST);
    if (isset($_POST['oublie']))
    {
        $mail = htmlentities(strtolower(trim($mail)));
    
        if (empty($mail) || !(preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)))
        {
            echo $mail;
            echo "le mail est vide ou incomplet";
        }
        else 
        {
        $verif = "SELECT user, mail, n_mdp FROM users WHERE mail = ?";
        $verification_mail = user::createStatement($verif);
        $verification_mail->bindParam(1, $mail);
        
        $verification_mail->execute();
        $verification_mail = $verification_mail->fetch();

            if(isset($verification_mail['mail']) && ($verification_mail['n_mdp'] == 0))
            {
                $new_pass = crypt(mt_rand(0, 9), "clecripter");
                $new_pass_crypt = password_hash($new_pass, PASSWORD_DEFAULT);
                
                $objet = 'Nouveau mot de passe';

                $to = $verification_mail['mail'];
                
                $emailFrom = 'maris.grinbergs1301@gmail.com';
              $header="MIME-Version: 1.0\r\n";
              $header.= "From: " . $emailFrom . "\r\n";
              $header.='Content-Type:text/html; charset="uft-8"'."\n";
              $header.='Content-Transfer-Encoding: 8bit';
              $message = "Bonjour ".$verification_mail['mail']." voici votre nouveau mdp : ".$new_pass."";

                var_dump ($new_pass_crypt);
                mail($to, $objet, $message, $header);

                $req = ("UPDATE users SET passwd = ?, n_mdp = 1 WHERE mail = ?");
                $modify = user::createStatement($req);
                $modify->bindParam(1, $new_pass_crypt);
                $modify->bindParam(2, $mail);

                $modify->execute();
                echo "message envoyé";
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="flexmodel.css">
    <title>forgetpasswd</title>
</head>
<body>
    <h1>Récupération de mot de passe</h1>
    <form method="POST" action="forgetpasswd.php">
        <input type="email" placeholder="Votre adresse mail" name="mail"><br>
        <input type="submit" name="oublie" value="Valider"/><br>
    </form>
</body>
</html>