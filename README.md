# Carbon Profiler Bundle

[![SensioLabsInsight](https://insight.symfony.com/projects/6174a606-6a58-41db-9692-0d8d35c2ac17/mini.svg)](https://insight.symfony.com/account/widget?project=6174a606-6a58-41db-9692-0d8d35c2ac17)

Symfony 2/3/4 profiler extension, to change the Carbon php date in the whole project.


## Installation

Install the package with composer.

```
composer require dem3trio/carbon-profiler-bundle --dev
```

## Configuration Symfony >= 2.8 and SF <= 3.3

As the package adds a new panel in the Symfony profiler, you should add the bundle under
the ```dev``` section.

```php
// app/AppKernel.php

  public function registerBundles()
    {
        $bundles = [
           // ... prod bundles
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
          // ... dev bundles
          
            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new Dem3trio\Bundle\CarbonProfilerBundle\CarbonProfilerBundle();
            }
        }
     }
// 
```

Add the routing file under the routing_dev.yml file

```yml
# app/config/routing_dev.yml

_time_machine:
    resource: '@CarbonProfilerBundle/Resources/config/routing.yml'
    prefix: /_time_machine
    
```
## Configuration for Symfony 3.4 and 4.x

Add the bundle to your bundles.php

```php
// config/bundles.php

<?php

return [
    // ...
    Dem3trio\Bundle\CarbonProfilerBundle\CarbonProfilerBundle::class => ['dev' => true],
    ];
```

And add the routing file:

```yml
# config/routes/dev/carbon_profiler.yml

_time_machine:
    resource: '@CarbonProfilerBundle/Resources/config/routing.yml'
    prefix: /_time_machine

```

