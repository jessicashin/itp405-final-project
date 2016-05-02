<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    //Test 1
    public function testCreateUser() {
        $this->withoutMiddleware();

        $user = 'Test User 1';
        $username = 'testuser1';

        $this->call('POST', '/admin/users', [
            'name' => $user,
            'username' => $username,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->seeInDatabase('users', [
            'name' => $user,
            'username' => $username,
        ]);

        \App\User::where('username', '=', $username)->delete();
    }

    // Test 2
    public function testLogin() {
        $this
            ->visit('/login')
            ->type('admin', 'username')
            ->type('laravel', 'password')
            ->press('Log in')
            ->seePageIs('/search');

        $this->visit('/logout');
    }

    // Test 3
    public function testNonAdminRedirect() {
        $this
            ->visit('/login')
            ->type('itp', 'username')
            ->type('laravel', 'password')
            ->press('Log in')
            ->visit('/admin/users')
            ->seePageIs('/search');

        $this->visit('/logout');
    }

    // Test 4
    public function testEditUser() {
        $this->withoutMiddleware();

        $name = 'Test2 User';
        $username = 'itp';

        $this->call('PUT', '/admin/users/2', [
            '2_name' => $name,
            '2_username' => $username,
        ]);

        $this->seeInDatabase('users', [
            'name' => $name,
            'username' => $username,
        ]);

        $user = \App\User::find(2);
        $user->name = 'Test User';
        $user->save();
    }

    // Test 5
    public function testDeleteUser() {
        $this->withoutMiddleware();

        $user = 'Test User 1';
        $username = 'testuser1';

        $user = \App\User::create([
            'name' => $user,
            'username' => $username,
            'password' => 'password',
        ]);
        $userId = $user->id;

        $this->call('DELETE', '/admin/users/' . $userId);

        $this->assertNull(\App\User::find($userId));
    }
}
