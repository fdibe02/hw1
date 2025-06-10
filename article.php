<?php 
    require_once 'auth.php';

    $userid = checkAuth();

    if (!$userid) {
        header("Location: signin.php");
        exit;
    }

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

        $userid = mysqli_real_escape_string($conn, $userid);
        $articleid = mysqli_real_escape_string($conn, $_GET["q"]);
        $query = "SELECT * FROM Articles WHERE id = '$articleid'";
        $res = mysqli_query($conn, $query);
        $articleinfo = mysqli_fetch_assoc($res);
?>

<html>
    <head>
        <title> <?php echo $articleinfo['title'] ?> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="article.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>

    <body>
        <header>
    <div id="start">
      <a id="logo" href="index.php"> Medium </a>
      <input type="text" id="searchbar" placeholder="  &#128269; Search"></input> 
    </div>
    </div>
    <div id="account">
      <a href="write.php">Write</a>
      <a href="profile.php" id="personal-area">
        <img src="https://static.vecteezy.com/ti/vettori-gratis/t1/15154794-utente-uomo-account-profilo-umano-membro-icona-vettore-simbolo-cartello-gratuito-vettoriale.jpg">
      </a>
    </div>
  </header>

        <section>
            <h2 id="title"> <?php echo $articleinfo['title'] ?> </h2>
            <div id="subtitle"> <?php echo $articleinfo['subtitle'] ?> </div>
            <div id="interactions"></div>
            <img src=<?php echo $articleinfo['image_src'] ?>>
            <div id="content"><?php echo $articleinfo['content'] ?></div>
        </section>

    </body>

    
</html>