<?php

namespace spec\Knp\MegaMAN\Markdown\Processor;

use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RelativeLinkSpec extends ObjectBehavior
{
    function let(UrlGeneratorInterface $generator, RequestStack $stack, Request $request, ParameterBag $attributes, ParameterBag $query)
    {
        $attributes->get('token')->willReturn('token');
        $query->get('panel')->willReturn('panel');
        $query->get('package')->willReturn('package');

        $request->attributes = $attributes;
        $request->query      = $query;

        $stack->getMasterRequest()->willReturn($request);

        $this->beConstructedWith($generator, $stack);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Knp\MegaMAN\Markdown\Processor\RelativeLink');
    }

    function it_transform_relatives_urls($generator)
    {
        $generator
            ->generate('_profiler', ['token' => 'token', 'panel' => 'panel', 'package' => 'package'])
            ->willReturn('profiler/token?package=package&panel=panel')
        ;

        $this
            ->process('<html><body><a href="CONTRIBUTING.md">Google</a></body></html>')
            ->shouldReturn('<html><body><a href="profiler/token?package=package&panel=panel&page=CONTRIBUTING.md">Google</a></body></html>')
        ;
    }

    function it_doesnt_alterate_other_urls()
    {
        $this
            ->process('<html><body><a href="http://google.fr">Google</a></body></html>')
            ->shouldReturn('<html><body><a href="http://google.fr">Google</a></body></html>')
        ;

        $this
            ->process('<html><body><a href="#top">Top of the page</a></body></html>')
            ->shouldReturn('<html><body><a href="#top">Top of the page</a></body></html>')
        ;
    }
}
