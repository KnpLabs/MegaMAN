<?php

namespace spec\Knp\MegaMAN\Filter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DevDependencySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(sprintf('%s/../../../../composer.json', __DIR__));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\MegaMAN\Filter\DevDependency');
    }

    function it_can_deduce_direct_deps()
    {
        $definitions = [
            ['package' => 'symfony/kernel'],
            ['package' => 'phpspec/phpspec'],
            ['package' => 'symfony/dependency-injection'],
        ];

        $this($definitions)->shouldReturn([
            ['package' => 'symfony/kernel', 'dev' => false],
            ['package' => 'phpspec/phpspec', 'dev' => true],
            ['package' => 'symfony/dependency-injection', 'dev' => false],
        ]);
    }
}
