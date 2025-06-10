<?php
  require_once 'auth.php';

  $userid = checkAuth();
  if(!$userid){
    header('Location: signin.php');
    exit;
  }

?>


<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="index.css">
  <script src="index.js" defer></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <title>Medium for WP</title>
</head>

<body>
  <div id="dislike-modal" class="hidden">
    <div id="dislike-box">
      <div id="dislike-message">
        <h5>Got it, we'll reccomend fewer contents like this</h5>
        <h6> You can additionally take any of the actions below</h6>
      </div>
      <div class="dislike-choise">
        <p>Mute author</p>
      </div>
      <div class="dislike-choise">
        <p>Mute pubblication</p>
      </div>
      <div id="report">
        <p>Report story</p>
      </div>

      <div id="dislike-options">
        <button id="undo">Undo</button>
        <button id="done">Done </button>
      </div>
    </div>
  </div>

  <header>
    <div id="start">
      <a id="logo" href="index.php"> Medium </a>
      <input type="text" id="searchbar" placeholder="  &#128269; Search"></input> 
    </div>
    </div>
    <div id="account">
      <a href="write.php" id="write">Write</a>
      <a href="profile.php" id="personal-area">
        <img src="https://static.vecteezy.com/ti/vettori-gratis/t1/15154794-utente-uomo-account-profilo-umano-membro-icona-vettore-simbolo-cartello-gratuito-vettoriale.jpg">
      </a>
    </div>
  </header>

  <article>

    <section id="feed">

      <nav>
        <div class="topic">Education</div>
        <div class="topic">Featured</div>
        <div class="topic">Lifestyle</div>
        <div class="topic">Science</div>
        <div class="topic">Productivity</div>
        <div class="topic">Books</div>
        <div class="topic">Apple</div>
        <div class="topic">Science</div>
        <div class="topic">Following</div>
      </nav>

      <div id="main">

      </div>

    </section>

    <section id="side-bar">

      <div id="news-section">

      </div>
      
      
    </section>

  </article>

</body>

</html>