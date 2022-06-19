<?php

namespace App\Models;

use App\Traits\TimeHandel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory, TimeHandel;

    protected $fillable = [
        'service',
        'day',
        'price',
        'open_time',
        'exit_time',
        'station_id',
        'track_code',
        'user_id'
    ];

    const TIME = ['09:00 AM', '09:00 PM'];
    const SERVICE_TIME = [
        'out_side' => 15,
        'in_side' => 20,
        'master' => 60,
    ];

    const SERVICE_PRICE = [
        'out_side' => 25,
        'in_side' => 30,
        'master' => 80,
    ];


    public function getDateAttribute()
    {
        return 'The reserved time for you is from '. $this->open_time .' to 
        '. $this->exit_time .' on a '. str_replace('-', '/', $this->day);
    }

    public function getDateForAdminAttribute()
    {
        return 'The reserved time for this user '. $this->open_time .' to' .
            $this->exit_time .' on a '. str_replace('-', '/', $this->day);
    }

    public function service() : Attribute
    {
        return Attribute::make(
            get: fn($service) => ucfirst(str_replace('_', '', $service))
        );
    }

    public function name() : Attribute
    {
        return Attribute::make(
            get: fn($name) => ucfirst($name)
        );
    }

    public function getDateforSortAttribute()
    {
        return Carbon::parse($this->day)->format('l Y-m-d');
    }

    public static function oneWeek()
    {
        $container = [];
        for ($i=0; $i < 7; $i++) { 
            $container[Carbon::now()->addDays($i)->format('l')] = Carbon::now()->addDays($i)->format('Y-m-d');
        }
        return $container;
    }

    public function CheckTimeForChenge()
    {
        $time = Carbon::parse($this->day.' '.$this->open_time);
        return (Carbon::now()->diffInMinutes($time) >= 1440 && $time > Carbon::now());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
