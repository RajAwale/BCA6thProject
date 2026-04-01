<?php
function getSeatStatus($conn, $busId, $seatNo) {
    $sql = "SELECT isbooked
        FROM seats 
        WHERE bid='$busId' AND seatno='$seatNo'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    return $row['isbooked'];
}
?>
