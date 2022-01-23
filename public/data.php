<?php

include_once 'header.php';
include_once '../src/model/DataContext.php';
include_once '../src/model/Smoking_Plymouth.php';

if(!isset($db)) {
    $db = new DataContext();
}

$coordinates = [];

?>
<body></body>
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
            integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
            crossorigin=""></script>
    <title>
        Smoking in Plymouth
    </title>
</head>
<body>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Data</li>
    </ol>
</nav>

<div class="container-fluid col-md-12">
    <h1>Public Health Plymouth/Smoking Survey 2014</h1>
    <p>This data is displayed from the csv data set provided from the Plymouth OpenData repository
        found here.  <a href="https://plymouth.thedata.place/dataset/smoking-2014-wellbeing-survey">
            https://plymouth.thedata.place/dataset/smoking-2014-wellbeing-survey</a></p>
    <p>The location coordinates and the markers on the map are provided by the MapQuest Geocoding API.  The
        request is made using the Name entered into the csv file.  Not
        all locations returned are correct and caution should be employed.</p>
    <p>Numerator value is the Total number of people that reported they smoke and in what ward</p>
    <p>Denominator value is the Total number of people in each Plymouth ward</p>
    <p>Indicator value is the percentage that represents each in the ward</p

    <div class="container-fluid col-12">
        <div class="row">
            <div class="col-6">
                <table class="table table-striped table-bordered border-success">
                    <thead class="bg-success text-white">
                    <tr>
                        <th>AreaName</th>
                        <th>Numerator</th>
                        <th>Denominator</th>
                        <th>Indicator</th>
                    </tr>
                    </thead>
                    <tbody class="border-success">

                    <?php
                    $HTML = "";
                    $smoking1 = $db->Plymouth_Smoking();
                    if($smoking1)
                    {
                        foreach($smoking1 as $smoking2)
                        {
                            $HTML .= "<tr>";
                            $HTML .= "<td><a href='".$smoking2->MapURL()."' target=\"_blank\">".$smoking2->AreaName()."</a></td>";

                            $HTML .= "<td>".$smoking2->Numerator()."</td>";
                            $HTML .= "<td>".$smoking2->Denominator()."</td>";
                            $HTML .= "<td>".$smoking2->Indicator()."</td>";
                            $coords [] = [$smoking2->Geo()["lat"], $smoking2->Geo()["lng"], $smoking2->AreaName()];
                        }
                    }
                    echo $HTML;

                    ?>
                    <style>
                        tbody{
                        height: 140%;
                        }
                    </style>
                    </tbody>
                </table>
            </div>
            <div class="col-1">

            </div>
            <div class="col-5">
                <div id="MapID" style="width: 100%; height: 500px;"></div>
                <script>
                    let map = L.map('MapID').setView([50.375406, -4.138342], 13);

                    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        maxZoom: 18,
                        id: 'mapbox/streets-v11',
                        tileSize: 512,
                        zoomOffset: -1,
                        accessToken:  'pk.eyJ1Ijoic2hpcmxleWF0a2luc29uIiwiYSI6ImNrZHg2NjhvMjJ5dmsyeHR2YnN3NzZ3ZjMifQ.XX8CY4KiuLA1X_-2HlhZpg'
                    }).addTo(map);

                    let coord12 = <?php echo json_encode($coordinates, JSON_PRETTY_PRINT) ?>;

                    coord12.forEach(createMarkers);
                    let marker;

                    function createMarkers(item)
                    {
                        marker = L.marker([item[0], item[1], item[3]]).addTo(map).bindPopup("<b>" + item[2] + "</b>");
                    }
                </script>
            </div>
        </div>
    </div>
</div>


<?php include_once 'footer.php'; ?>
