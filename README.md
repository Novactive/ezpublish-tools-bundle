# Novactive eZ Publish Tools bundle

## About

This bundle provides :

* an extends of the eZ Publish Composer scriptHandler for dumping assets : if set, the environment variable SYMFONY_ENV will be used to setup the assetic:dump command env option

## Installation

With composer :

    php composer.phar require novactive/ezpublish-tools-bundle 

Enable the bundle :

    <?php
    // ezpublish/EzPublishKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Novactive\EzPublishToolsBundle\NovactiveEzPublishToolsBundle(),
        );
    }

In your composer.json file, replace the line :

    "eZ\\Bundle\\EzPublishCoreBundle\\Composer\\ScriptHandler::dumpAssets"

by the line :

    "Novactive\\EzPublishToolsBundle\\Composer\\ScriptHandler::dumpAssets"


## Contributing

In order to be accepted, your contribution needs to pass a few controls : 

* PHP files should be valid
* PHP files should follow the [PSR-2](http://www.php-fig.org/psr/psr-2/) standard
* PHP files should be [phpmd](https://phpmd.org) and [phpcpd](https://github.com/sebastianbergmann/phpcpd) warning/error free

To ease the validation process, install the [pre-commit framework](http://pre-commit.com) and install the repository pre-commit hook :

    pre-commit install

Finally, in order to homogenize commit messages across contributors (and to ease generation of the CHANGELOG), please apply this [git commit message hook](https://gist.github.com/GMaissa/f008b2ffca417c09c7b8) onto your local repository. 
