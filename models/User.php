<?php


namespace app\models;


use tn\phpmvc\Application;
use tn\phpmvc\DbModel;
use tn\phpmvc\Model;
use tn\phpmvc\UserModel;

/**
 * Class User
 * @package app\models
 */
class User extends UserModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $confirmPassword = '';

    public static function tableName(): string
    {
        return 'user';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function register()
    {
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        $this->status = self::STATUS_ACTIVE;
        return parent::save();
    }

    public function updateProfile()
    {
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        $this->status = self::STATUS_INACTIVE;
        return parent::update(['id'=>Application::$app->user['id']]);
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL,[self::RULE_UNIQUE,'class' =>self::class]],
            'password' => [self::RULE_REQUIRED,[self::RULE_MIN,'min' => 8],[self::RULE_MAX,'max'=>24]],
            'confirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match' => 'password']]
        ];
    }

    public function  attributes(): array
    {
        return ['firstname','lastname','email','status','password'];
    }
    public function  labels(): array
    {
        return [
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password'
        ];
    }


    function getDisplayName(): string
    {
        return $this->firstname.' '.$this->lastname;
    }

    function getInitials(): string
    {
        return strtoupper(substr($this->firstname,0,1).substr($this->lastname,0,1));
    }
}