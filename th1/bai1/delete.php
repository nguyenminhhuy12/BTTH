<?php
    echo'delete';
    session_start();
    if(isset($_GET['index']))
    {
        echo'dang xoa';
        $index = $_GET['index'];
        unset($_SESSION['flo'][$index]);
        header('location: index.php');
    }
?>