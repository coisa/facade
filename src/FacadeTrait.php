<?php

declare(strict_types=1);

/**
 * This file is part of coisa/facade.
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 *
 * @link      https://github.com/coisa/facade
 * @copyright Copyright (c) 2022 Felipe Sayão Lobato Abreu <github@mentor.dev.br>
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace CoiSA\Facade;

use Closure;
use CoiSA\Factory\ValueFactory;
use CoiSA\Singleton\Singleton;

trait FacadeTrait
{
    public static function __callStatic(string $method, array $args)
    {
        return self::call($method, ...$args);
    }

    public static function call(string $method, ...$args)
    {
        $closure = self::getClosure($method);

        return \call_user_func_array($closure, $args);
    }

    public static function mock(object $mock): void
    {
        Singleton::setFactory(static::class, new ValueFactory($mock));
    }

    private static function getClosure(string $method): Closure
    {
        $singleton = Singleton::getInstance(static::class);

        return Closure::fromCallable([$singleton, $method]);
    }
}
