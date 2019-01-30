## Evaluation

RS CMS package for Laravel.
It must be installed in Laravel as a dependency.
4 example: 
/app/Cms/Controllers/LanguageController.php - here we can easily extend language support

Questions: p.pauler@reverse.systems<br/>
Thanks!

---------------------------

### Get started

* **Install [Laravel](https://laravel.com/docs/5.7/installation) (version 5.7.*)**

    `composer create-project --prefer-dist laravel/laravel mysite`

* **Configure your environments in a .env file**

* **Install rs/cms package**:

1. Add repository in your **composer.json** file:

        "repositories": [
            {
                "type": "vcs",
                "url":  "git@repo.lan:rs/rs-cms.git"
            }
        ]

2. Run the composer require command from your terminal:

    `composer require "rs/cms"`

3. Run the artisan command from your terminal:

    `php artisan cms:install`


**Please don't forget to delete the routes in routes/web.php that Laravel created as default!**

---


#### Updating

1. Run the composer command from your terminal:

    `composer update`

2. Run the artisan command from your terminal:

    `php artisan cms:update`


---



#### Template changing

Coming soon...
