<?php

declare(strict_types=1);

/*
 * This file is part of Ark PHP Crypto.
 *
 * (c) Ark Ecosystem <info@ark.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ArkEcosystem\Tests\Crypto;

use ArkEcosystem\Crypto\Message;

/**
 * This is the message test class.
 *
 * @author Brian Faust <brian@ark.io>
 * @coversNothing
 */
class MessageTest extends TestCase
{
    /** @test */
    public function it_should_sign_a_valid_message()
    {
        $fixture = $this->getMessageFixture();

        $message = Message::sign($fixture['data']['message'], $fixture['passphrase']);

        $this->assertSame($message->publicKey, $fixture['data']['publickey']);
        $this->assertSame($message->signature, $fixture['data']['signature']);
        $this->assertSame($message->message, $fixture['data']['message']);
    }

    /** @test */
    public function it_should_create_a_message_from_an_array()
    {
        $fixture = $this->getMessageFixture()['data'];

        $message = Message::new($fixture);

        $this->assertSame($message->publicKey, $fixture['publickey']);
        $this->assertSame($message->signature, $fixture['signature']);
        $this->assertSame($message->message, $fixture['message']);
    }

    /** @test */
    public function it_should_create_a_message_from_a_string()
    {
        $fixture = $this->getMessageFixture()['data'];

        $message = Message::new(json_encode($fixture));

        $this->assertSame($message->publicKey, $fixture['publickey']);
        $this->assertSame($message->signature, $fixture['signature']);
        $this->assertSame($message->message, $fixture['message']);
    }

    /** @test */
    public function it_should_sign_a_message()
    {
        $message = Message::sign('Hello World', 'passphrase');

        $this->assertInstanceOf(Message::class, $message);
    }

    /** @test */
    public function it_should_verify_a_message()
    {
        $message = Message::new($this->getMessageFixture()['data']);

        $this->assertTrue($message->verify());
    }

    /** @test */
    public function it_should_turn_a_message_into_an_array()
    {
        $message = Message::new($this->getMessageFixture()['data']);

        $this->assertInternalType('array', $message->toArray());
    }

    /** @test */
    public function it_should_turn_a_message_into_a_string()
    {
        $message = Message::new($this->getMessageFixture()['data']);

        $this->assertInternalType('string', $message->toJSON());
    }
}
