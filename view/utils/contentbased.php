<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function analyzeUserPreferences($bookings) {
    $totalPrice = 0;
    $count = count($bookings);
    $wifiCount = 0;
    $acCount = 0;

    foreach ($bookings as $booking) {
        $totalPrice += $booking['price'];
        if ($booking['haswifi']) {
            $wifiCount++;
        }
        if ($booking['hasac']) {
            $acCount++;
        }
    }

    $averagePrice = $count > 0 ? $totalPrice / $count : 0;
    $wifiPreference = $wifiCount > $count / 2; 
    $acPreference = $acCount > $count / 2; 

    return [
        'averagePrice' => $averagePrice,
        'wifiPreference' => $wifiPreference,
        'acPreference' => $acPreference,
    ];
}

function sortBusesByUserPreferences($buses, $preferences) {
    usort($buses, function($a, $b) use ($preferences) {
        $priceDiffA = abs($preferences['averagePrice'] - $a['ticketprice']);
        $priceDiffB = abs($preferences['averagePrice'] - $b['ticketprice']);

        if ($priceDiffA != $priceDiffB) {
            return $priceDiffA <=> $priceDiffB; 
        }
        if ($a['haswifi'] !== $b['haswifi']) {
            return ($a['haswifi'] === true) ? -1 : 1; 
        }
        if ($a['hasac'] !== $b['hasac']) {
            return ($a['hasac'] === true) ? -1 : 1; 
        }

        return strcmp($a['bname'], $b['bname']);
    });

    return $buses;
}

function contentBased($buses, $bookings){
    $preferences = analyzeUserPreferences($bookings);
    $sortedBuses = sortBusesByUserPreferences($buses, $preferences);

    return $sortedBuses;
}
?>
