<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test whether the user registration form loads successfully.
     */
    public function test_registration_form_loads()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Registration Form');
    }

    /**
     * Test whether a new user can be successfully registered.
     */
    public function test_user_registration()
    {
        $userData = [
            'full_name' => 'John Doe',
            'user_name' => 'johndoe',
            'birthdate' => '1990-01-01',
            'phone' => '1234567890',
            'password' => 'password',
            'pwd' => 'password',
            'email' => 'johndoe@example.com',
            'image' => 'sample_image.jpg', // Mock file name
        ];

        $response = $this->post('/register', $userData);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('users', [
            'user_name' => 'johndoe',
            'email' => 'johndoe@example.com',
        ]);
    }

    /**
     * Test whether the user registration form validation works correctly.
     */
    public function test_user_registration_validation()
    {
        $userData = [
            // Missing required fields
        ];

        $response = $this->post('/register', $userData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['full_name', 'user_name', 'birthdate', 'phone', 'password', 'pwd', 'email', 'image']);
    }

    /**
     * Test whether the password is hashed before storing in the database.
     */
    public function test_password_is_hashed()
    {
        $userData = [
            'full_name' => 'Jane Doe',
            'user_name' => 'janedoe',
            'birthdate' => '1990-01-01',
            'phone' => '1234567890',
            'password' => 'password',
            'pwd' => 'password',
            'email' => 'janedoe@example.com',
            'image' => 'sample_image.jpg', // Mock file name
        ];

        $this->post('/register', $userData);

        $this->assertDatabaseHas('users', [
            'user_name' => 'janedoe',
            'email' => 'janedoe@example.com',
        ]);

        $user = User::where('user_name', 'janedoe')->first();
        $this->assertTrue(Hash::check('password', $user->password));
    }

    /**
     * Test whether the registration success message is displayed after successful registration.
     */
    public function test_registration_success_message_displayed()
    {
        $userData = [
            'full_name' => 'Alice Smith',
            'user_name' => 'alicesmith',
            'birthdate' => '1990-01-01',
            'phone' => '1234567890',
            'password' => 'password',
            'pwd' => 'password',
            'email' => 'alicesmith@example.com',
            'image' => 'sample_image.jpg', // Mock file name
        ];

        $response = $this->post('/register', $userData);

        $response->assertStatus(200); // Check for status code 201 for successful creation
        $response->assertJsonStructure(['success', 'data']); // Ensure response has 'success' and 'data' keys
        $response->assertJson(['success' => true]); // Check if success is true

        // Optionally, you can assert specific user data returned in the response
        $response->assertJsonFragment([
            'full_name' => 'Alice Smith',
            'user_name' => 'alicesmith',
            'email' => 'alicesmith@example.com',
        ]);
    }

}
