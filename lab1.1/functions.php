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


    function guzzlee(){
        if(!empty($_GET["lon"]) && !empty($_GET["lat"]) ){
            $lon = $_GET["lon"];
            $lat = $_GET["lat"];
            $apiKey = KEY;
            $client = new Client([]);
            $response = $client -> request('GET',"https://api.openweathermap.org/data/2.5/weather" ,['query' => ["lat" => $lat,"lon" =>  $lon , "appid" => $apiKey]]);
            $body = $response -> getBody();
            $arr = json_decode($body, true);
            return ($arr);
        }
    }
 ?>