<?php
namespace Gen;

class Life
{
    private $mutator;
    private $recombine;
    private $generation;
    private $solutions = 1000;

    public function __construct(Mutation $mutator, Recombination $recombine)
    {
        $this->mutator = $mutator;
        $this->recombine = $recombine;
        $this->setGeneration(10000);
    }

    public function setGeneration($generation)
    {
        $this->generation = $generation;
    }

    public function getShortestPath(Roadmap $roadmap)
    {
        $life = $this->createLifeFor($roadmap);

        for ($i=0; $i<$this->generation; $i++) {
            $times = $this->solutions * 30 /100;
            for (;$times > 0;$times--) {
                switch(rand(1,2)) {
                case 1:
                    $pos1 = rand(1, count($this->solutions))-1;
                    $pos2 = rand(1, count($this->solutions))-1;
                    list($child1, $child2) = $this->recombine->reproduction($life[$pos1], $life[$pos2]);
                    $life[$pos1] = $child1;
                    $life[$pos2] = $child2;
                    break;
                case 2:
                    $pos = rand(1, count($life))-1;
                    $life[$pos] = $this->mutator->mutate($life[$pos]);
                    break;
                }
            }
        }

        return $this->sortRoadmaps($life)[0];
    }

    private function sortRoadmaps($roadmaps)
    {
        usort($roadmaps, function($a, $b) { return $a->distance() <=> $b->distance(); });
        return $roadmaps;
    }

    private function createLifeFor(Roadmap $roadmap)
    {
        $solutions = [$roadmap, $this->mutator->mutate($roadmap)];
        while(count($solutions) < $this->solutions) {
            switch(rand(1, 2)) {
                case 1:
                    $solutions = array_merge($solutions, [$this->mutator->mutate($solutions[rand(1, count($solutions))-1])]);
                    break;
                case 2:
                    $solutions = array_merge(
                        $solutions,
                        $this->recombine->reproduction(
                            $solutions[rand(1, count($solutions))-1],
                            $solutions[rand(1, count($solutions))-1]
                        )
                    );
                    break;
            }
        }

        return $solutions;
    }
}
