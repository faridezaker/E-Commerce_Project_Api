<?php

namespace Tests\Feature;

use App\Services\VerifyCodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Zaker\User\Models\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_register_from()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    public function test_user_can_register()
    {
        $this->withoutExceptionHandling();

        $response = $this->registerNewUser();

        $response->assertRedirect(route('verification.notice'));

        $this->assertCount(1, User::all());

    }

    /** @return void */
    public function test_use_have_to_verify_account()
    {
        $this->registerNewUser();

        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('verification.notice'));

    }

    public function test_user_can_verify_account()
    {
        $user = User::create(
            [
                'name' => 'Hemn',
                'email' => 'hemn791@gmail.com',
                'password' => bcrypt('A!123a'),
            ]
        );
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($user->id, $code, now()->addDay());

        auth()->loginUsingId($user->id);

        $this->assertAuthenticated();

        $this->post(route('verification.send'), [
            'verify_code' => $code
        ]);

        $this->assertEquals(true, $user->fresh()->hasVerifiedEmail());

    }

    public function test_verified_user_can_see_home_page()
    {
        $this->registerNewUser();

        $this->assertAuthenticated();

        auth()->user()->markEmailAsVerified();

        $response = $this->get(route('dashboard'));

        $response->assertOk();
    }

    public function registerNewUser()
    {
        return $this->post(route('register'), [
            'name' => 'HMN',
            'email' => 'hemn791@gmail.com',
            'mobile' => '9367853698',
            'password' => 'As25@#',
            'password_confirmation' => 'As25@#'
        ]);
    }
}
