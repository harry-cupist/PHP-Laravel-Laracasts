<?php namespace Acme;

class AreaCalculator {

    public function calculate($shapes)
    {
        foreach ($shapes as $shape)
        {
            // if ($shape instanceof Square)
            if (is_a($shape, 'square'))
            {
                $area[] = $shapes->width * $shapes->height;
            }
            else
            {
                $area[] = $shapes->radius * $shapes->radius * pi();
            }
        }

        return array_sum($area);
    }
}
