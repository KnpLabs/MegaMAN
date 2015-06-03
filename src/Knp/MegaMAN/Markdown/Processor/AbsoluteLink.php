<?php

namespace Knp\MegaMAN\Markdown\Processor;

use Knp\MegaMAN\Markdown\Processor;

class AbsoluteLink implements Processor
{
    /**
     * {@inheritdoc}
     */
    public function process($html)
    {
        return preg_replace('/<a([^>]*) href="http([^"]*)"/', '<a$1 target="_blank" href="http$2"', $html);
    }
}
