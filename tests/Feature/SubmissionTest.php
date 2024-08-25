<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    public function test_submission_endpoint()
    {
        $response = $this->postJson('/submit', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.'
        ]);

        $response->assertJsonPath('message', 'Submission is being processed');
        $response->assertStatus(202);
    }

    public function test_submission_endpoint_with_missing_fields()
    {
        $response = $this->postJson('/submit', [
            'name' => 'John Doe'
        ]);

        $response->assertJsonPath('message', 'The email field is required. (and 1 more error)');
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email', 'message']);
    }

    public function test_submission_endpoint_with_invalid_email()
    {
        $response = $this->postJson('/submit', [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'message' => 'This is a test message.'
        ]);

        $response->assertJsonPath('message', 'The email field must be a valid email address.');
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['email']);
    }
}
