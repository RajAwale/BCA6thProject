<?php
if($_POST){
    session_start();

    $ulocation = $_POST['ulocation'];
    $uid = (int) $_POST['uid'];

    include "connection.php";

    if($connection){
        $sql= "UPDATE users SET ulocation='$ulocation' WHERE id='$uid'";

        mysqli_query($connection, $sql);

        $_SESSION['ulocation'] = $ulocation;

        header('Location: ./../view/index.php');
    }
}
?>

