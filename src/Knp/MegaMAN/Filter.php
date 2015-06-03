<?php

namespace Knp\MegaMAN;

interface Filter
{
    /**
     * @param array $array
     *
     * @return array
     */
    public function __invoke(array $array);
}
