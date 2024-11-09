<?php

namespace Zaker\User\Http\Controllers\Auth;


use function Zaker\User\Helpers\to_valid_mobile_number;

trait GetRegisteFieldAndValueTrait
{
    public function getFieldName()
    {
       return $this->has('email') ? 'email' : 'mobile';
    }

    public function getFieldValue()
    {
        $field = $this->getFieldName();
        $value = $this->input($field);
        if ($field === 'mobile'){
            $value = to_valid_mobile_number($value);
        }
        return $value;
    }

}
