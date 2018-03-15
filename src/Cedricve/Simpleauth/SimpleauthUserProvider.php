<?php

namespace Cedricve\Simpleauth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class SimpleauthUserProvider implements UserProvider
{
    protected $users;
    protected $login_field;
    protected $model;

    public function __construct()
    {
        $this->login_field = \Config::get("simpleauth.login_field",'email');
        $this->users = \Config::get("simpleauth.users");
        $this->model = \Config::get("simpleauth.model");
    }

    public function getUsers()
    {
        return $this->users;
    }

    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     *  Retrieve a user by their unique identifier.
     */
    public function retrieveById($id)
    {
        $user = null;

        // If id is not valid, return null.
        if($id != null && $id > 0)
        {
            // Search for the user in the users array in the app.config.
            foreach ($this->users as $key => $value)
            {
                if(array_key_exists("id", $value))
                {
                    if($value["id"] == $id)
                    {
                        $user = $value;
                        break;
                    }
                }
            }

            // Check if user has been found.
            if($user != null)
            {
                return (new $this->model())->forceFill($user);
            }
        }
    }

    /**
     *  Retrieve a user by the given credentials.
     */
    public function retrieveByCredentials(array $credentials)
    {
        $user = null;

        // If credentials is not a valid array, return null.
        if(array_key_exists($this->login_field, $credentials) && array_key_exists("password", $credentials))
        {
            // Search for the user in the users array in the app.config.
            foreach ($this->users as $key => $value)
            {
                if(array_key_exists($this->login_field, $value) && array_key_exists("password", $value))
                {
                    if($value[$this->login_field] == $credentials[$this->login_field] &&
                        $value["password"] == $credentials["password"])
                    {
                        $user = $value;
                        break;
                    }
                }
            }

            // Check if user has been found.
            if($user != null)
            {
                return (new $this->model())->forceFill($user);
            }
        }
    }

    /**
     *  Validate a user against the given credentials.
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // If password equals than the user is ok to signin.
        return ($user->getAuthPassword() == $credentials["password"]);
    }

    public function retrieveByToken($identifier, $token){}
    public function updateRememberToken(Authenticatable $user, $token){}
}
