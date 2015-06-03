<?php

namespace Knp\MegaMAN\Markdown\Processor;

use Knp\MegaMAN\Markdown\Processor;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RelativeLink implements Processor
{
    /**
     * @var UrlGeneratorInterface
     */
    private $generator;

    /**
     * @var RequestStack
     */
    private $stack;

    /**
     * @param UrlGeneratorInterface $generator
     */
    public function __construct(UrlGeneratorInterface $generator, RequestStack $stack)
    {
        $this->generator = $generator;
        $this->stack     = $stack;
    }

    /**
     * {@inheritdoc}
     */
    public function process($html)
    {
        $request = $this->stack->getMasterRequest();

        $params = [
            'token'   => $request->attributes->get('token'),
            'panel'   => $request->query->get('panel'),
            'package' => $request->query->get('package'),
        ];

        $url = $this->generator->generate('_profiler', $params);

        return preg_replace('/<a([^>]*) href="(?!http|#)([^"]*)"/', sprintf('<a$1 href="%s&page=$2"', $url), $html);
    }
}
