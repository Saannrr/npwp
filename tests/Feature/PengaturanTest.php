<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PengaturanTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateSuccessUsingNpwp()
    {
        $this->post('/pengaturan/create', [
           'user_id' => 1,
           'bertindak_sebagai' => 'pengurus',
           'identitas' => 'npwp',
           'npwp' => '123456789012345',
           'status' => true
        ]);
    }

    public function testCreateFailed()
    {

    }
}
