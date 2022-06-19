<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];


    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }

    public function scopeIsAdmin($query)
    {
        return $query->select('admin')->where('id', Auth::id())->first()->admin;
    }

    public function getTimeReseve()
    {
        return $this->reserves->whereBetween('day', [
            Carbon::now()->subDays(90)->format('Y-m-d'),
            Carbon::now()->format('Y-m-d'),
        ]);
    }

    public function rangeColor()
    {
        if ($this->getTimeReseve()->count() > 5) {
            return 'green';
        } elseif ($this->getTimeReseve()->count() >= 2 && $this->getTimeReseve()->count() <= 5) {
            return 'orange';
        } elseif ($this->getTimeReseve()->count() < 2) {
            return 'red';
        }
    }

    public function name(): Attribute
    {
        return new Attribute(
            get: fn ($name) => ucfirst($name),
        );
    }

    public function getTotalPriceAttribute()
    {
        return $this->reserves->sum('price');
    }

    public function getLastReserveAttribute()
    {
        $last = $this->reserves->sortBy(
            fn($val) => Carbon::parse($val->day. ' ' . $val->open_time)
        )->last();
        if (!empty($last)) {
            return 'The last reserved time for this user ' . $last->open_time . ' to ' .
                $last->exit_time . ' on a ' . str_replace('-', '/', $last->day);
        }
        return 'No reservations have been made yet';
    }
}
