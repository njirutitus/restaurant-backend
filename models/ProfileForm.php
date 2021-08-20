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
class ProfileForm extends UserModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $newPassword = '';
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
        return parent::update(['id'=>Application::$app->user->id]);
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'confirmPassword' => [[self::RULE_MATCH,'match' => 'newPassword']]
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
            'password' => 'Current Password',
            'newPassword' => 'New Password',
            'confirmPassword' => 'Confirm Password'
        ];
    }


    function getDisplayName(): string
    {
        return $this->firstname.' '.$this->lastname;
    }
}