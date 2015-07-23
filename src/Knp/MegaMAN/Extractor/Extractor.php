<?php

namespace Knp\MegaMAN\Extractor;

use Knp\MegaMAN\Extractor as ExtractorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class Extractor implements ExtractorInterface, \Serializable
{
    /**
     * @var string
     */
    private $cache;

    /**
     * @var RequestStack
     */
    private $stack;

    /**
     * @var mixed
     */
    private $json;

    /**
     * @param string       $cache
     * @param RequestStack $stack
     */
    public function __construct($cache, RequestStack $stack)
    {
        $this->cache = $cache;
        $this->stack = $stack;

        $this->extract();
    }

    /**
     * {@inheritdoc}
     */
    public function extract()
    {
        if (null !== $this->json) {
            return $this->json;
        }

        return $this->json = json_decode(file_get_contents($this->cache), true);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrent()
    {
        $dependencies = $this->extract();
        $current      = $this->stack->getMasterRequest()->get('package');

        if (null === $current) {
            foreach ($dependencies as $key => $dependency) {
                if (true === array_key_exists('local', $dependency) && true === $dependency['local']) {
                    $current = $key;
                }
            }
        }

        if (true === array_key_exists($current, $dependencies)) {
            return $dependencies[$current];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize([$this->json, $this->stack]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($value)
    {
        list($this->json, $this->stack) = unserialize($value);
    }
}
