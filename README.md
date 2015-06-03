MegaMAN (aka Mega MANUAL): Huge manual where all your documentation is available
================================================================================
Find your and documentation but also all dependencies ones.

[![Build Status](https://travis-ci.org/KnpLabs/MegaMAN.svg?branch=master)](https://travis-ci.org/KnpLabs/MegaMAN)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/KnpLabs/MegaMAN/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/KnpLabs/MegaMAN/?branch=master)

#Installation

```bash
composer require knplabs/mega-man ~1.0
```

```php
class AppKernel
{
    function registerBundles()
    {
        $bundles = array(
            //...
            new Knp\MegaMAN\Bundle\MegaMANBundle(),
            //...
        );

        //...

        return $bundles;
    }
}
```

#Usages

Just look at the new button into your debug tool bar.
