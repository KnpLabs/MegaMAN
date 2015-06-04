<?php

namespace Knp\MegaMAN\DataCollector;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class DocumentationViewer implements DataCollectorInterface, \Serializable
{
    const NAME = 'megaman';

    /**
     * @var string
     */
    private $cache;

    /**
     * @param string $cache
     */
    public function __construct($cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        $data = json_decode(file_get_contents($this->cache), true);

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return $this->cache;
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($value)
    {
        $this->cache = $value;
    }
}
