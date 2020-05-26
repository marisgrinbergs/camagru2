<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css">
    <title>connecté</title>
</head>
<body class='z'>
        <div class='z header'>
                <?php
                if (isset($_SESSION['login']))
                {
                        echo "Bonjour, " .$_SESSION['login'];
                ?>
        	<a href="profil.php" id="profile"><span>Mon profil</span></a>
                <a href="deconnexion.php">Se déconnecter</a> <?php
                }
                ?>
        </div>
        <div class="z section">
            <div class="separator"></div>
            <div class="section-menu">
                <div class="z section-menu__cam">
                    <div ><video id="video" width="100%" height="100%" autoplay></video></div>
                    <div><button id="snap" disabled>Snap Photo</button></div>
                </div>
                <div class="z section-menu-images"> 
                    <div class="z canvas">
                        <canvas id="canvas" width="450px" height="400px"></canvas>
                    </div>    
                    <div class="z filter">
                        <div>
                        <input type="radio" id="filter1" name="filtre">
                        <img src="img/leo.png" alt="leo" height="100" width="100">
                        </div>
                        <div>
                        <input type="radio" id="filter1" name="filtre">
                        <img src="img/leo.png" alt="leo" height="100" width="100">
                        </div>
                    </div>    
                </div>
             </div>
             <?php
print("LOL");
?>
        </div>
        <div class="z footer">
            <div>Camagru</div>
         <div>&copy;Magrinbe 2020</div>
        </div>
        <script src="cam.js"></script>
        <script src="image.js"></script>
        <script src="filtre.js"></script>
</body>
</html>