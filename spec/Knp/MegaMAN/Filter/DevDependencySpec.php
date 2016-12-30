<?php

namespace spec\Knp\MegaMAN\Filter;

use Knp\MegaMAN\Filter\DevDependency;
use PhpSpec\ObjectBehavior;

class DevDependencySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(sprintf('%s/../../../../composer.json', __DIR__));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DevDependency::class);
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
