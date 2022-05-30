<?php

namespace Model;

use Core\dbModel;
use Dotenv\Util\Str;

class DoctorProfile extends dbModel
{

    public string $education = '';
    public string $profile_photo = '';
    public string $department = '';
    public string $specialty = '';
    public string $history = '';
    public $cost = '';
    public string $address = '';
    public string $phone = '';
    public $user_id = '';



    public function tableName(): string
    {
        return 'Doctors';
    }

    public function rules(): array
    {
        return [
            'education' => [self::RULE_REQUIRED],
            'profile_photo' => [self::RULE_FILE],
            'department' => [self::RULE_REQUIRED],
            'specialty' => [self::RULE_REQUIRED],
            'history' => [self::RULE_REQUIRED],
            'cost' => [self::RULE_REQUIRED],
            'address' => [self::RULE_REQUIRED],
            'phone' => [self::RULE_REQUIRED],
            'user_id' => [self::RULE_REQUIRED],
        ];
    }

    public function label(): array
    {
        return [
            'education' => 'Education',
            'profile_photo' => 'Profile Photo',
            'department' => 'Department',
            'specialty' => 'Specialty',
            'history' => 'History',
            'cost' => 'Cost',
            'address' => 'Address',
            'phone' => 'Phone',
        ];
    }

    public function attributes(): array
    {
        return ['education', 'profile_photo', 'department', 'specialty', 'history', 'cost', 'address', 'phone', 'user_id'];
    }

}