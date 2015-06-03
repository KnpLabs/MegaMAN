<?php

namespace Knp\MegaMAN\Bundle;

use Knp\MegaMAN\DependencyInjection\MegaMANExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MegaMANBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new MegaMANExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        return dirname(parent::getPath());
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespace()
    {
        return substr(parent::getNamespace(), 0, strrpos(parent::getNamespace(), '\\'));
    }
}
