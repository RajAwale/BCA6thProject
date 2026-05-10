<?php

function getSeatStatus($conn, $busId, $seatNo) {

    $sql = "SELECT isbooked
            FROM seats 
            WHERE bid='$busId' AND seatno='$seatNo'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row['isbooked'];
}


function bookSeat($conn, $bid, $seatNo, $uid, $pidx) {

    // Update seat as booked
    $sql = "UPDATE seats 
            SET isbooked='1'
            WHERE bid='$bid' AND seatno='$seatNo'";

    $result = mysqli_query($conn, $sql);

    return $result;
}

?>