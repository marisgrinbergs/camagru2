<?php
class user {
public static function coDatabase() {
	try {
	  require __DIR__ .'/../Database/database.php';
    $pdo = new PDO($DB_DSN, $DB_USER , $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
	  echo 'Connection failed : ' . $e->getMessage();
	  $pdo = null;
	}
	return $pdo;
}
public static function createStatement($sql) {
    $pdo_statement = null;
    $pdo = self::coDatabase();
    if ($pdo)
    try {
      $pdo_statement = $pdo->prepare($sql);
    } catch (PDOException $e) {
      echo 'Connection failed : ' . $e->getMessage();
    }
    return $pdo_statement;
}
// WHERE id="'.$workouts['user_id'].'"'
		public static function insert_user($login, $passwd, $email, $date_user, $confirmkey)
		{
			  try {
			$pdo_statement = self::createStatement('INSERT INTO users (user, passwd, mail, date_user, confirmkey) VALUES (:login, :passwd, :email, :date_user, :confirmkey)');
			$pdo_statement->bindparam(':login', $login) &&
			$pdo_statement->bindparam(':passwd', $passwd) &&
			$pdo_statement->bindparam(':email', $email) &&
			$pdo_statement->bindparam(':date_user', $date_user) &&
			$pdo_statement->bindparam(':confirmkey', $confirmkey) &&
			$pdo_statement->execute();
		} catch (PDOException $e) { die('Erreur : ' . $e->getMessage());

		}
		return $pdo_statement;
		}


		public static function profil_user()
		{
			$requser = self::createStatement('SELECT * FROM users where user = ?');
			$requser->execute(array($_SESSION['login']));
			$userinfo = $requser->fetch();
			return $userinfo;
		}

		public static function update_login()
		{
			global $newpseudo;
			$updatelogin = self::createStatement('UPDATE users SET user = ? where user = ?');
			$updatelogin->execute(array($newpseudo, $_SESSION['login']));
			return $updatelogin;
		}

		public static function update_mail()
		{
			global $newmail;
			$updatemail = self::createStatement('UPDATE users SET mail = ? WHERE user = ?');
			$updatemail->execute(array($newmail, $_SESSION['login']));
			return $updatemail;
		}

		public static function update_pwd()
		{
			global $pass1;
			$pass1 = password_hash($pass1, PASSWORD_DEFAULT);

			$updatepwd = self::createStatement('UPDATE users SET passwd = ? WHERE user = ?');
			$updatepwd->execute(array($pass1, $_SESSION['login']));
			return $updatepwd;
		}


		public static function connect_user()
		{
			global $login;
	
			$req = self::createStatement("SELECT * FROM users WHERE user = ?");
			$req->bindparam(1, $login);
			$req->execute(array($login));
			$resultat = $req->fetch();
			return $resultat;
	}

	public static function confirm_account()
	{
		global $pseudo;
		global $key;
		$req = self::createStatement("SELECT * FROM users WHERE user = ? AND confirmkey = ?");
		$req->execute(array($pseudo, $key));
		$userexist = $req->rowCount();
		if($userexist == 1) {
      $user = $req->fetch();
      if($user['confirm_account'] == 0) {
         $updateuser = self::createStatement("UPDATE users SET confirm_account = 1 WHERE user = ? AND confirmkey = ?");
         $updateuser->execute(array($pseudo,$key));
         echo "Votre compte a bien été confirmé !";
      } else {
         echo "Votre compte a déjà été confirmé !";
      }
   } else {
      echo "L'utilisateur n'existe pas !";
   }



	}
}