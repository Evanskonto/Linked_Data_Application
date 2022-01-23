<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../src/model/DataContext.php';
include_once '../src/model/Smoking_Plymouth.php';

if(!isset($db)) {
    $db = new DataContext();
}

$smoking = $db->Plymouth_Smoking();

if($smoking)
{
    $code = 200;
    header_remove();
    http_response_code($code);
    header('Content-Type: application/json');
    header('Status: '.$code);

    echo getSemanticMarkup($smoking);
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No meadows found.")
    );
}

function getSemanticMarkup($response)
{
    $SemanticResult = '{ "@context" : { "Place" : "http://schema.org", "mdw" : "http://web.socem.plymouth.ac.uk" }, "Place" : [ ';

    foreach($response as $smoking1)
    {
        $SemanticResult .= '{ "@type" : "Place",
                "geo": {
                    "@type" : "GeoCoordinates",
                    "latitude" : '.$smoking1->Geo()["lat"].',
                    "longitude" : '.$smoking1->Geo()["lng"].'
                 },
                "AreaName" : "'.$smoking1->AreaName().'",
                "smk:Numerator" : "'.$smoking1->Numerator().'",
                "smk:Denominator" : "'.$smoking1->Denominator().'",
                "smk:Indicator" : "'.$smoking1->Indicator().'"},';
    }
    //remove the traliing comma from the end
    $SemanticResult = substr($SemanticResult, 0, -1);
    $SemanticResult .= ']}';

    return $SemanticResult;
}

function returnJSON($response, $code)
{
    header_remove();
    http_response_code($code);
    header('Content-Type: application/json');
    header('Status: '.$code);
    return json_encode(array('status' => $code, 'message' => $response));
}