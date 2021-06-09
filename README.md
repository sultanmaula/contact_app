## Step by Step Explanation

1. You must clone GitHub repository for this project locally.
2. Open terminal.
3. Change directory into your project.
4. If you haven't installed Composer before. You must install Composer dependencies.
5. And install NPM dependencies.
6. Copy of .env.example file and change the name into .env.
7. Generate an app encryption key.
8. Create an empty database for this application (in here I use MySQL for database).
9. In the .env file, add database information to allow Laravel to connect to the database (like DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
10. Migrate the database to implement table on database for this application.
11. Seed the database (to make a superadmin in users table).
12. Run the application (php artisan serve).
13. If the apps is start, you can access the application on "127.0.0.1".
14. If log in page appears, then enter email "superadmin@kly.id" and password "superadmin123".
