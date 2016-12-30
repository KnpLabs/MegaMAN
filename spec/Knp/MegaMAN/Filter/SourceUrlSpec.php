<?php

namespace spec\Knp\MegaMAN\Filter;

use Knp\MegaMAN\Filter\SourceUrl;
use PhpSpec\ObjectBehavior;

class SourceUrlSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('');

        $this->shouldHaveType(SourceUrl::class);
    }

    function it_add_source_url_to_definitions()
    {
        $root      = dirname(dirname(dirname(dirname(__DIR__))));
        $installed = sprintf('%s/vendor/composer/installed.json', $root);

        $this->beConstructedWith($installed);

        $this([
            ['package' => 'phpspec/phpspec'],
            ['package' => 'phpspec/other'],
        ])->shouldReturn([
            ['package' => 'phpspec/phpspec', 'url' => 'https://github.com/phpspec/phpspec.git'],
            ['package' => 'phpspec/other', 'url' => ''],
        ]);
    }
}
