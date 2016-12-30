<?php

namespace spec\Knp\MegaMAN\Markdown\Processor;

use Knp\MegaMAN\Extractor;
use PhpSpec\ObjectBehavior;

class ImageSpec extends ObjectBehavior
{
    function let(Extractor $extractor)
    {
        $extractor->getCurrent()->willReturn([
            'readme' => sprintf('%s/../../../../../README.md', __DIR__),
        ]);

        $this->beConstructedWith($extractor);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\MegaMAN\Markdown\Processor\Image');
    }

    function it_replaces_local_images()
    {
        $html =
<<<'HTML'
<html>
    <img src="http://google.com/favicon.png" />
    <img src="fixtures/pixel.png" />
</html>
HTML;

        $result =
<<<'HTML'
<html>
    <img src="http://google.com/favicon.png" />
    <img style="max-width: 100%" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAABlBMVEX///8AAABVwtN+AAAAAWJLR0QAiAUdSAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB98GDxQyNsF6K+gAAAAKSURBVAjXY2AAAAACAAHiIbwzAAAAAElFTkSuQmCC" />
</html>
HTML;

        $this->process($html)->shouldReturn($result);
    }
}
