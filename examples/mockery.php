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

require_once \dirname(__DIR__) . '/vendor/autoload.php';

class Example extends AbstractFacade
{
    // This method can only be mocked through "call" static method.
    public static function publicStaticMethodCanOnlyBeMockedThroughCallMethod(): string
    {
        return uniqid(__METHOD__);
    }

    // All private static methods will be called through the __callStatic method.
    private static function privateStaticMethodCanBeMockedThroughMagicStaticCallMethod(): string
    {
        return uniqid(__METHOD__);
    }

    // All protected static methods will be called through the __callStatic method.
    protected static function protectedStaticMethodCanBeMockedThroughMagicStaticCallMethod(): string
    {
        return uniqid(__METHOD__);
    }
}

$mockObject = Facade::mock(Example::class);
$mockObject
    ->expects('privateStaticMethodCanBeMockedThroughMagicStaticCallMethod')
    ->andReturns('MockObjectResult: ' . __LINE__)
;
$mockObject
    ->expects('protectedStaticMethodCanBeMockedThroughMagicStaticCallMethod')
    ->andReturns('MockObjectResult: ' . __LINE__)
;
$mockObject
    ->expects('publicStaticMethodCanOnlyBeMockedThroughCallMethod')
    ->andReturns('MockObjectResult: ' . __LINE__)
;

// This will be identical because the method is protected and will be called through the __callStatic method.
var_dump(
    Example::protectedStaticMethodCanBeMockedThroughMagicStaticCallMethod(),
    Example::call('protectedStaticMethodCanBeMockedThroughMagicStaticCallMethod')
);
// This will be identical because the method is private and will be called through the __callStatic method.
var_dump(
    Example::privateStaticMethodCanBeMockedThroughMagicStaticCallMethod(),
    Example::call('privateStaticMethodCanBeMockedThroughMagicStaticCallMethod')
);

// Since the method "publicStaticMethodCanOnlyBeMockedThroughCallMethod" is public,
// it cannot be wrapped by the mock object method.
var_dump(
    Example::publicStaticMethodCanOnlyBeMockedThroughCallMethod(), // this will return the original method result
    Example::call('publicStaticMethodCanOnlyBeMockedThroughCallMethod') // this will return the mocked result
);
