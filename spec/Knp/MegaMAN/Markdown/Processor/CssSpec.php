<?php

namespace spec\Knp\MegaMAN\Markdown\Processor;

use PhpSpec\ObjectBehavior;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class CssSpec extends ObjectBehavior
{
    const CSS = 'h1 { color: white }';

    function let(CssToInlineStyles $inliner)
    {
        $file = sprintf('%s%s%s.css', sys_get_temp_dir(), DIRECTORY_SEPARATOR, spl_object_hash($this));

        file_put_contents($file, self::CSS);

        $this->beConstructedWith($inliner, $file);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\MegaMAN\Markdown\Processor\Css');
    }

    function it_should_proxify_css_inliner($inliner)
    {
        $inliner->setHTML('<html></html>')->shouldBeCalled();
        $inliner->setCSS(self::CSS)->shouldBeCalled();
        $inliner->convert()->willReturn('<html attr></html>');

        $this->process('<html></html>')->shouldReturn('<html attr></html>');
    }
}
