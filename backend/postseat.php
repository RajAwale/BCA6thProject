<?php
if($_POST){
    $seats = $_POST['seats'];
    $uid = $_POST['uid'];
    $bid = $_POST['bid'];

    include "connection.php";

    if($connection){
        foreach($seats as $seat) {
    
            $sql= "UPDATE seats SET isbooked='1', bookedbyuid='$uid' WHERE bid='$bid' AND seatno='$seat'";

            if (mysqli_query($connection, $sql)) {
                $sql = "SELECT sid FROM seats WHERE bid = '$bid' AND seatno = '$seat'";
                $result = mysqli_query($connection, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $sid = $row['sid'];

                    $sql = "INSERT INTO bookings (bid, sid, uid) VALUES ('$bid', '$sid', '$uid')";
                    mysqli_query($connection, $sql);
                    
                }
            }
        }
        header("Location: ../view/bookings.php");
        exit();
    }
}
?>

