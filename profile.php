<?php 

    require_once 'auth.php';

    $userid = checkAuth();

    if (!$userid) {
        header("Location: signin.php");
        exit;
    }
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT name, surname FROM users WHERE id = $userid";
        $res = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res);   
    ?>

<html>
    
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="profile.css">
        <script src="profile.js" defer></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <title>Your Account</title>
    </head>

  <body>
   <header>
    <div id="start">
      <a id="logo" href="index.php"> Medium </a>
      <input type="text" id="searchbar" placeholder="  &#128269; Search"></input> 
    </div>
    </div>
    <div id="account">
      <a href="write.php"> Write</a>
      <a href="profile.php" id="personal-area">
        <img src="https://static.vecteezy.com/ti/vettori-gratis/t1/15154794-utente-uomo-account-profilo-umano-membro-icona-vettore-simbolo-cartello-gratuito-vettoriale.jpg">
      </a>
    </div>
  </header>

  <section>
    <div id="user-bar">
    <h2 id="nome"><?php echo $userinfo['name']." ".$userinfo['surname'] ?></h2>
    <a href="signout.php" id="signout">Sign Out</a>
    </div>
    <h3>Liked Articles</h3>
    <div id="liked-articles">
       
    </div>
  </section>


    </body>
</html>