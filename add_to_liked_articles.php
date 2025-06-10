<?php

    require_once 'auth.php';
    $userid = checkAuth();
    if (!$userid) exit;


        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);
        $articleid = mysqli_real_escape_string($conn, $_POST['id']);


        $query = "INSERT INTO LikedArticles(user_id, article_id) VALUES('$userid','$articleid')";
        error_log($query); 

        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));


?>