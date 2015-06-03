<?php

namespace spec\Knp\MegaMAN\Filter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Yaml\Parser;

class PackageNameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\MegaMAN\Filter\PackageName');
    }

    function it_inject_name_into_description()
    {
        $definitions = [
            ['composer' => sprintf('%s/../../../../composer.json', __DIR__)],
        ];

        $this($definitions)->shouldReturn([
            ['composer' => sprintf('%s/../../../../composer.json', __DIR__), 'package' => 'knplabs/mega-man'],
        ]);
    }
}
