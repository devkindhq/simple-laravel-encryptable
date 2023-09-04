<?php
namespace Devkind\SimpleLaravelEncryptable\Tests;


use Illuminate\Support\Facades\Facade;
use Devkind\SimpleLaravelEncryptable\SimpleEncryptableImpl;
use Devkind\SimpleLaravelEncryptable\SimpleEncryptable;

class SimpleLaravelEncryptableFacadeTest extends TestCase
{
    /** @test */
    public function it_encrypts_data_using_facade()
    {
        // Mock the SimpleEncryptable class or use a testing database connection
        // depending on how you've implemented your encryption.

        // For example, if you're using a testing database connection and Eloquent:
        // $this->app['config']->set('database.default', 'testing');
        // $this->artisan('migrate'); // Migrate your testing database

        // Arrange
        $dataToEncrypt = 'Hello, World!';

        // Act
        $encryptedData = SimpleEncryptable::encrypt($dataToEncrypt);

        // Assert
        // You can write assertions here to check if the data is encrypted correctly.
        // For example, you can check if the encrypted data is not equal to the original data.
        $this->assertNotEquals($dataToEncrypt, $encryptedData);

        // Clean up (if necessary, rollback database changes)
        // For example, if you've migrated a testing database:
        // $this->artisan('migrate:reset');
    }
}