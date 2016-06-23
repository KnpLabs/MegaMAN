<?php

namespace spec\Knp\MegaMAN\Filter;

use PhpSpec\ObjectBehavior;

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
        $definitions = array(
            array('package' => 'symfony/kernel'),
            array('package' => 'phpspec/phpspec'),
            array('package' => 'symfony/dependency-injection'),
        );

        $this($definitions)->shouldReturn(array(
            array('package' => 'symfony/kernel', 'dev' => false),
            array('package' => 'phpspec/phpspec', 'dev' => true),
            array('package' => 'symfony/dependency-injection', 'dev' => false),
        ));
    }
}
