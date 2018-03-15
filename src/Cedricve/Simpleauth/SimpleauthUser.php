<?php

namespace Cedricve\Simpleauth;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class SimpleauthUser extends Model implements AuthenticatableContract
{

    use Authenticatable;

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthIdentifierName()
    {
        return $this->{\Config::get("simpleauth.login_field",'email')};
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function setRememberToken($value){}
    public function getRememberToken(){}
    public function getRememberTokenName(){}
}
