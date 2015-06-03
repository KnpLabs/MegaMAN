<?php

namespace spec\Knp\MegaMAN\Filter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ComposerFileSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\MegaMAN\Filter\ComposerFile');
    }

    function it_add_existing_composer_files()
    {
        $root     = dirname(dirname(dirname(dirname(__DIR__))));
        $readme   = sprintf('%s/README.md', $root);
        $composer = sprintf('%s/composer.json', $root);

        $this([['readme' => $readme]])->shouldReturn([['readme' => $readme, 'composer' => $composer]]);
    }
}
