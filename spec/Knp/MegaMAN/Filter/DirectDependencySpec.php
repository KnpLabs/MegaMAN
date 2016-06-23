<?php

namespace spec\Knp\MegaMAN\Filter;

use PhpSpec\ObjectBehavior;

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
        $definitions = array(
            array('package' => 'behat/behat'),
            array('package' => 'phpspec/phpspec'),
            array('package' => 'phpspec/prophecy'),
        );

        $this($definitions)->shouldReturn(array(
            array('package' => 'behat/behat', 'direct' => false),
            array('package' => 'phpspec/phpspec', 'direct' => true),
            array('package' => 'phpspec/prophecy', 'direct' => false),
        ));
    }
}
