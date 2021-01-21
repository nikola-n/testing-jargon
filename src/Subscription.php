<?php

namespace App;

use App\User;
use App\Mailer;

class Subscription
{
    protected  $gateway;
    protected Mailer $mailer;

    public function __construct($gateway, $mailer)
    {
        $this->gateway = $gateway;
        $this->mailer = $mailer;
    }

    public function create(User $user)
    {
        // create the subscription through Stripe.
        $receipt = $this->gateway->create();

        // die(var_dump($receipt)); 
        
        // Update the local user record.
        $user->markAsSubscribed();

        // Send a welcome email or dispatch event.
        $this->mailer->deliver('Your receipt number is: ' . $receipt);
    }
}
