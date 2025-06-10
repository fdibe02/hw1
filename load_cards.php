<?php 

    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $userid = mysqli_real_escape_string($conn, $userid);

        $query = "SELECT a.id, a.title, a.subtitle, a.content, a.topic, a.likes, a.dislikes, a.image_src, u.name, u.surname
                FROM Articles a
                JOIN Users u ON u.id = a.author
                WHERE a.id NOT IN (SELECT d.article_id
                                    FROM dislikedArticles d
                                    WHERE d.user_id = $userid)";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $articleArray = array();

    while($entry = mysqli_fetch_assoc($res)) {

        $articleArray[] = array('id' => $entry['id'], 'author_name' => $entry['name'], 'author_surname' => $entry['surname'],  'title' => $entry['title'],
                            'subtitle' => $entry['subtitle'], 'content' => $entry['content'], 'likes' => $entry['likes'], 'dislikes' => $entry['dislikes'], 'img' => $entry['image_src']);
    }
    echo json_encode($articleArray);
    
    exit;


?>