<?php


namespace app\models;


use tn\phpmvc\db\Model;
use tn\phpmvc\DbModel;

class ContactForm extends DbModel
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public static function tableName(): string
    {
        return 'contact';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function  attributes(): array
    {
        return ['subject','email','body'];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Enter your subject',
            'email' => 'Your email',
            'body' => 'Body'
        ];
    }

    public function send(): bool{
        return parent::save();
    }

}