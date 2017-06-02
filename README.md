# Carbon Profiler Bundle

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/6174a606-6a58-41db-9692-0d8d35c2ac17/mini.png)](https://insight.sensiolabs.com/projects/6174a606-6a58-41db-9692-0d8d35c2ac17)

Symfony 2/3 profiler extension, to change the Carbon php date in the whole project.


## Instalation

Install the package with composer.

```
composer install dem3trio/carbon-profiler-bundle
```

You can use the ```--require-dev``` option

## Configuration

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
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();

            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
                $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
            }
        }
     }
// 
```

Add the routing file under the routing_dev.yml file

```yml
# app/config/routing_dev.yml

_time_machine:
    resource: '@CarbonProfilerBundle:Resources/config/routing.yml'
    preix: /_time_machine
    
```
