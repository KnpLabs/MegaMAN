<?php

namespace Knp\MegaMAN\Filter;

use Knp\MegaMAN\Filter;

class ComposerFile implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(array $array)
    {
        $result = [];

        foreach ($array as $definition) {
            if (false === array_key_exists('readme', $definition)) {
                continue;
            }

            $composer = sprintf('%s%scomposer.json', dirname($definition['readme']), DIRECTORY_SEPARATOR);

            if (false === file_exists($composer)) {
                continue;
            }

            $definition['composer'] = $composer;
            $result[]               = $definition;
        }

        return $result;
    }
}
