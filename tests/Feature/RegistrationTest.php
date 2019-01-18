<?php

namespace Tests\Feature;

use App\GameAccount;
use App\Hashing\Sha1Hasher;
use App\Realmlist;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
	use RefreshDatabase;

	protected function setUp()
	{
		parent::setUp();

		$this->mockConsoleOutput = false;

		$this->app->make('config')->set('database.connections.auth', config('database.connections.testing'));

        $this->artisan('migrate', $migrationParams = [
            '--database' => 'auth',
            '--path' => [realpath(__DIR__.'/../Migrations')],
            '--realpath' => true
        ]);

		$this->app->make('config')->set('database.default', 'testing');

        $this->beforeApplicationDestroyed(function () use ($migrationParams) {
            $this->artisan('migrate:rollback', $migrationParams);
        });
	}

	public function testItCreatesAnUserWithGameAccountAndPlayerPermission()
	{
		$realm = factory(Realmlist::class)->create();

		$this->postJson('/register', [
			'name' => 'john',
			'email' => 'john@example.com',
			'password' => 'secret',
			'password_confirmation' => 'secret'
		])->assertRedirect('/home');

		$this->assertDatabaseHas('users', [
			'name' => 'john',
			'email' => 'john@example.com'
		]);

		$this->assertDatabaseHas('account', [
			'username' => 'john',
			'email' => 'john@example.com',
			'reg_mail' => 'john@example.com',
			'sha_pass_hash' => (new Sha1Hasher)->make('secret', ['username' => 'john'])
		], 'auth');		

		$accountId = GameAccount::query()->where('email', 'john@example.com')->value('id');

		$this->assertDatabaseHas('rbac_account_permissions', [
			'realmid' => $realm->id,
			'accountId' => $accountId,
			'permissionId' => 195 // Sec Level: Player
		], 'auth');
	}

	public function testNameCannotContainSpace()
	{
		$this->postJson('/register', [
			'name' => 'john doe',
			'email' => 'john@example.com',
			'password' => 'secret',
			'password_confirmation' => 'secret'
		])->assertJsonValidationErrors('name');
	}
}
