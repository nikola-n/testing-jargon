<?php

namespace Tests;

use App\Gateway;
use App\User;
use App\Mailer;
use App\Subscription;
use PHPUnit\Framework\TestCase;

class SubscriptionTest extends TestCase
{

    /** @test */
    public function it_creates_a_stripe_subscription()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function creating_a_subscription_marks_the_user_as_subscribed()
    {
        // $gateway = new FakeGateway();

        $subscription = new Subscription(
            $this->createMock(Gateway::class), // dummy
            $this->createMock(Mailer::class) // dummy
        );
        
        $user = new User('John Doe');

        $this->assertFalse($user->isSubscribed());

        $subscription->create($user);

        $this->assertTrue($user->isSubscribed());
    }

    /** @test */
    function it_delivers_a_receipt()
    {
        $gateway = $this->createMock(Gateway::class);
        //when you call create method it should return this value
        $gateway->method('create')->willReturn('receipt-stub');  //stub

        $mailer = $this->createMock(Mailer::class); 
        // on mailer call it expects to call once the method deliver and 
        // get the message
        $mailer
            ->expects($this->once())
            ->method('deliver')
            ->with('Your receipt number is: receipt-stub'); //mock

        $subscription = new Subscription($gateway, $mailer);

        $subscription->create(new User("JohnDoe"));
    }
}
