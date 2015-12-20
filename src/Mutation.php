<?php
namespace Gen;

class Mutation
{
    public function mutate(Roadmap $roadmap)
    {
        list($one, $two) = $this->seed(count($roadmap->places));

        $places = $roadmap->places;

        $tmp = $places[$one];
        $places[$one] = $places[$two];
        $places[$two] = $tmp;

        return new Roadmap($places);
    }

    protected function seed($elems)
    {
        $one = rand(1, $elems) - 1;
        do {
            $two = rand(1, $elems) - 1;
        } while($two == $one);

        return [$one, $two];
    }
}
