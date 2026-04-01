<?php
    include "connection.php";

    if($connection){    
        // $sql="CREATE table users(
        //     id INT PRIMARY KEY AUTO_INCREMENT,
        //     uname VARCHAR(25) NOT NULL,
        //     email VARCHAR(50) NOT NULL,
        //     phone VARCHAR(12) NOT NULL,
        //     pw VARCHAR(50) NOT NULL,
        //     ulocation VARCHAR(250) 
        // )";

        // $sql="ALTER TABLE users ADD ulocation VARCHAR(250)";
        
        // $sql="CREATE table buses(
        //     bid INT PRIMARY KEY AUTO_INCREMENT,
        //     bname VARCHAR(100) NOT NULL,
        //     price INT NOT NULL,
        //     haswifi BOOLEAN NOT NULL,
        //     hasac BOOLEAN NOT NULL,
        //     source VARCHAR(50) NOT NULL,
        //     destination VARCHAR(50) NOT NULL,
        //     pickup_locations VARCHAR(500)
        // )";

        // $sql="ALTER TABLE buses ADD pickup_locations VARCHAR(500)";

        // $sql="CREATE TABLE seats (
        //     sid INT PRIMARY KEY AUTO_INCREMENT,
        //     bid INT,
        //     seatno VARCHAR(10),
        //     isbooked BOOLEAN DEFAULT FALSE,
        //     bookedbyuid INT,
        //     FOREIGN KEY (bid) REFERENCES buses(bid)
        // )";

        // $sql="CREATE TABLE bookings(
        //     boid INT PRIMARY KEY AUTO_INCREMENT,
        //     bid INT,
        //     sid INT,
        //     uid INT,
        //     bookingtime DATETIME DEFAULT CURRENT_TIMESTAMP,
        //     FOREIGN KEY (bid) REFERENCES buses(bid),
        //     FOREIGN KEY (sid) REFERENCES seats(sid)
        // )";
        
        mysqli_query($connection, $sql);

        echo("successful");
    }    
    mysqli_close($connection);
?>