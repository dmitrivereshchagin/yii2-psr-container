# yii2-psr-container

PSR-11 container adapter for Yii 2.

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
