<?php

namespace App\Rules;

use App\Models\Reserve;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class TrackCodeForEachUser implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $reserve = Reserve::where([
            ['user_id', Auth::id()],
            [$attribute, $value],
        ])->first();
        
        return !is_null($reserve);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be preregistered for you';
    }
}
