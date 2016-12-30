<?php

namespace spec\Knp\MegaMAN\Filter;

use Knp\MegaMAN\Filter\LocalProject;
use PhpSpec\ObjectBehavior;

class LocalProjectSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('', '');

        $this->shouldHaveType(LocalProject::class);
    }

    function it_adds_local_readme_to_definitions()
    {
        $root     = dirname(dirname(dirname(dirname(__DIR__))));
        $readme   = sprintf('%s/README.md', $root);
        $composer = sprintf('%s/composer.json', $root);

        $this->beConstructedWith($readme, $composer);

        $this([])->shouldReturn([[
            'composer' => $composer,
            'dev'      => null,
            'direct'   => null,
            'local'    => true,
            'package'  => 'knplabs/mega-man',
            'readme'   => $readme,
            'version'  => 'local',
        ]]);
    }
}
