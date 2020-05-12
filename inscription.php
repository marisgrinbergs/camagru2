<?php
session_start();
require('Database/coDatabase.php');
require (__DIR__ .'/model/user.php');

if (isset($_SESSION['id']))
{
    header('Location: index.php');
    exit;
}

if (isset($_POST['form_inscription']))
{
    // echo 'le login est '.$_POST['login'].' et le mail est '.$_POST['email'].' et le mdp est '.$_POST['passwd'].' et le confmdp est '.$_POST['confmdp'];
if(isset($_POST['login']) AND isset($_POST['mail']) AND isset($_POST['passwd']) AND isset($_POST['confmdp']))
    {
      $login = htmlspecialchars(trim($_POST['login']));
      $mail = htmlspecialchars(strtolower(trim($_POST['mail'])));
      $password = trim($_POST['passwd']);
      $password2 = trim($_POST['confmdp']);
      $pseudolength = strlen($login);
      if ($pseudolength <= 255)
      {
        if (preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail))
        {
            if ($password==$password2)
            {
              $key = 0;
              for($i=1; $i<12; $i++)
                $key .= mt_rand(0, 9);
              $password = password_hash($password, PASSWORD_DEFAULT);
              $date_user = date('Y-m-d H:i:s');
              user::insert_user($login, $password, $mail, $date_user, $key);

              $emailFrom = 'test@camagru.com';
              $header="MIME-Version: 1.0\r\n";
              $header.= "From: " . $emailFrom . "\n";
              $header.='Content-Type:text/html; charset="uft-8"'."\n";
              $header.='Content-Transfer-Encoding: 8bit';
              $message='
              <html>
                 <body>
                    <div align="center">
                       <a href="http://localhost/Camagru/confirmation.php?pseudo='.urlencode($login).'&key='.$key.'">Confirmez votre compte !</a>
                    </div>
                 </body>
              </html>';

              // use wordwrap() if lines are longer than 70 characters
              $message = wordwrap($message,70);
              $success = mail($mail, "CAMAGRU Confirmation de compte", $message, $header);
              if (!$success) {
              $errorMessage = error_get_last()['message'];
              echo "ERREUR LORS DE LENVOI DU MAIL";
              }
              //mail($mail, "Confirmation de compte", $message, $header);
              
              $erreur = "Votre compte a bien été crée";

            }
            else
            {
              $erreur = "Vos mots de passe ne sont pas identiques";
            }
        }
        else
        {
          $erreur = "Votre adresse mail n'est pas valide!";
        }
      }
      else
      {
          $erreur = "Votre nom ne doit pas dépasser les 255 caractères";
      }
    }

    else
    {
      $erreur = "Tous les champs doivent être remplis";
    }
}

if(isset ($erreur))
{
  echo $erreur;
}

//require ('../view/inscription.html.php');
    //TO DO: Checker si le MAIL nest pas deja pris dans la BDD
 /*   else
    {
       // $req_mail = $bdd->query("SELECT mail from users WHERE mail = ?", array($mail));
        $req_mail = $bdd->query("SELECT mail from users WHERE mail = ?", array($mail));
        $req_mail = $req_mail->fetch();

        if ($req_mail['mail'] != "")
        {
            $valid = false;
            $er_mail = "ce mail existe deja";
        }
    }
    */
?>

