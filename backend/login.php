<?php 
    if($_POST){
        session_start();
        
        $formEmail=$_POST['email'];
        $formPassword=$_POST['password'];
        $encryptedPw=md5($formPassword);
        
        include "connection.php";

        if($connection){  
            $sql="SELECT uname, id, ulocation FROM users WHERE email='$formEmail' AND pw='$encryptedPw'";
            $result=mysqli_query($connection, $sql);

            if(mysqli_num_rows($result) == 1) {
                if($formEmail == "admin@mahabus.com"){
                    $_SESSION['admin'] = true;

                    header("Location: ./../admin/index.php");
                }
                else{
                    $row=$result->fetch_assoc();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = explode(" ",$row['uname'])[0];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['ulocation'] = $row['ulocation'] ? $row['ulocation'] : "empty";
                    
                    header("Location: ./../view/index.php");
                }
            }
            else {
                echo("Cannot log in");
            }
        }
        mysqli_close($connection);
    }
?>