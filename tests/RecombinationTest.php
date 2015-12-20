<?php
namespace Gen;

class RecombinationTest extends \PHPUnit_Framework_TestCase
{
    public function testRecombine()
    {
        $r = $this->getMockBuilder("Gen\\Recombination")
            ->setMethods(["getSplitPoint"])
            ->getMock();
        $r->method("getSplitPoint")->will($this->onConsecutiveCalls(0,1));

        list($one, $two) = $r->reproduction(new Roadmap([1,2,3,4,5]), new Roadmap([3,4,1,2,5]));

        $this->assertCount(5, $one->places);
        $this->assertEquals([3,2,1,4,5], $one->places);

        $this->assertCount(5, $two->places);
        $this->assertEquals([3,2,1,4,5], $two->places);
    }
}
