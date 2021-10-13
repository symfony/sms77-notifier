<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Notifier\Bridge\Sms77\Tests;

use Symfony\Component\Notifier\Bridge\Sms77\Sms77TransportFactory;
use Symfony\Component\Notifier\Test\TransportFactoryTestCase;
use Symfony\Component\Notifier\Transport\TransportFactoryInterface;

final class Sms77TransportFactoryTest extends TransportFactoryTestCase
{
    /**
     * @return Sms77TransportFactory
     */
    public function createFactory(): TransportFactoryInterface
    {
        return new Sms77TransportFactory();
    }

    public function createProvider(): iterable
    {
        yield [
            'sms77://host.test',
            'sms77://apiKey@host.test',
        ];

        yield [
            'sms77://host.test?from=TEST',
            'sms77://apiKey@host.test?from=TEST',
        ];
    }

    public function incompleteDsnProvider(): iterable
    {
        yield 'missing api key' => ['sms77://host?from=TEST'];
    }

    public function supportsProvider(): iterable
    {
        yield [true, 'sms77://apiKey@default?from=TEST'];
        yield [false, 'somethingElse://apiKey@default?from=TEST'];
    }

    public function unsupportedSchemeProvider(): iterable
    {
        yield ['somethingElse://apiKey@default?from=FROM'];
    }
}
