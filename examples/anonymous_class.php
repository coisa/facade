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
    // All method access of the facade MUST be protected (they will be called through the __callStatic method).
    protected static function test(): string
    {
        return uniqid();
    }
}

$mockObject = new class() {
    /**
     * Both "public" and "protected" are allowed here.
     * You MAY choose define a static or non-static method (anyone you pick will equally work).
     */
    public function test(): string
    {
        return 'Mocked';
    }
};

Example::mock($mockObject);

var_dump(
    Example::test(),
    Example::call('test'),
);
