<?php

class Smoking
{
    private $areaName;
    private $numerator;
    private $denominator;
    private $indicator;
    private $geo = [];
    private $mapURL;

    public function __construct($AreaName, $Numerator, $Denominator, $Indicator, $Geo, $MapURL)
    {
        $this->areaName = $AreaName;
        $this->numerator = $Numerator;
        $this->denominator = $Denominator;
        $this->indicator = $Indicator;
        $this->geo = $Geo;
        $this->mapURL = $MapURL;
    }
    public function AreaName()
    {
        return $this->areaName;
    }

    public function Numerator()
    {
        return $this->numerator;
    }
    public function Denominator()
    {
        return $this->denominator;
    }
    public function Indicator()
    {
        return $this->indicator;
    }
    public function Geo(): array
    {
        return $this->geo;
    }
    public function MapURL()
    {
        return $this->mapURL;
    }
}