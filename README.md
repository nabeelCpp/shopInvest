# shopInvest
Ecommerce Mini Website

Step1: Open Cli window and write command where you want to deploy the project in directrory `git clone git@github.com:nabeelCpp/shopInvest.git`

Step2: Navigate to the Cloned Project Directory: `cd shopInvest`

Step3: Install Composer Dependencies `composer install`

step4: Install npm packages `npm install`

Step5: Create a Copy of the .env File from .env-example file: `cp .env.example .env`

Step6: Generate an Application Key: `php artisan key:generate`

Step7: Configure the Database: Open the .env file and configure the database connection settings, including the database name, username, and password. By default i have set `shopinvest` as db name and root as user and password is empty.

Step8: Migrate the Database: `php artisan migrate`

Step9: Run db seeder for registering the admin user. `php artisan db:seed`

Step10: Start the Development Server: `php artisan serve`

Note: to login admin panel you can use: `admin@shopinvest.com` and `shopinvest123`
