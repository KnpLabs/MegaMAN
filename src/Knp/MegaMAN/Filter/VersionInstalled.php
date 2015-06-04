<?php

namespace Knp\MegaMAN\Filter;

use Knp\MegaMAN\Filter;

class VersionInstalled implements Filter
{
    /**
     * @var string
     */
    private $installed;

    /**
     * @param string $installed
     */
    public function __construct($installed)
    {
        $this->installed = $installed;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(array $array)
    {
        $result = [];
        $json   = json_decode(file_get_contents($this->installed), true);

        foreach ($array as $definition) {
            if (false === array_key_exists('package', $definition)) {
                continue;
            }

            foreach ($json as $installed) {
                if ($installed['name'] === $definition['package']) {
                    $definition['version'] = $installed['version'];
                    $result[]              = $definition;
                }
            }
        }

        return $result;
    }
}
