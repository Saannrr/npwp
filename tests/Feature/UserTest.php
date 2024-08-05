<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegisterSuccess()
    {
        $this->postJson('/api/users', [
            'name' => 'Ihsan Ramadhan',
             'email' => 'ihsan@gmail.com',
            'npwp' => '123456789012345',
            'nik' => '1234567890123456',
            'password' => 'rahasia',
        ])->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'Ihsan Ramadhan',
                    'email' => 'ihsan@gmail.com',
                    'npwp' => '123456789012345',
                    'nik' => '1234567890123456'
                ]
            ]);
    }

    public function testRegisterFailed()
    {
        $this->postJson('/api/users', [
            'name' => '',
            'email' => '',
            'npwp' => '',
            'nik' => '',
            'password' => '',
        ])->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'npwp' => [
                        "The npwp field is required."
                    ],
                    'nik' => [
                        "The nik field is required."
                    ],
                    'name' => [
                        "The name field is required."
                    ],
                    'email' => [
                        "The email field is required."
                    ],
                    'password' => [
                        "The password field is required."
                    ]
                ]
            ]);
    }

    public function testRegisterNpwpAlreadyExists()
    {
        $this->testRegisterSuccess();
        $this->postJson('/api/users', [
            'name' => 'Ihsan Ramadhan',
            'email' => 'ihsan@gmail.com',
            'npwp' => '123456789012345',
            'nik' => '1234567890123456',
            'password' => 'rahasia',
        ])->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'npwp' => [
                        "npwp already registered"
                    ]
                ]
            ]);
    }

    public function testLoginSuccess()
    {
        $this->seed([UserSeeder::class]);
        $this->postJson('/api/users/login', [
            'npwp' => '123456789012345',
            'password' => 'rahasia'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Ihsan Ramadhan',
                    'email' => 'ihsan@gmail.com',
                    'npwp' => '123456789012345',
                    'nik' => '1234567890123456'
                ]
            ]);

        $user = User::where('npwp', '123456789012345')->first();
        self::assertNotNull($user->token);
    }

    public function testLoginFailed()
    {
        $this->postJson('/api/users/login', [
            'npwp' => '123456789012345',
            'password' => 'rahasia'
        ])->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'npwp or password wrong'
                    ]
                ]
            ]);
    }

    public function testLoginFailedPasswordWrong()
    {
        $this->seed([UserSeeder::class]);
        $this->postJson('/api/users/login', [
            'npwp' => '123456789012345',
            'password' => 'salah'
        ])->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'npwp or password wrong'
                    ]
                ]
            ]);
    }

    public function testGetUserSuccess()
    {
        $this->seed([UserSeeder::class]);

        $this->get('/api/users/current', [
           'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Ihsan Ramadhan',
                    'email' => 'ihsan@gmail.com',
                    'npwp' => '123456789012345',
                    'nik' => '1234567890123456'
                ]
            ]);
    }

    public function testGetUserUnauthorized()
    {
        $this->seed([UserSeeder::class]);

        $this->get('/api/users/current')
            ->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'Unauthorized'
                    ]
                ]
            ]);
    }

    public function testGetUserInvalidToken()
    {
        $this->seed([UserSeeder::class]);

        $this->get('/api/users/current', [
            'Authorization' => 'salah'
        ])->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'Unauthorized'
                    ]
                ]
            ]);
    }

    public function testUpdateEmailSuccess()
    {
        $this->seed([UserSeeder::class]);
        $oldUser = User::where('npwp', '123456789012345')->first();

        $this->patch('/api/users/current',
            [
                'email' => 'san@gmail.com'
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Ihsan Ramadhan',
                    'email' => 'san@gmail.com',
                    'npwp' => '123456789012345',
                    'nik' => '1234567890123456'
                ]
            ]);

        $newUser = User::where('npwp', '123456789012345')->first();
        self::assertNotEquals($oldUser->email, $newUser->email);
    }

    public function testUpdatePasswordSuccess()
    {
        $this->seed([UserSeeder::class]);
        $oldUser = User::where('npwp', '123456789012345')->first();

        $this->patch('/api/users/current',
            [
                'password' => 'baru'
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Ihsan Ramadhan',
                    'email' => 'ihsan@gmail.com',
                    'npwp' => '123456789012345',
                    'nik' => '1234567890123456'
                ]
            ]);

        $newUser = User::where('npwp', '123456789012345')->first();
        self::assertNotEquals($oldUser->password, $newUser->password);
    }

    public function testUpdateFailed()
    {
        $this->seed([UserSeeder::class]);

        $this->patch('/api/users/current',
            [
                'password' => 'barubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubarubaru'
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'password' => [
                        'The password must not be greater than 100 characters.'
                    ]

                ]
            ]);
    }

    public function testLogoutSuccess()
    {
         $this->seed([UserSeeder::class]);

         $this->delete(uri: '/api/users/logout', headers: [
             'Authorization' => 'test'
         ])->assertStatus(200)
            ->assertJson([
                'data' => true
            ]);

         $user = User::where('npwp', '123456789012345')->first();
         self::assertNull($user->token);
    }

    public function testLogoutFailed()
    {
        $this->seed([UserSeeder::class]);

        $this->delete(uri: '/api/users/logout', headers: [
            'Authorization' => 'salah'
        ])->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'Unauthorized'
                    ]
                ]
            ]);
    }
}
