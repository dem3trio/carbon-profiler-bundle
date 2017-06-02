# Carbon Profiler Bundle

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

