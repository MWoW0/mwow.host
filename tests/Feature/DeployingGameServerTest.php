<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeployingGameServerTest extends TestCase
{
    use RefreshDatabase;

    public function testCannotDeployWhileAnotherIsRunning()
    {
        $this->be(factory(User::class)->create(['email' => 'jonas.kerwin.hansen@gmail.com']));

        Cache::put('deploying', true, 1);

        $this->get('/deploy')->assertStatus(403);
    }

    public function testSuccessfulDeploy()
    {
        $this->be(factory(User::class)->create(['email' => 'jonas.kerwin.hansen@gmail.com']));

        config(['deploy.path' => __DIR__.'/../__Fixtures__/deploy/success']);

        $this
            ->get('/deploy')
            ->assertSuccessful()
            ->assertSee("[100%] Built target worldserver");
    }

    public function testFailedDeploy()
    {
        $this->be(factory(User::class)->create(['email' => 'jonas.kerwin.hansen@gmail.com']));

        config(['deploy.path' => __DIR__.'/../__Fixtures__/deploy/failed']);

        $this
            ->get('/deploy')
            ->assertDontSee("[100%] Built target worldserver");
    }
}
