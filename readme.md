# LaravelUid

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

This package creates UIDs like the ones Stripe uses for your models or on their own.

Installation
============

#### Via Composer

``` bash
$ composer require alecgarcia/laravel-uid
```

Usage
=====

## To use with a model
### 1. Add uid column to table

#### With an existing Model
1. Add a migration
```bash
php artisan make:migration --table users add-uid-to-users
```

2. Open up the migration file you just created and add a `uid` field
```bash
    /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table('users', function (Blueprint $table) {
                $table->string('uid', 32)->after('id')->unique();
            });
        }
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('uid');
            });
        }
```

#### With aa new Model
1. Open up the migration file for the model and add a `uid` field

```bash
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uid', 32)->unique();
            $table->timestamps();
        });
    }
```

### 2. Add the trait to your model
```bash
<?php

namespace App\Models;

use Alecgarcia\LaravelUid\Traits\Uid;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use UID;
}
```

## To used statically
```bash
<?php

use Alecgarcia\LaravelUid\Uid;

$generatedUid = Uid::make();
// Generated Uid -> "1mVQuIwVrRS9ijwx" // Defaults to no prefix and 16 Characters long

$generatedUid = Uid::make('uid', 12);
// Generated Uid -> "uid_nuv8V6GH"     // Can set the prefix that is used and the length
```

Customization
=============

### Using the trait
You can add the following properties to your model to configure the Uid trait

```bash
<?php

namespace App\Models;

use Alecgarcia\LaravelUid\Traits\Uid;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use UID;
    
    public static string $uidPrefix = 'usr';  // Defaults to models class name
    public static int $uidLength = 10;        // Defaults to 16 total characters
    public static bool $uidCheck = false;     // Default is true
}
```

Change log
==========

Please see the [changelog](changelog.md) for more information on what has changed recently.

Testing
=======

``` bash
$ php vendor/bin/phpunit
```

Contributing
============

Please see [contributing.md](contributing.md) for details and a todolist.

Security
========

If you discover any security related issues, please email hello@alecgarcia.com instead of using the issue tracker.

Credits
=======

- [Alec Garcia][link-author]
- [All Contributors][link-contributors]
- Originally influenced by [dpods/laravel-uid][link-influencedby]

License
=======

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/alecgarcia/laravel-uid.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/alecgarcia/laravel-uid.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/alecgarcia/laravel-uid/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/alecgarcia/laravel-uid
[link-downloads]: https://packagist.org/packages/alecgarcia/laravel-uid
[link-travis]: https://travis-ci.org/alecgarcia/laravel-uid
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/alecgarcia
[link-contributors]: ../../contributors
[link-influencedby]: https://github.com/dpods/laravel-uid
