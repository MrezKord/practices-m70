<?php

namespace Model;

use Core\dbModel;

class BossProfile extends dbModel
{

    public string $education = '';
    public string $profile_photo = '';
    public string $history = '';
    public string $address = '';
    public string $phone = '';
    public $user_id = '';

    public function rules() : array
    {
        return [
            'education' => [self::RULE_REQUIRED],
            'profile_photo' => [self::RULE_FILE],
            'history' => [self::RULE_REQUIRED],
            'address' => [self::RULE_REQUIRED],
            'phone' => [self::RULE_REQUIRED],

        ];
    }

    public function label() : array
    {
        return [
            'education' => 'Education',
            'profile_photo' => 'Profile Photo',
            'history' => 'History',
            'address' => 'Address',
            'phone' => 'Phone',
        ];
    }

    public function attributes() : array
    {
        return ['education', 'profile_photo', 'history', 'address', 'phone', 'user_id'];
    }

    public function tableName() : string
    {
        return 'Bosses';
    }
}