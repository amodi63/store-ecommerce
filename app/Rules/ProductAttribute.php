<?php

namespace App\Rules;


use App\Models\AttributeTranslation;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use App\Models\Attribute;

class ProductAttribute implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $name;
    private $id;
    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
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
        if ($this->id) :
            $attribute = AttributeTranslation::where('name', $value)->where('attribute_id', '!=', $this->id)->first();
        else :
            $attribute = AttributeTranslation::where('name', $value)->first();
        endif;
        if ($attribute) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Attribute Is Already Exist';
    }
}
