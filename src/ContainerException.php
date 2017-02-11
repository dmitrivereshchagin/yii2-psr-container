<?php

namespace yii\psr\container;

use Psr\Container\ContainerExceptionInterface;

/**
 * Represents generic container exception.
 */
class ContainerException extends \RuntimeException implements ContainerExceptionInterface
{
}
