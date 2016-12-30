<?php

namespace spec\Knp\MegaMAN\Filter;

use Knp\MegaMAN\Filter\DirectDependency;
use PhpSpec\ObjectBehavior;

class DirectDependencySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(sprintf('%s/../../../../composer.json', __DIR__));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DirectDependency::class);
    }

    function it_can_deduce_direct_deps()
    {
        $definitions = [
            ['package' => 'behat/behat'],
            ['package' => 'phpspec/phpspec'],
            ['package' => 'phpspec/prophecy'],
        ];

        $this($definitions)->shouldReturn([
            ['package' => 'behat/behat', 'direct' => false],
            ['package' => 'phpspec/phpspec', 'direct' => true],
            ['package' => 'phpspec/prophecy', 'direct' => false],
        ]);
    }
}
