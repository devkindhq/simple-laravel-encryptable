<?php

namespace Devkind\SimpleLaravelEncryptable\Tests;

use Devkind\SimpleLaravelEncryptable\SimpleEncryptableImpl;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;
use Maize\Encryptable\EncryptableServiceProvider;
use Devkind\SimpleLaravelEncryptable\Tests\User as UserModel;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }


    protected function getPackageProviders($app)
    {
        return ['Devkind\SimpleLaravelEncryptable\SimpleLaravelEncryptableServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
            'SimpleEncryptable' => SimpleEncryptableImpl::class,
        ];
    }


    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('simple-encryptable.key', 'base64:zHY/SHaIXbahumM7XMUeB7SO6ESRITR3TtHEAUCLYkk=');
        $app['config']->set('simple-encryptable.cipher', 'AES-256-CBC');
        $app['config']->set('simple-encryptable.cipher_iv', 'sdf875n90mh28458');
    }

    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });
    }

    public function createUser(array $attrs = [])
    {
        $user = new UserModel();

        $user->forceFill(array_merge([
            'email' => 'name.surname@example.com',
            'password' => 'example',
        ], $attrs))->save();

        return $user->fresh();
    }
}