<?php

    require_once 'auth.php';
    $userid = checkAuth();
    if (!$userid) exit;


        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        # Costruisco la query
        $userid = mysqli_real_escape_string($conn, $userid);
        $articletitle = mysqli_real_escape_string($conn, $_POST['title']);
        $articlesubtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
        $articletopic = mysqli_real_escape_string($conn, $_POST['topic']);
        $articlecontent = mysqli_real_escape_string($conn, $_POST['content']);
        
        $query = "INSERT INTO Articles(author, title, subtitle, content, topic) VALUES('$userid', '$articletitle', '$articlesubtitle, '$articlecontent', '$articletopic')";
        error_log($query); 
        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));
    





?>