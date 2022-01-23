<?php

include_once 'header.php';

?>
<body>
<!-- Header with image -->
<style>
    body, html {
        height: 101%;
        font-family: "Inconsolata", sans-serif;
    }
    .img {
        background-position: center;
        background-size: cover;
        background-image: url("../assets/img/Smoking.jpg");
        min-height: 600px;

    }

</style>
<header class="img" id="home">
</header>
<!-- Add the large text to the whole page -->
<div class="container-fluid mt-5 px-5">
    <div class="row">
        <div class="col-sm-12">
            <h1>Welcome to the Smoking in Plymouth Website</h1>
            <p>This Plymouth smoking web application shows the number of people in each Plymouth ward that have answered the Health and Wellbeing Survey.
                People who say they smoke and the numbers reported in what ward including the total people in the ward.
            </p>
            <p>
                The data page provides a human readable interface to the data.  To access the machine readable
                linked data markup, please call the resource <b>Linked_Data_Application</b>
                <a href=http://localhost/Linked_Data_Application/smoking/Index.php>http://localhost/Linked_Data_Application/smoking/Index.php </a>
                This will provide you with the JSON-LD markup for all smoking areas in Plymouth.
            </p>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"><a href="data.php" class="btn btn-info">View Data</a></div>

        <div class="col-sm-8"></div>
    </div>
</div>
</body>

<?php include_once 'footer.php'; ?>
