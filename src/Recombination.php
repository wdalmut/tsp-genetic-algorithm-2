<?php
namespace Gen;

class Recombination
{
    private $one, $two;

    public function reproduction(Roadmap $one, Roadmap $two)
    {
        list($one, $two) = $this->crossover($one->places, $two->places);

        return [new Roadmap($one), new Roadmap($two)];
    }

    // One point crossover
    private function crossover(array $one, array $two)
    {
        return [$this->swap($one, $two), $this->swap($two, $one)];
    }

    private function swap($one, $two)
    {
        $pos = $this->getSplitPoint(count($one));

        $elem = $one[$pos];
        $over = array_search($elem, $two);

        $tmp = $one[$pos];
        $one[$pos] = $one[$over];
        $one[$over] = $tmp;

        return $one;
    }

    protected function getSplitPoint($total)
    {
        return rand(1, $total)-1;
    }
}
