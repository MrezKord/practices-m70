<?php

namespace Model;

use Core\dbModel;

class Visit extends dbModel
{

    public string $time = '';
    public string $day = '';
    public $doctor_id = '';
    public $patient_id = '';

    public function rules() : array
    {
        return [
            'time' => [self::RULE_REQUIRED]
        ];
    }

    public function attributes() : array
    {
        return ['time', 'day', 'doctor_id', 'patient_id'];
    }

    public function label() : array
    {
        return [
            'time' => 'Time'
        ];
    }

    public function tableName() : string
    {
        return 'Visit';
    }
}