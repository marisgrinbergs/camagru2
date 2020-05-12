<?php

require('Database/coDatabase.php');
require (__DIR__ .'/model/user.php');

if(isset($_GET['pseudo'], $_GET['key']) AND !empty($_GET['pseudo']) AND !empty($_GET['key'])) {
   $pseudo = htmlspecialchars(urldecode($_GET['pseudo']));
   $key = htmlspecialchars($_GET['key']);
   user::confirm_account();
}
?>