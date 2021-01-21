<?php

namespace Tests;

use App\Gateway;

class DummyStub implements Gateway
{
    public function create()
    {
        return 'receipt-stub';
    }
}
