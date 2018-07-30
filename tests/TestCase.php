<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function setUp()
    {
        parent::setUp();
        $this->setFakeUser();
    }

    public function setFakeUser()
    {

        //make a fake admin
        $user = factory( User::class)->make(['role' => 'admin'] );
        $response = $this->actingAs($user )->withSession(['foo' => 'bar']);

        return $user;
    }

}
