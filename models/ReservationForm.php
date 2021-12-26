<?php


namespace app\models;


use tn\phpmvc\DbModel;

class ReservationForm extends DbModel
{
    public string $reserved_by = '';
    public string $date = '';
    public string $time = '';
    public string $adults = '';

    public static function tableName(): string
    {
        return 'reservation';
    }

    public function attributes(): array
    {
        return array('reserved_by','date','time','adults');
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'reserved_by' => [self::RULE_REQUIRED],
            'date' => [self::RULE_REQUIRED],
            'time' => [self::RULE_REQUIRED],
            'adults' => [self::RULE_REQUIRED,self::RULE_NUMBER],
        ];
    }

    public function add() : bool
    {
        return parent::save();
    }

    public function fetchAll()
    {
        return parent::findAll();
    }
}