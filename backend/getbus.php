<?php
function getBusData($conn, $sourceAddress, $destinationAddress) {
    $sql = "SELECT bid, bname, price, haswifi, hasac, source, destination, pickuplocations 
            FROM buses 
            WHERE source='$sourceAddress' AND destination='$destinationAddress'";
    
    return execSql($conn, $sql);
}

function getBusById($conn, $bid) {
    $sql = "SELECT bid, bname, price, haswifi, hasac, source, destination, pickuplocations 
            FROM buses 
            WHERE bid='$bid'";
    
    return execSql($conn, $sql);
}

function execSql($conn, $sql) {
    try {
        $result = mysqli_query($conn, $sql);
        $data = array();
        $i = 0;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$i] = array(
                    'bid' => $row["bid"],
                    'bname' => $row["bname"],
                    'ticketprice' => $row["price"],
                    'haswifi' => $row["haswifi"],
                    'hasac' => $row["hasac"],
                    'source' => $row["source"],
                    'destination' => $row["destination"],
                    'pickuplocations' => $row["pickuplocations"]
                );
                $i++;
            }
        }
        return $data;
    } 
    catch (Exception $e) {
        echo $e;
        return null;
    }
}
?>
