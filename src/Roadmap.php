<?php
namespace Gen;

class Roadmap
{
    public $places;

    public function __construct(array $places)
    {
        $this->places = $places;
    }

    public function getPlaces()
    {
        return $this->places;
    }

    public function distance()
    {
        $distance = 0;

        for ($i=0; $i<count($this->places)-1; $i++) {
            $distance += Distance::between($this->places[$i]->point, $this->places[$i+1]->point);
        }

        return $distance;
    }
}
