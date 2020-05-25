<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class WithDatabaseTestCase extends TestCase
{
    use RefreshDatabase;

    protected $apiPrefix = '/api/v1/';

    public function setUp(): void
    {
        parent::setUp();
    }
}
