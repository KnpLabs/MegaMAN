<?php

namespace spec\Knp\MegaMAN\Markdown\Processor;

use PhpSpec\ObjectBehavior;

class AbsoluteLinkSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\MegaMAN\Markdown\Processor\AbsoluteLink');
    }

    function it_add_attribute_on_absolute_urls()
    {
        $this
            ->process('<html><body><a href="http://google.fr">Google</a></body></html>')
            ->shouldReturn('<html><body><a target="_blank" href="http://google.fr">Google</a></body></html>')
        ;
    }

    function it_doenst_alterate_other_urls()
    {
        $this
            ->process('<html><body><a href="CONTRIBUTING.md">Google</a></body></html>')
            ->shouldReturn('<html><body><a href="CONTRIBUTING.md">Google</a></body></html>')
        ;
    }
}
