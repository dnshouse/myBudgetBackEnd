<?php

namespace App\Firebase;

use Illuminate\Contracts\Auth\Authenticatable;

class User implements Authenticatable
{
    /**
     * The claims decoded from the JWT token.
     *
     * @var array
     */
    private $claims;

    /**
     * Creates a new Authenticatable user from Firebase.
     *
     * @param $claims
     */
    public function __construct($claims)
    {
        $this->claims = $claims;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'user_id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifier()
    {
        return (string)$this->claims['user_id'];
    }

    /**
     * Get the password for the user.
     *
     * @return string|void
     * @throws \Exception
     */
    public function getAuthPassword()
    {
        throw new \Exception('No password for Firebase User');
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string|void
     * @throws \Exception
     */
    public function getRememberToken()
    {
        throw new \Exception('No remember token for Firebase User');
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     * @throws \Exception
     */
    public function setRememberToken($value)
    {
        throw new \Exception('No remember token for Firebase User');
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string|void
     * @throws \Exception
     */
    public function getRememberTokenName()
    {
        throw new \Exception('No remember token for Firebase User');
    }
}