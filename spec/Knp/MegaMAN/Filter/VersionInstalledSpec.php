<?php

namespace spec\Knp\MegaMAN\Filter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VersionInstalledSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('');

        $this->shouldHaveType('Knp\MegaMAN\Filter\VersionInstalled');
    }

    function it_add_source_url_to_definitions()
    {
        $root      = dirname(dirname(dirname(dirname(__DIR__))));
        $installed = sprintf('%s/vendor/composer/installed.json', $root);

        $this->beConstructedWith($installed);

        foreach (json_decode(file_get_contents($installed), true) as $def) {
            if ($def['name'] === 'phpspec/phpspec') {
                $version = $def['version'];
            }
        }

        $this([
            ['package' => 'phpspec/phpspec'],
            ['package' => 'phpspec/other'],
        ])->shouldReturn([
            ['package' => 'phpspec/phpspec', 'version' => $version],
        ]);
    }
}
