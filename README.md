#### Requirements

* Have at least php 5.5 or higher (PHP should be in your PATH, try typing php on your terminal/cmd)
* Vagrant (Make sure to have vagrant on your path as well)
* Virtualbox (For laravel homestead)
* [Composer](https://getcomposer.org/)
* Working internet connection

#### Installation
* Open up a terminal and go to the project directory
* Copy the contents of `.env.example` to `.env`
* Run composer install
* Run `vendor/bin/homestead make` This should make homestead files
* Locate your hosts file. [this](https://gist.github.com/zenorocha/18b10a14b2deb214dc4ce43a2d2e2992) should help
* Add another entry: 192.168.10.10 bellamonte.test
* You should see the homepage on https://bellamonte.test

#### Migration
Migration creates your database tables. Run the by doing the following steps:
* Open up a terminal and go to the project directory
* Run `vagrant ssh` so we can go to the virtualbox
* You can run migrations using `php artisan migrate`

