<?php

namespace spec\Knp\MegaMAN\Filter;

use PhpSpec\ObjectBehavior;

class PackageNameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\MegaMAN\Filter\PackageName');
    }

    function it_inject_name_into_description()
    {
        $definitions = array(
            array('composer' => sprintf('%s/../../../../composer.json', __DIR__)),
        );

        $this($definitions)->shouldReturn(array(
            array('composer' => sprintf('%s/../../../../composer.json', __DIR__), 'package' => 'knplabs/mega-man'),
        ));
    }
}
