# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devkindhq/simple-laravel-encryptable.svg?style=flat-square)](https://packagist.org/packages/devkindhq/simple-laravel-encryptable)
[![Total Downloads](https://img.shields.io/packagist/dt/devkindhq/simple-laravel-encryptable.svg?style=flat-square)](https://packagist.org/packages/devkindhq/simple-laravel-encryptable)
![GitHub Actions](https://github.com/devkindhq/simple-laravel-encryptable/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require devkindhq/simple-laravel-encryptable
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Devkind\SimpleLaravelEncryptable\SimpleLaravelEncryptableServiceProvider" --tag="simple-encryptable"
```



## Usage

To use the package, just add the Encryptable cast to all model attributes you want to anonymize.

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

If you discover any security related issues, please email saadbhutto@ymail.com instead of using the issue tracker.

## Credits

-   [Devkind](https://github.com/devkind)
-   [Saad Bhutto](https://github.com/saad-bhutto)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
