# Laravel Job Queue Demo

## Setup Instructions
1. Clone the repository.
2. Run `composer install`.
3. Set up your `.env` file with the correct database credentials.
4. Run `php artisan migrate` to create the necessary tables.

## Testing the API
- Use a tool like Postman to send a `POST` request to `/api/submit` with the following JSON payload:
  ```json
  {
      "name": "John Doe",
      "email": "john.doe@example.com",
      "message": "This is a test message."
  }
  
- You should receive a 202 Accepted status indicating that the submission is being processed.

- Run php artisan test to execute the unit tests.
