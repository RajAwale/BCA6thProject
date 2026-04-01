<?php 
    if($_POST){
        $formName=$_POST['name'];
        $formEmail=$_POST['email'];
        $formPhone=$_POST['phone'];
        $formPassword=$_POST['password'];
        $encryptedPw=md5($formPassword);

        include "connection.php";

        if($connection){    
            $sql="SELECT uname FROM users where phone='$formPhone' OR email='$formEmail'";
            $result=mysqli_query($connection, $sql);

            if(!mysqli_num_rows($result)>0){
                $sql="INSERT INTO users(uname, email, phone, pw) VALUES ('$formName', '$formEmail', '$formPhone', '$encryptedPw')";
                mysqli_query($connection, $sql);

                echo "Registration successful";
                header("Location: ./../view/index.php");
            }
            else{
                echo "Cannot register";
            }
        }    
        mysqli_close($connection);
    }
?>