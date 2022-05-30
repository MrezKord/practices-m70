<?php

namespace Model;

use Core\dbModel;

class Department extends dbModel 
{

    public string $name = '';
    public string $cost_ceiling = '';
    public $user_active_day = '';
    public $creator_id = '';


    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'cost_ceiling' => [self::RULE_REQUIRED],
            'user_active_day' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes(): array
    {
        return ['name', 'cost_ceiling', 'user_active_day', 'creator_id'];
    }

    public function tableName(): string
    {
        return 'Department';
    }

    public function label(): array
    {
        return [
            'name' => 'Name',
            'cost_ceiling' => 'Cost Ceiling',
            'user_active_day' => 'user_active_day',
        ];
    }
}