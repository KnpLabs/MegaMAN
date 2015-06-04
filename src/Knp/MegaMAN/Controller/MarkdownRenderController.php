<?php

namespace Knp\MegaMAN\Controller;

use Knp\MegaMAN\Markdown\Processor;
use Michelf\MarkdownExtra;
use Symfony\Component\HttpFoundation\Response;

class MarkdownRenderController
{
    /**
     * @var Processor[]
     */
    private $processors;

    public function __construct()
    {
        $this->processors = [];
    }

    /**
     * @param Processor $processor
     */
    public function addProcessor(Processor $processor)
    {
        $this->processors[] = $processor;
    }

    /**
     * @param string      $file
     * @param string|null $page
     *
     * @return Response
     */
    public function renderAction($file, $page = null)
    {
        if (null !== $page) {
            $file = sprintf('%s/%s', dirname($file), $page);
        }

        $html = MarkdownExtra::defaultTransform(file_get_contents($file));

        foreach ($this->processors as $processor) {
            $html = $processor->process($html);
        }

        return new Response($html);
    }
}
