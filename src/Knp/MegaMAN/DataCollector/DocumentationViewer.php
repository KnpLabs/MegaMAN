<?php

namespace Knp\MegaMAN\DataCollector;

use Knp\MegaMAN\Markdown\Processor;
use Michelf\MarkdownExtra;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

class DocumentationViewer implements DataCollectorInterface, \Serializable
{
    const NAME = 'megaman';

    /**
     * @var string
     */
    private $cache_file;

    /**
     * @param string $cache_file
     */
    public function __construct($cache_file)
    {
        $this->cache_file = $cache_file;
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        $data     = json_decode(file_get_contents($this->cache_file), true);

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
        return $this->cache_file;
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($value)
    {
        $this->cache_file = $value;
    }
}
