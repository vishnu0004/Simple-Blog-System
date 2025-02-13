<?php
include('../config.php');
    if(isset($_GET['id'])){
    $id = $_GET['id'];
    $delete = "DELETE FROM `posts` WHERE id = '$id'";
    $result = $conn->query($delete);
    if($result){
        header("location: index.php");
    }else{
        echo "not delete data";
    }
    }
?>