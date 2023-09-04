<?php

namespace Devkind\SimpleLaravelEncryptable\Tests;

use Illuminate\Database\Eloquent\Model;
use Devkind\SimpleLaravelEncryptable\Encryptable;

class User extends Model
{
    use Encryptable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
    ];

}