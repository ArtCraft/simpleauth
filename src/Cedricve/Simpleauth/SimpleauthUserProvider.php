<?php namespace Cedricve\Simpleauth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class SimpleauthUserProvider implements UserProvider
{
    protected $users;

    public function __construct()
    {
        $this->users = \Config::get("app.users");
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
                return (new SimpleauthUser())->fill($user);
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
        if(array_key_exists("username", $credentials) && array_key_exists("password", $credentials))
        {
            // Search for the user in the users array in the app.config.
            foreach ($this->users as $key => $value)
            {
                if(array_key_exists("username", $value) && array_key_exists("password", $value))
                {
                    if($value["username"] == $credentials["username"] &&
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
                return (new SimpleauthUser())->fill($user);
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
