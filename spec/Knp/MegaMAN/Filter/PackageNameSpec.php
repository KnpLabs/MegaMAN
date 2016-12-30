<?php

namespace spec\Knp\MegaMAN\Filter;

use Knp\MegaMAN\Filter\PackageName;
use PhpSpec\ObjectBehavior;

class PackageNameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(PackageName::class);
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
