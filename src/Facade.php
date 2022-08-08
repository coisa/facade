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

use InvalidArgumentException;
use Mockery;
use Mockery\MockInterface;

final class Facade
{
    /**
     * @private Prevent class instantiation.
     */
    private function __construct()
    {
    }

    /**
     * This method will create a mock object for the given class and return it.
     * It will also set the mock object as the handler for the static method calls of the given class.
     *
     * @param string $class The class we want to mock static methods.
     *
     * @return MockInterface The mock object which will replace the static method calls of the given class.
     */
    public static function mock(string $class): MockInterface
    {
        if (!is_subclass_of($class, FacadeInterface::class)) {
            throw new InvalidArgumentException(sprintf(
                'Class "%s" is not a facade class, your class should extend "%s".',
                $class,
                AbstractFacade::class,
            ));
        }

        $mock = Mockery::mock(uniqid($class));
        \call_user_func([$class, 'mock'], $mock);

        return $mock;
    }
}
