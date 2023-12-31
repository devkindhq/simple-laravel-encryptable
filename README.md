# Simple Laravel Encryptable

The Laravel Encryptable Attributes package provides seamless encryption and decryption of data stored in your database using Eloquent models. With this package, all values are automatically encrypted before storage and decrypted when queried, ensuring data security at rest while preserving accessibility.


[![Latest Version on Packagist](https://img.shields.io/packagist/v/devkindhq/simple-laravel-encryptable.svg?style=flat-square)](https://packagist.org/packages/devkindhq/simple-laravel-encryptable)
[![Total Downloads](https://img.shields.io/packagist/dt/devkindhq/simple-laravel-encryptable.svg?style=flat-square)](https://packagist.org/packages/devkindhq/simple-laravel-encryptable)
![GitHub Actions](https://github.com/devkindhq/simple-laravel-encryptable/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require devkind/simple-laravel-encryptable
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Devkind\SimpleLaravelEncryptable\SimpleLaravelEncryptableServiceProvider" --tag="simple-encryptable"
```


## Environment variables

Here are the values which can be modified to tweek the encryption

N.B `ENCRYPTION_IV` is the important field that has to be set before using the package.

```
ENCRYPTION_KEY=
ENCRYPTION_CIPHER=
ENCRYPTION_IV=
ENCRYPTION_PREFIX=XXX

```

## Usage

To use the package, just add the Encryptable trait to all model and the db column names in `$encryptable` you want to anonymize.

```php

<?php

namespace App\Models;

use Devkind\SimpleLaravelEncryptable\Encryptable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Encryptable;

    protected $encryptable = [
        'password',
    ];

}

```

Once done, all values will be encrypted before being stored in the database, and decrypted when querying them via Eloquent.



### Manually encrypt via Facade

``` php
use Devkind\SimpleLaravelEncryptable\SimpleEncryptable;

$value = "your-decrypted-value";

$encrypted = SimpleEncryptable::encrypt($value); // returns the encrypted value
```

### Manually decrypt via Facade

``` php
use Devkind\SimpleLaravelEncryptable\SimpleEncryptable;

$encrypted = "your-encrypted-value";

$value = SimpleEncryptable::decrypt($value); // returns the decrypted value
```


### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email backend@devkind.com instead of using the issue tracker.

## Credits

-   [Devkind](https://github.com/devkind)
-   [Saad Bhutto](https://github.com/saad-bhutto)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
