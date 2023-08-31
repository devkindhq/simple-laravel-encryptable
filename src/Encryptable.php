<?php

namespace Devkind\SimpleLaravelEncryptable;

trait Encryptable
{
    private $key;
    private $prefix;

    public static $enableEncryption = true;

    /**
     * @return self
     */
    public function encrypter()
    {
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEncryptableAttributes()
    {
        return $this->encryptable;
    }

    /**
     * @param $key
     * @return bool
     */
    public function encryptable($key)
    {
        if (self::$enableEncryption) {
            return in_array($key, $this->encryptable);
        }

        return false;
    }

    /**
     * @param $key
     * @return bool
     */
    public function isCamelcase($key)
    {
        return isset($this->camelcase) && is_array($this->camelcase) && in_array($key, $this->camelcase);
    }



    /**
     * Decrypt a value.
     *
     * @param $value
     *
     * @return string
     * @throws \Exception
     */
    public function decryptAttribute($value)
    {
        return $value ? $this->encrypter()->decrypt($value) : '';
    }

    /**
     * @param $value
     * @return string
     */
    public function camelCaseAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * @param $value
     * @return string
     * @throws \Exception
     */
    public function encryptAttribute($value)
    {
        return $value ? $this->encrypter()->encrypt($value) : '';
    }

    /**
     * @param $key
     * @return string
     * @throws \Exception
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if ($this->encryptable($key)) {
            $value = $this->decryptAttribute($value);
        }
        if ($this->isCamelcase($key)) {
            $value = $this->camelCaseAttribute($value);
        }

        return $value;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     * @throws \Exception
     */
    public function setAttribute($key, $value)
    {
        if ($this->encryptable($key)) {
            $value = $this->encryptAttribute($value);
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getArrayableAttributes()
    {
        $attributes = parent::getArrayableAttributes();

        foreach ($attributes as $key => $attribute) {
            if ($this->encryptable($key)) {
                $attributes[$key] = $this->decryptAttribute($attribute);
            }
            if ($this->isCamelcase($key)) {
                $attributes[$key] = $this->camelCaseAttribute($attributes[$key]);
            }
        }

        return $attributes;
    }

    /**
     * @param $value
     * @return string
     */
    public function encrypt($value)
    {
        try {
            return $this->getPrefix() . '_' . openssl_encrypt($value, $this->getCipher(), $this->getKey(), 0, config('simple-encryptable.cipher_iv'));
        } catch (\Throwable $th) {
            if (app()->runningInConsole()) {
                return $value;
            }
            throw $th;
        }
    }

    /**
     * @param $value
     * @return string
     */
    public function decrypt($value)
    {
        $value = str_replace("{$this->getPrefix()}_", '', $value);

        return openssl_decrypt($value, $this->getCipher(), $this->getKey(), 0, config('simple-encryptable.cipher_iv'));
    }

    /**
     * @return bool|null|string
     * @throws \Exception
     */
    public function getKey()
    {
        if ($this->keyattribute !== null) {
            throw_if(is_null($this->{$this->keyattribute}));
            $this->key = substr(hash('sha256', $this->{$this->keyattribute}), 0, 16);
        }

        if ($this->key === null) {
            if (!config('simple-encryptable.key')) {
                throw new \Exception('The .env value MODEL_ENCRYPT_KEY has to be set');
            }
            $this->key = substr(hash('sha256', config('simple-encryptable.key')), 0, 16);
        }

        return $this->key;
    }


    /**
     * @param $key
     * @return bool
     */
    public function getCipher()
    {
        return config('simple-encryptable.cipher', config('app.cipher'));
    }


    /**
     * @return mixed
     */
    public function getPrefix()
    {
        return config('simple-encryptable.prefix', "XXX");
    }

    /**
     * determine if the string is a valid json.
     *
     * @param string $string
     * @return bool
     */
    public function isJson($string)
    {
        json_decode($string);

        return json_last_error() === JSON_ERROR_NONE;
    }
}
