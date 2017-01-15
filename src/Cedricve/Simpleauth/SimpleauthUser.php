<?php namespace Cedricve\Simpleauth;
 
use Illuminate\Auth\UserInterface;

class SimpleauthUser implements UserInterface
{
    protected $token = "";
    protected $details = [];
    public $id = null;
    public $username = "";
    public $language = "";

    public function __construct(array $details)
    {
        $this->details = $details;
        $this->id = $details["id"];
        $this->username = $details["username"];
        $this->language = $details["language"];
    }
 
    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->details["id"];
    }
 
    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->details["password"];
    }

    public function setRememberToken($value){}
    public function getRememberToken(){}
    public function getRememberTokenName(){}
}