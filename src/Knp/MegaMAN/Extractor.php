<?php

namespace Knp\MegaMAN;

interface Extractor
{
    /**
     * @return array
     */
    public function extract();

    /**
     * @return array|null
     */
    public function getCurrent();
}
