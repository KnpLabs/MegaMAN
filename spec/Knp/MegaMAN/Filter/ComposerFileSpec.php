<?php

namespace spec\Knp\MegaMAN\Filter;

use Knp\MegaMAN\Filter\ComposerFile;
use PhpSpec\ObjectBehavior;

class ComposerFileSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ComposerFile::class);
    }

    function it_add_existing_composer_files()
    {
        $root     = dirname(dirname(dirname(dirname(__DIR__))));
        $readme   = sprintf('%s/README.md', $root);
        $composer = sprintf('%s/composer.json', $root);

        $this([['readme' => $readme]])->shouldReturn([['readme' => $readme, 'composer' => $composer]]);
    }
}
