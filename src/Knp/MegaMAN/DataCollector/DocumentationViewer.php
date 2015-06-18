<?php

namespace Knp\MegaMAN\DataCollector;

use Knp\MegaMAN\Extractor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class DocumentationViewer implements DataCollectorInterface, \Serializable
{
    const NAME = 'megaman';

    /**
     * @var Extractor
     */
    private $cache;

    /**
     * @param Extractor $cache
     */
    public function __construct(Extractor $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return $this->cache->extract();
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
        return serialize($this->cache);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($value)
    {
        $this->cache = unserialize($value);
    }
}
