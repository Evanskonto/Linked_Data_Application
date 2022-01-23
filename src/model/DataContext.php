<?php

include_once 'Smoking_Plymouth.php';

class DataContext
{
    public function Plymouth_Smoking(): array
    {
        //Extract the data and return all items as an array.
        $smoking = [];

        $fileSmoking = fopen('../assets/data/Smoking.csv','r');
        if($fileSmoking)
        {
            $LineCounter = 0;

            while($data = fgetcsv($fileSmoking, 100, ","))
            {

                if ($LineCounter > 0) {
                    $mapURL = "";
                    $geo = $this->getGeo($data[0],$mapURL);
                    $smk = new Smoking($data[0], $data[1], $data[2],$data[3], $geo, $mapURL );
                    $smoking[] = $smk;
                }
                $LineCounter++;
            }
        }

        return $smoking;
    }

    public function getGeo($AreaName, &$map): array
    {
        $geo = array();
        try {
            $AreaName .= ", Plymouth, United Kingdom";
            $URI = 'https://open.mapquestapi.com/geocoding/v1/address?key=hFG5vCBvXaNpsx36ApAFiRKY8bucLDQY&location=' .urlencode($AreaName);
            $response = file_get_contents($URI);
            $data = json_decode($response, true);
            $geo = ["lat" => $data["results"][0]["locations"][0]["latLng"]["lat"], "lng"=> $data["results"][0]["locations"][0]["latLng"]["lng"]];
            $map = $data["results"][0]["locations"][0]["mapUrl"];

        }catch(Exception $e)
        {
            echo $e->message();
        }

        return $geo;
    }


}