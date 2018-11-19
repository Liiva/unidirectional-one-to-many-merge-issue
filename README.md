Merge issue in unidirectional OneToMany relation  
=======

This is a barebone Symfony project in order to isolate and help explain this issue.

How to reproduce:

  1. Checkout code 
  2. Setup a MySQL database
  3. Create a .env file based on .env.dist and configure `DATABASE_URL` environmental variable   
  4. Install dependencies: `composer install`
  5. Run migrations: `php bin/console doctrine:migrations:migrate`
  6. Load fixtures: `php bin/console doctrine:fixtures:load`
  7. Start web server: `php bin/console server:run`
  8. navigate to home route (default: http://127.0.0.1:8000/home)

## Expected behaviour
I expect `Post 1` to be removed from the `post`  table.

## Actual behaviour
`Post 1` still exists in the `post` table.
