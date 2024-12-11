---------------------------------------------
<--< Readme for my DBMS Semester Project >-->
---------------------------------------------

Good afternoon! I'm writing this to try and guide you through installing this, should you need me to.


------------------
< Important Note >
------------------
If you run into any other issues or have any questions at all, please email me!
I'm sorry this project might be a pain in the neck to install, but I've worked really hard on it
and would hate it if you could not see the final result.


----------------
< Dependencies >
----------------
The main dependencies for this project are:

- PostgresQL
(https://www.postgresql.org/download/)

- PHP [this should already be installed on your machine, but here's documentation if not]
(https://www.php.net/manual/en/install.windows.php)

- Composer
(https://getcomposer.org/download/)

- Node.js
(https://nodejs.org/en)

----------------
< Installation >
----------------
1. (*IMPORTANT*) Create a database in postgres to store db info for this project.

2. Open your CLI (if you're on Windows, this is either PowerShell or cmd)

3. Navigate to the extracted .zip file or the cloned repo (using cd commands)

4. Run this command to install PHP dependencies:
    composer install

5. Run this command to start setting up database environment variables (postgres):
    cp .env.example .env

6. Look for the line that says DB_CONNECTION=pgsql (this should be line 24).

7. Replace the info with actually relevant info.
    - If you haven't configured postgres at all past installing it, the default username AND password are postgres
    
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

8. Make sure postgres is running locally, you created a database (see step 1), and you are using that same database name for the environment variable.

9. Run this command to install JS dependencies:
    npm install

10. Laravel needs an application key to be set in order to run, so run this command:
    php artisan key:generate

11. Run this command to migrate and populate the database:
    php artisan migrate:fresh --seed

    ** NOTE: This may take a bit because I wanted it to generate enough test data, so please be patient!

12. Run this command to have Node do its thing for the frontend:
    npm run build

13. Run this command to have Laravel serve the application and start the development server (on localhost by default):
    php artisan serve

14. There is lots of test data that I made to be seeded as I built this. If you need test data generated, run this command:
    php artisan db:seed

-------------------
< Troubleshooting >
-------------------
- PostgreSQL Error: If you receive an error regarding the database connection, make sure PostgreSQL is running and that the credentials in your .env file are correct.

- Composer Not Found: Ensure Composer is properly installed by checking with composer -v.

- Node.js Issues: If there are issues with Node.js or npm install, try clearing the npm cache or reinstalling Node.js.

----------------
< Test Queries >
----------------
SQL files are attached for each sample query from the project requirements.
To run them:
- Open pgAdmin.
- Right-click your database you made for this project.
- Left-click "Query Tool".
- Paste the SQL code from my files to run each query.
- The files will be listed in the order they need to be ran to fulfill requirements.

1.  Assume the package shipped by USPS with tracking number 123456 is reported to
    have been destroyed in an accident. Find the contact information for the customer.
    Also, find the contents of that shipment and create a new shipment of replacement
    items.

    **  NOTE: you'll need to get a tracking number from a random order.
        Use the following query, take a random tracking number, and replace
        the tracking numbers in the three files with the one you chose:
        
        SELECT tracking_number FROM orders;

    a. get-customer-from-order.sql
    b. find-products-from-order.sql
    c. create-replacement-shipment.sql


2.  Find the customer who has bought the most (by price) in the past year.

    a. find-customer-who-spent-most.sql


3.  Find the top 2 products by dollar-amount sold in the past year.

    a. find-two-highest-selling-items-by-money.sql


4.  Find the top 2 products by unit sales in the past year.

    a. find-two-highest-selling-items-by-units.sql


5.  Find those products that are out-of-stock at every store in California.

    a. find-products-out-of-stock-in-CA.sql


6.  Find those packages that were not delivered within the promised time.

    a. find-late-packages.sql // come back to this hagen


7.  Generate the bill for each customer for the past month.

    a. get-bill-for-last-months-customers.sql