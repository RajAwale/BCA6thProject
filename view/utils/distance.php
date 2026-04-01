<?php
    function degToRad($deg) {
        return ($deg * pi()) / 180;
    }

    function findDistance($lat1, $lon1, $lat2, $lon2) {
        $radius = 6371; 
        $dLat = degToRad($lat2 - $lat1);
        $dLon = degToRad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(degToRad($lat1)) * cos(degToRad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $radius * $c;

        return $d;
    }

    function getPlaceNameFromCoordinates($latitude, $longitude) {
        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=$latitude&lon=$longitude&accept-language=en";
        
        $options = [
            'http' => [
                'header' => "User-Agent: MahaBus/1.0 (rubekmhzn7@gmail.com)\r\n"
            ]
        ];
        $context = stream_context_create($options);
    
        $response = file_get_contents($url, false, $context);
        
        if ($response === FALSE) {
            return "Failed to get a response from the API";
        }
    
        $responseData = json_decode($response, true);
        
        if (isset($responseData['display_name'])) {
            return $responseData['display_name'];
        } else {
            return "Place not found";
        }
    }

    function bestPickup($ulocation, $coordsArray) {
        $distances = [];
        $corrCoords = [];

        foreach($coordsArray as $coords){
            array_push($distances, findDistance($ulocation[0], $ulocation[1], $coords[0], $coords[1]));
            array_push($corrCoords, [(float)$coords[0], (float)$coords[1]]);
        }
        
        $min = min($distances);
        $i = array_search(min($distances), $distances);

        return getPlaceNameFromCoordinates(number_format($corrCoords[$i][0], 2), number_format($corrCoords[$i][1], 2));
    }
?>
