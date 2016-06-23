<?php

namespace spec\Knp\MegaMAN\Filter;

use PhpSpec\ObjectBehavior;

class SourceUrlSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('');

        $this->shouldHaveType('Knp\MegaMAN\Filter\SourceUrl');
    }

    function it_add_source_url_to_definitions()
    {
        $root      = dirname(dirname(dirname(dirname(__DIR__))));
        $installed = sprintf('%s/vendor/composer/installed.json', $root);

        $this->beConstructedWith($installed);

        $this(array(
            array('package' => 'phpspec/phpspec'),
            array('package' => 'phpspec/other'),
        ))->shouldReturn(array(
            array('package' => 'phpspec/phpspec', 'url' => 'https://github.com/phpspec/phpspec.git'),
            array('package' => 'phpspec/other', 'url' => ''),
        ));
    }
}
