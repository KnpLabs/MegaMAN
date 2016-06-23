<?php

namespace Knp\MegaMAN\Filter;

use Knp\MegaMAN\Filter;

class DirectDependency implements Filter
{
    /**
     * @var string
     */
    private $composer;

    /**
     * @param string $composer
     */
    public function __construct($composer)
    {
        $this->composer = $composer;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(array $array)
    {
        $result = array();

        foreach ($array as $definition) {
            if (false === array_key_exists('package', $definition)) {
                continue;
            }

            $json = json_decode(file_get_contents($this->composer), true);
            $deps = array();

            if (true === array_key_exists('require', $json)) {
                $deps = array_merge($deps, $json['require']);
            }

            if (true === array_key_exists('require-dev', $json)) {
                $deps = array_merge($deps, $json['require-dev']);
            }

            $package              = $definition['package'];
            $definition['direct'] = array_key_exists($package, $deps);

            $result[] = $definition;
        }

        return $result;
    }
}
