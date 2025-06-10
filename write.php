<?php 
    require_once 'auth.php';

    $userid = checkAuth();

    if (!$userid) {
        header("Location: signin.php");
        exit;
    }

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query_1 = "SELECT name, surname FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query_1);
    $userinfo = mysqli_fetch_assoc($res_1);   

    if (!empty($_POST["title"]) && !empty($_POST["content"]) )
    {
    
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
        $topic = mysqli_real_escape_string($conn, $_POST['topic']);
        $content = mysqli_real_escape_string($conn, $_POST['content']);
        $image = mysqli_real_escape_string($conn, $_POST['img']);

        $query = "INSERT INTO Articles(author, title, subtitle, content, topic, likes, dislikes, image_src) VALUES($userid, '$title', '$subtitle', '$content', '$topic', 0, 0, '$image')";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    }
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="write.css">
        <script src="write.js" defer></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <title>Medium for WP - New story</title>
    </head>
    <body>
    <header>
        <div>
            <a id="logo" href="index.php"> Medium </a>
            <a>Draft in <?php echo $userinfo['name']." ".$userinfo['surname'] ?> </a></a>
        </div>
        <div id="account">
            <input type="submit" id="submit" form="write-article" value="Publish">
            <a href="profile.php" id="personal-area">
                <img src="https://static.vecteezy.com/ti/vettori-gratis/t1/15154794-utente-uomo-account-profilo-umano-membro-icona-vettore-simbolo-cartello-gratuito-vettoriale.jpg">
            </a>
        </div>
  </header>

  <section>
    <form name="write-article" method="post" id="write-article">
        <input type="text" name="title" id="article-title" placeholder="Title"></input>
        <textarea name="subtitle" id="subtitle" placeholder="subtitle"></textarea>
        <input type="text" name="topic" id="topic" placeholder="topic"></input>
        <textarea id="content" name="content" placeholder="Write your story..."></textarea>  
   </form>
   <div id="container">Choose an image for your article</div>
  </section>


    </body>
</html>
