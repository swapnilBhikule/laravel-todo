## TODO List
This is just a sample todo application made with Laravel 6 and VueJS.

#### System Requirements
- PHP 7.3 or higher
- NPM installed
- MySQL 5.6 or higher
- Apache 2.4 or higher
- Windows/Linux/Mac OS
- Composer

#### Installation Process
----
Navigate to your apache's root directory and clone the repository with following command:<br/>
`git clone https://github.com/swapnilBhikule/laravel-todo.git`<br/>

This will create a new folder with name *laravel-todo*. If you wish to clone the repository in different directory then use following command:<br/>
`git clone https://github.com/swapnilBhikule/laravel-todo.git <your-directory-name>`<br/>

Once the repository is clonned, navigate to the folder where the repository exists, and install all necessary PHP packages using composer:<br/>
`composer install`<br/>

This command will install all required packaged specified in composer.json file. __In Production run following command and skip the above one__:<br/>
`composer install --no-dev`<br/>

This command will only install production packages and will skip all development related packages.<br/>
If `.env` file is missing, you can create a new file and copy content from `.env.example` and paste it there.<br/>

If you `APP_KEY` is missing, just create a new one with following command:<br/>
`php artisan key:generate`<br/>

Just go through `.env` and all files from `config` folder to make development related changes.<br/>
Let's now migrate all our database tables to our database. We can run following command:<br/>
`php artisan migrate`<br/>

Once PHP packages are installed, install npm/js packages. Use the following command for the same:<br/>
`npm install`<br/>
This will install all necessary packages specified in packages.json file.<br/>
Well, that's it! You are good to go. All uncompiled JS files are located in `resources/js` which will be compiled by npm and saved in `public/js` directory.<br/>

Let's take a look at all required commands:<br/>
To run PHP server, you can run following command:<br/>
`php artisan serve`<br/>
If you want to compile JS files from `resources/js` in development mode(files will not be minified):<br/>
`npm run dev`<br/>
To keep an eye on changes on those JS files:<br/>
`npm run watch`<br/>
For production purpose(minified files):<br/>
`npm run production`<br/>
