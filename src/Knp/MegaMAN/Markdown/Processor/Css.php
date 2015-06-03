<?php

namespace Knp\MegaMAN\Markdown\Processor;

use Knp\MegaMAN\Markdown\Processor;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

class Css implements Processor
{
    /**
     * @var CssToInlineStyles
     */
    private $inliner;

    /**
     * @var string
     */
    private $css;

    /**
     * @param CssToInlineStyles $inliner
     * @param string|null       $css
     */
    public function __construct(CssToInlineStyles $inliner, $css = null)
    {
        $this->inliner = $inliner;
        $this->css     = null !== $css ? $css : sprintf('%s/../../Resources/front/style.css', __DIR__);
    }

    /**
     * {@inheritdoc}
     */
    public function process($html)
    {
        $this->inliner->setHTML($html);
        $this->inliner->setCSS(file_get_contents($this->css));

        return $this->inliner->convert();
    }
}
