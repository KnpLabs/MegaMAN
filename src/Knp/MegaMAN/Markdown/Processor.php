<?php

namespace Knp\MegaMAN\Markdown;

interface Processor
{
    /**
     * @param string $html
     *
     * @return string
     */
    public function process($html);
}
