# Readme for my DBMS Semester Project
Good afternoon! I'm writing this to try and guide you through installing this, should you need me to.

> [!NOTE]
> If you run into any other issues or have any questions at all, please email me! I'm sorry this project might be a pain in the neck to install, but I've worked really hard on it and would hate it if you could not see the final result.

## Important Note
If you run into any other issues or have any questions at all, please email me!
I'm sorry this project might be a pain in the neck to install, but I've worked really hard on it
and would hate it if you could not see the final result.


# Dependencies
The main dependencies for this project are:

* [PostgresQL](https://www.postgresql.org/download/)

* [PHP (this should already be installed on your machine, but here's documentation if not)](https://www.php.net/manual/en/install.windows.php)

* [Composer](https://getcomposer.org/download/)

* [Node.js](https://nodejs.org/en)

# Installation
> [!IMPORTANT]
> 1. Create a database in postgres to store db info for this project.

2. Open your CLI (if you're on Windows, this is either PowerShell or cmd)

3. Navigate to the extracted .zip file or the cloned repo (using cd commands)

4. Run this command to install PHP dependencies:

    `composer install`

5. Run this command to start setting up database environment variables (postgres):

   `cp .env.example .env`

7. Look for the line that says DB_CONNECTION=pgsql (this should be line 24).


> [!IMPORTANT]
> If you haven't configured postgres at all past installing it, the default username AND password are postgres


8. Replace the info with actually relevant info:
   `DB_CONNECTION=pgsql`
   
    `DB_HOST=127.0.0.1`
   
    `DB_PORT=5432`
   
    `DB_DATABASE=your_database_name`
   
    `DB_USERNAME=your_username`
   
    `DB_PASSWORD=your_password`

11. Make sure postgres is running locally, you created a database (see step 1), and you are using that same database name for the environment variable.

12. Run this command to install JS dependencies:

    `npm install`

13. Laravel needs an application key to be set in order to run, so run this command:

    `php artisan key:generate`

14. Run this command to migrate and populate the database:

    `php artisan migrate:fresh --seed`

16. Run this command to have Node do its thing for the frontend:

    `npm run build`

18. Run this command to have Laravel serve the application and start the development server (on localhost by default):

    `php artisan serve`

20. There is lots of test data that I made to be seeded as I built this. If you need test data generated, run this command:

    `php artisan db:seed`

# Troubleshooting
* PostgreSQL Error: If you receive an error regarding the database connection, make sure PostgreSQL is running and that the credentials in your .env file are correct.

* Composer Not Found: Ensure Composer is properly installed by checking with composer -v.

* Node.js Issues: If there are issues with Node.js or npm install, try clearing the npm cache or reinstalling Node.js.
