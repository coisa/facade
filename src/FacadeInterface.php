<?php

declare(strict_types=1);

/**
 * This file is part of coisa/facade.
 *
 * This source file is subject to the license that is bundled
 * with this source code in the file LICENSE.
 *
 * @link      https://github.com/artificenerd/facade
 * @copyright Copyright (c) 2022 Felipe Sayão Lobato Abreu <github@mentor.dev.br>
 * @license   https://opensource.org/licenses/MIT MIT License
 */

namespace CoiSA\Facade;

interface FacadeInterface
{
    public static function mock(object $mockedFacadeObject): void;

    public static function call(string $method, ...$args);
}
