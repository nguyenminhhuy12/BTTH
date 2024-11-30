<?php
session_start();
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_GET['index']) )
{

    $index = $_GET['index'];
    $target_dir = "image/";
    $target_file = $target_dir.basename($_FILES['upload']['name']);

    if(move_uploaded_file($_FILES['upload']['tmp_name'],$target_file))
    {
        $_SESSION['flo'][$index] = ['name' => $_POST['name-flower'],
                                    'detail' => $_POST['detail-flower'],
                                    'image'=>$target_file];
        header('location:index.php');
    }
    else
    {
        $old_image = $_SESSION['flo'][$index]['image'];
        $_SESSION['flo'][$index] = ['name'=>$_POST['name-flower'],
                                    'detail'=> $_POST['detail-flower'],
                                    'image'=>$old_image];
    }
    header('location:index.php');
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name-flower']) && isset($_POST['detail-flower'])&& isset($_FILES['upload']))
{
    echo 'chay duoc roi';
    $target_dir = "image/";
        $target_file = $target_dir.basename($_FILES['upload']['name']);
        $_SESSION['flo'][] = ["name" => $_POST['name-flower'], "detail" => $_POST['detail-flower'], "image" => $target_file];
        echo $_SESSION['flo'][count($_SESSION['flo'])-1]["name"];
        echo $_SESSION['flo'][0]["name"];
        if(move_uploaded_file($_FILES['upload']['tmp_name'], $target_file)){
            header('location: index.php');
        }
        else{
            echo 'Loi';
        }
 
        foreach($_SESSION['flo'] as $index => $value){
            echo 'Ten '.$value["name"].' mo ta '.$value["detail"].' link anh '.$value["image"]; 
        }
}
?>