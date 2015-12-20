<?php
namespace Gen;

use PHPUnit_Framework_TestCase;

class RoadmapTest extends PHPUnit_Framework_TestCase
{
    public function testGetDistance()
    {
        $roadmap = new Roadmap([
            new Place("Imperia", new Point(43.889686, 8.039517)),
            new Place("Sanremo", new Point(43.815967, 7.776057)),
            new Place("Ventimiglia", new Point(43.791237, 7.607586)),
        ]);

        $this->assertEquals(36.45, $roadmap->distance(), "wrong distance", 0.01);
    }
}
