"# CyberDuckTask" 

  1. Clone GitHub repo for this project locally (run: git clone https://github.com/ipsilanty/CyberDuckTask.git)
  2. cd to your project
  3. Install Composer Dependencies (run: composer install)
  4. Install NPM Dependencies (run: npm install)
  5. Create a copy of your .env file (run: copy .env.example .env)
  6. Generate an app encryption key (run: php artisan key:generate)
  7. Create an empty database named crm
  8. In the .env file, add database information to allow Laravel to connect to the database
  9. Run: php artisan migrate
  10. Run: php artisan db:seed 
  11. Create some test records (50 companies, 50 employees):
    a. Run: php artisan tinker
    b. Run: factory(App\Employees::class, 50)->create()
  12. Make storage folder accessible from public (Run: php artisan storage:link) --For security reasons this folder is not accessible         anymore after the project has been uploaded on GitHub
  13. Inside /public directory, copy logo folder into new storage folder created by command above --In this folder will be stored company     logo
     
