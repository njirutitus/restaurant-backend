<?php

namespace app\models;


use tn\phpmvc\Application;
use tn\phpmvc\utils\Filesystem;

class Order extends \tn\phpmvc\DbModel
{
    public string $ordered_by = '';
    public string $table_number = '';
    public int $amount = 0;
    public int $vat = 0;
    public string $payment_method = '';
    public string $phone_number = '';
    public int $persons = 1;

    public static function tableName(): string
    {
        return 'orders';
    }

    public function attributes(): array
    {
        return ['ordered_by','table_number','amount','vat','phone_number','persons'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function labels(): array
    {
        return [
            'ordered_by' => 'Your Full Name',
            'table_number' => 'Table Number',
            'persons' => 'Number of Persons',
            'phone_number' => 'Phone Number',
            'amount' => 'Amount to Pay',
        ];
    }

    public function rules(): array
    {
        return [
            'ordered_by' => [self::RULE_REQUIRED],
            'table_number' => [self::RULE_REQUIRED,self::RULE_NUMBER],
            'persons' => [self::RULE_REQUIRED,self::RULE_NUMBER],
            'phone_number' => [self::RULE_REQUIRED,self::RULE_NUMBER],
            'amount' => [self::RULE_REQUIRED,self::RULE_NUMBER],
        ];
    }

    public function add(): bool
    {
        return parent::save();
    }
}