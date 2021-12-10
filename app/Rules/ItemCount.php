<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ItemCount implements Rule
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
        $itemcount = \DB::table('items')->where('ean', $value)->get();
        if($itemcount->count() > 1){
            return false;
        };
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Има повече от един артикул с този Баркод! Търсете по име!!!';
    }
}
