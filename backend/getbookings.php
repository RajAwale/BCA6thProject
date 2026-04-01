<?php
    function getUserBookings($connection, $uid) {
        $sql = "SELECT *
                FROM bookings bo 
                JOIN buses b ON bo.bid = b.bid
                JOIN seats s ON bo.sid = s.sid
                WHERE bo.uid = '$uid'";
        $result = mysqli_query($connection, $sql);

        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        }

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?>
