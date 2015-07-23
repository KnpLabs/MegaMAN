<?php

namespace Knp\MegaMAN\Markdown\Processor;

use Knp\MegaMAN\Extractor;
use Knp\MegaMAN\Markdown\Processor;

class Image implements Processor
{
    /**
     * @var Extractor
     */
    private $extractor;

    /**
     * @param Extractor $extractor
     */
    public function __construct(Extractor $extractor)
    {
        $this->extractor = $extractor;
    }

    /**
     * {@inheritdoc}
     */
    public function process($html)
    {
        $matches = [];

        if (false === preg_match_all('/<img([^>]*) src="(?!http)([^"]*)"/', $html, $matches)) {
            return $html;
        }

        if (null === $current = $this->extractor->getCurrent()) {
            return $html;
        }

        list($strings, $attributes, $files) = $matches;

        foreach ($strings as $index => $string) {
            $file = $files[$index];

            $path = sprintf('%s%s%s', dirname($current['readme']), DIRECTORY_SEPARATOR, $file);

            if (false === file_exists($path)) {
                continue;
            }

            if (false === $info = getimagesize($path)) {
                continue;
            }

            $data = sprintf('data:%s;base64,%s', $info['mime'], base64_encode(file_get_contents($path)));

            $html = str_replace(
                $string,
                sprintf('<img%s style="max-width: 100%%" src="%s"', $attributes[$index], $data),
                $html
            );
        }

        return $html;
    }
}
