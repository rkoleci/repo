<?php

    include('api.php');
    session_start();

    $str = file_get_contents('data.json');
    $json = json_decode($str, true);

    $nameR = $_SESSION['nameR'];
    echo $nameR;

    getRestByIdDetails($nameR, $json);


 ?>
