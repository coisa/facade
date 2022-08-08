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
    protected static function test(): string
    {
        return 'Test';
    }

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

class ExampleMock
{
    public function __construct(private string $prefix = '')
    {
    }

    public function test(): string
    {
        return uniqid($this->prefix);
    }
}

$mockObject = new ExampleMock('ExampleMock');

Example::mock($mockObject);

$result = Example::test();

var_dump(
    $result,
    $result === $mockObject->test()
);
