<?php

namespace Knp\MegaMAN\Filter;

use Knp\MegaMAN\Filter;

class LocalProject implements Filter
{
    /**
     * @var string
     */
    private $readme;

    /**
     * @var string
     */
    private $composer;

    /**
     * @param string $readme
     * @param string $composer
     */
    public function __construct($readme, $composer)
    {
        $this->readme   = $readme;
        $this->composer = $composer;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(array $array)
    {
        if (false === file_exists($this->readme)) {
            return $array;
        }

        if (false === file_exists($this->composer)) {
            return $array;
        }

        $json = json_decode(file_get_contents($this->composer), true);

        $array[] = [
            'composer' => $this->composer,
            'dev'      => null,
            'direct'   => null,
            'local'    => true,
            'package'  => $json['name'],
            'readme'   => $this->readme,
            'version'  => 'local',
        ];

        return $array;
    }
}
