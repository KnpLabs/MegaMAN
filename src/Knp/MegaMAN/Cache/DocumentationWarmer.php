<?php

namespace Knp\MegaMAN\Cache;

use Knp\MegaMAN\Filter;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;

class DocumentationWarmer implements CacheWarmerInterface
{
    /**
     * @var string
     */
    private $cache;

    /**
     * @var string
     */
    private $documentation;

    /**
     * @var string
     */
    private $vendor;

    /**
     * @var Finder
     */
    private $finder;

    /**
     * @var Filter[]
     */
    private $filters;

    /**
     * @param string      $cache
     * @param string      $documentation
     * @param string      $vendor
     * @param Finder|null $finder
     */
    public function __construct($cache, $documentation, $vendor, Finder $finder = null)
    {
        $this->cache         = $cache;
        $this->documentation = $documentation;
        $this->vendor        = $vendor;
        $this->finder        = null === $finder ? new Finder() : $finder;
        $this->filters       = [];
    }

    /**
     * @param Filter $filter
     */
    public function addFilter(Filter $filter)
    {
        $this->filters[] = $filter;
    }

    /**
     * {@inheritdoc}
     */
    public function warmUp($cacheDir)
    {
        $files = $this
            ->finder
            ->in($this->vendor)
            ->files()
            ->name($this->documentation)
        ;

        $definitions = [];

        foreach ($files as $file) {
            $definitions[] = ['readme' => $file->getRealpath()];
        }

        foreach ($this->filters as $filter) {
            $definitions = $filter($definitions);
        }

        $packages = array_map(function ($e) {
            return $e['package'];
        }, $definitions);
        $definitions = array_combine($packages, $definitions);

        ksort($definitions);

        $export = json_encode($definitions, JSON_PRETTY_PRINT);

        file_put_contents($this->cache, $export);
    }

    /**
     * {@inheritdoc}
     */
    public function isOptional()
    {
        return false;
    }
}
