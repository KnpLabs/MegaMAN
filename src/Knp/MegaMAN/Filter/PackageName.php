<?php

namespace Knp\MegaMAN\Filter;

use Knp\MegaMAN\Filter;

class PackageName implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(array $array)
    {
        $result = [];

        foreach ($array as $definition) {
            if (false === array_key_exists('composer', $definition)) {
                continue;
            }

            $json = json_decode(file_get_contents($definition['composer']), true);

            if (false === array_key_exists('name', $json)) {
                continue;
            }

            $definition['package'] = $json['name'];

            $result[] = $definition;
        }

        return $result;
    }
}
