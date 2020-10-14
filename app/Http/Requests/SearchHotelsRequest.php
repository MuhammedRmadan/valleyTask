<?php

namespace App\Http\Requests;

use App\Enum\searchTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class SearchHotelsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        //change rules according to type selected
        switch ($this->route('type')) {
            case searchTypeEnum::AGGREGATOR:
                {
                    //validation for aggreagtion API to get from all points (static rules)
                }
                break;
            case searchTypeEnum::SELECTED:
                {
                    //validation for selected API to get from certain provider (get rules from config)
                    $rules['provider_code'] = 'required';
                    if(isset($this->provider_code)){
                        //get rules for current selected provider
                        foreach (\Illuminate\Support\Facades\Config::get('providers')[$this->provider_code]['request_params'] as $param) {
                            $rules [$param['name']] = $param['validation'];
                        }
                    }
                }
                break;
            default:
                break;
        }
        return $rules;
    }
}
