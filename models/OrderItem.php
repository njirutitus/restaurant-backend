<?php


namespace app\models;


use tn\phpmvc\utils\Filesystem;

class OrderItem extends \tn\phpmvc\DbModel
{
    public float $item_price = 0;
    public int $quantity = 1;
    public int $item_id = 0;
    public int $order_id = 0;

    public static function tableName(): string
    {
        return 'order_item';
    }

    public function attributes(): array
    {
        return ['order_id','item_id','item_price','quantity'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function labels(): array
    {
        return [
            'order_id' => 'Order Id',
            'item_id' => 'Item Id',
            'item_price' => 'Item Price',
            'quantity' => 'Quantity'
        ];
    }

    public function rules(): array
    {
        return [
        'order_id' => [self::RULE_REQUIRED,self::RULE_NUMBER],
        'item_id' => [self::RULE_REQUIRED,self::RULE_NUMBER],
        'item_price' => [self::RULE_REQUIRED,self::RULE_NUMBER],
        'quantity' => [self::RULE_REQUIRED,self::RULE_NUMBER],
        ];
    }

    public function add(): bool
    {
        return parent::save();
    }
}