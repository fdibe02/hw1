<?php

    require_once 'dbconfig.php';

    if(!isset($_GET["q"])){
        echo "nessun parametro presente.";
        exit;
    }

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $email = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT email FROM users WHERE email = '$email'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    
    if (mysqli_num_rows($res) > 0)
        $exists = true;
    else $exists = false;

    echo json_encode(array('exists' => $exists));

    mysqli_close($conn);

?>