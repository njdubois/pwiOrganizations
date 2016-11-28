# Project World Impact: Organizations
Code Challenge for PWI 

#Project Setup
copy .env.example to .env

Configure database access values in .env file

    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=

#Init Composer
Run command:

    composer update

#Database setup
run command:

    php artisan migrate --seed

Seed creates all dummy data, including admin login
    
    user : admin@pwi.com
    pass : admin

If you wish to revert to a fresh database, run command:

    php artisan migrate:reset

#Permissions
You may need to set permissions, this is important to allow image uploads.

    sudo chgrp -R www-data pwiOrganizations
    sudo chmod -R 775 pwiOrganizations/storage

#Branding
To implement SASS, I setup a branding css file.

    /resources/assets/sass/branding.scss
    
On top of this file are 2 sass variables:

    $color_headline: #33aef4;
    $main_button_color: #35db55;
  
If this was a larger project, with more uses of similar colors, these variables
would allow the quick re coloring of the whole page say if we wanted to have a cut
and paste type of web page to get up and running.
  
Gulp install required.
  
#Errors
For error: No supported encrypter found. The cipher and / or key length are invalid.

    php artisan key:generate
    
#To Do
There needs to be more robust navigation links.  Cancel edit/create 
organizations.  Admin home page.  Non admin landing page.

Better bootstrap use.

Delete Organization functionality.

Causes CRUD
Revenues CRUD
User Administration CRUD
