<?php

namespace spec\Knp\MegaMAN\Filter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DirectDependencySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(sprintf('%s/../../../../composer.json', __DIR__));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\MegaMAN\Filter\DirectDependency');
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
