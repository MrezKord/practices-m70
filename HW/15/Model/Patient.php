<?php

namespace Model;

use Core\dbModel;

class Patient extends dbModel 
{

    public string $profile_photo = '';
    public string $family_history = '';
    public string $phone = '';
    public $user_id = '';
    
    public function tableName(): string
    {
        return 'Patient';   
    }

    public function rules() : array
    {
        return [
            'profile_photo' => [self::RULE_FILE],
            'family_history' => [self::RULE_REQUIRED],
            'phone' => [self::RULE_REQUIRED]
        ];
    }

    public function label() : array
    {
        return [
            'profile_photo' => 'Profile Photo',
            'family_history' => 'Family History',
            'phone' => 'Phone'
        ];
    }

    public function attributes() : array
    {
        return ['profile_photo', 'family_history', 'phone', 'user_id'];
    }
}