# pwiOrganizations
Code Challenge for PWI 

#project setup
copy .env.example to .env

Configure database access values in .env file

#init composer
Run command 

composer update

#database setup
run command:

php artisan migrate --seed

Seed creates all dummy data, including admin login
user : admin@pwi.com
pass : admin

#permissions
You may need to set pemissions

  sudo chgrp -R www-data pwiOrganizations
  
  sudo chmod -R 775 pwiOrganizations/storage
  
#errors
For error: No supported encrypter found. The cipher and / or key length are invalid.

php artisan key:generate