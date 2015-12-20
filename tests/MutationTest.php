<?php
namespace Gen;

class MutationTest extends \PHPUnit_Framework_TestCase
{
    public function testMutate()
    {
        $mutator = $this->getMockBuilder("Gen\Mutation")
            ->setMethods(["seed"])
            ->getMock();
        $mutator->expects($this->once())
            ->method("seed")
            ->willReturn([0,1]);

        $roadmap = new Roadmap([1,2,3,4,5,6,7]);
        $mutateRoadmap = $mutator->mutate($roadmap);

        $this->assertEquals([2,1,3,4,5,6,7], $mutateRoadmap->places);
        $this->assertEquals([1,2,3,4,5,6,7], $roadmap->places);
    }
}
