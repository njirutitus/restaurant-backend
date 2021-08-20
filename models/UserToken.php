<?php


namespace app\models;


class UserToken extends \tn\phpmvc\DbModel
{
    public string $user = '';
    public string $token = '';
    public string $expires_at = '';
    public string $used = '';


    public static function tableName(): string
    {
        return 'user_token';
    }

    public function attributes(): array
    {
        return ['user','token','expires_at','used'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'user'=>[self::RULE_REQUIRED,[self::RULE_EXISTS,'col'=> 'id','class'=>User::class]],
            'token' => [self::RULE_REQUIRED],
            'expires_at' => [self::RULE_REQUIRED],
            'used' => [self::RULE_REQUIRED,self::RULE_NUMBER]
        ];
    }

    public function add(): bool
    {
        return parent::save();
    }
}