<?php
    use GuzzleHttp\Client;

    function getCities(){

        $string = file_get_contents('./city.list.json');
        $cities = json_decode($string, true);
        $egypt_cities = array();
        
        foreach ($cities as $city) {
            foreach ($city as $key => $value) {
                if($key == "country" && $value == "EG")
                {
                    array_push($egypt_cities, $city);
                }
            }
        }
        return($egypt_cities);
    }

    function getWeather(){
        if(!empty($_GET)){
            $lon = $_GET["lon"];
            $lat = $_GET["lat"];
            $apiKey = KEY;
            $ApiUrl = "https://api.openweathermap.org/data/2.5/weather?lat=" . $lat . "&lon=" . $lon . "&appid=" . $apiKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $ApiUrl);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $respose = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($respose, true);
            return ($data);
        }
    }
 ?>