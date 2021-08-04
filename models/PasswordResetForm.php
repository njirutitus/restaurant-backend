<?php


namespace app\models;

use tn\phpmvc\DbModel;

/**
 * Class User
 * @package app\models
 */
class PasswordResetForm extends DbModel
{

    public string $email = '';

    public static function tableName(): string
    {
        return 'user';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL,[self::RULE_EXISTS,'class' =>self::class]]
        ];
    }

    public function  attributes(): array
    {
        return ['email'];
    }

    public function  labels(): array
    {
        return [
            'email' => 'Email'
        ];
    }
}