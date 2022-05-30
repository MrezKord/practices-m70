<?php

namespace Model;

use Core\dbModel;

class WorkingTime extends dbModel  
{

    private $day;

    public $Sun = '';
    public $Mon = ''; 
    public $Tues = ''; 
    public $Wed = ''; 
    public $Thurs = ''; 
    public $Fri = ''; 
    public $Sat = ''; 
    public $doctor_id = '';

    
    public function setDay($value)
    {
        $this->day = $value;
    }

    public function getDay()
    {
        return $this->day;
    }

    public function tableName() : string
    {
        return 'working_time';
    }

    public function rules() : array
    {
        return [
            'Sun' => [self::RULE_WEEK],
            'Mon' => [self::RULE_WEEK],
            'Tues' => [self::RULE_WEEK],
            'Wed' => [self::RULE_WEEK],
            'Thurs' => [self::RULE_WEEK],
            'Fri' => [self::RULE_WEEK],
            'Sat' => [self::RULE_WEEK],

        ];
    }

    public function label() : array
    {
        return [
            'Sun' => 'Sunday',
            'Mon' => 'Monday',
            'Tues' => 'Tuesday',
            'Wed' => 'Wednesday',
            'Thurs' => 'Thursday',
            'Fri' => 'Friday',
            'Sat' => 'Saturday',

        ];
    }

    public function attributes() : array
    {
        return ['Mon', 'Sun', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat', 'doctor_id'];
    }
}