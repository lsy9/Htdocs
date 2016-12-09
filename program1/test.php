<?php
    session_start();
    header("Content-type:text/html;Charset=utf-8");
    var_dump($_SESSION['shopcar']);

    $shopcar = json_encode($_SESSION['shopcar']);
    var_dump($shopcar);
    var_dump(json_decode($shopcar));
    