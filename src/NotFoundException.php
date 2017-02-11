<?php

namespace yii\psr\container;

use Psr\Container\NotFoundExceptionInterface;

/**
 * This exception is thrown when a non-existent id is requested.
 */
class NotFoundException extends \InvalidArgumentException implements NotFoundExceptionInterface
{
}
