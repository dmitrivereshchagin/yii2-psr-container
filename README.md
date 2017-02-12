# yii2-psr-container [![Build Status](https://travis-ci.org/dmitrivereshchagin/yii2-psr-container.svg?branch=master)](https://travis-ci.org/dmitrivereshchagin/yii2-psr-container)

PSR-11 container adapter for Yii 2.

## Install

```
% composer require dmitrivereshchagin/yii2-psr-container
```

## Usage

```php
\Yii::$container->setSingleton(
    'Psr\Container\ContainerInterface',
    function ($container) {
        return new \yii\psr\container\ContainerAdapter($container);
    }
);
```

## Testing

```
% composer test
```
