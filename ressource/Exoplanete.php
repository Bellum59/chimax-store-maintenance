<?php

class Exoplanete
{
    public $id;
    public $planete;
    public $etoile;
    public $masse;
    public $rayon;
    public $flux;
    public $temperature;
    public $periode;
    public $distance;

    private static $format = array(
        'id' => FILTER_VALIDATE_INT,
        'planete' => FILTER_SANITIZE_SPECIAL_CHARS,
        'etoile' => FILTER_SANITIZE_SPECIAL_CHARS,
        'masse' => FILTER_SANITIZE_SPECIAL_CHARS,
        'rayon' => FILTER_SANITIZE_SPECIAL_CHARS,
        'flux' => FILTER_SANITIZE_SPECIAL_CHARS,
        'temperature' => FILTER_SANITIZE_SPECIAL_CHARS,
        'periode' => FILTER_SANITIZE_SPECIAL_CHARS,
        'distance' => FILTER_SANITIZE_SPECIAL_CHARS
    );

    public function __construct($array)
    {
        $array = filter_var_array($array, Exoplanete::$format);

        $this->id = $array['id'];
        $this->planete = $array['planete'];
        $this->etoile = $array['etoile'];
        $this->masse = $array['masse'];
        $this->rayon = $array['rayon'];
        $this->flux = $array['flux'];
        $this->temperature = $array['temperature'];
        $this->periode = $array['periode'];
        $this->distance = $array['distance'];
    }
}
