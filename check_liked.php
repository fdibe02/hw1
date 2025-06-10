<?php

    require_once 'auth.php';
    $userid = checkAuth();
    if (!$userid) exit;


        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        # Costruisco la query
        $userid = mysqli_real_escape_string($conn, $userid);
        $articleid = mysqli_real_escape_string($conn, $_GET['q']);

        $query = "SELECT * FROM LikedArticles WHERE user_id = '$userid' AND article_id = '$articleid'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('is_saved' => true, 'id' => $articleid));
            exit;
        }else{
            echo json_encode(array('is_saved' => false, 'id' => $articleid));
            exit;
        }

        mysqli_close($conn);
   

?>