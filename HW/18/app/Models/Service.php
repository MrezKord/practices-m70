<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'time'
    ];

    public function scopePrice($query, $serviceName)
    {
        return $query->select('price')
                    ->where('name', $serviceName)->first()
                    ->toArray()['price'];
    }

    public function scopeTime($query, $serviceName)
    {
        return $query->select('time')
                    ->where('name', $serviceName)->first()
                    ->toArray()['time'];
    }

    public function getLabelServiceAttribute()
    {
        return ucfirst(str_replace('_', '', $this->name));
    }

}
