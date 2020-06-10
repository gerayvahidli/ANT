<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExternalApplicationValidation extends FormRequest
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
        return [
           'specialty_name'=>'required',
           'city_name'=>'required',
           'main_modules'=>'required',
           'EducationBeginDate'=>'required',
           'EducationEndDate'=>'required',
           'education_fee'=>'required|integer',
           'education_language'=>'',
           /*'language_education_certificate_score'=>'required|integer',*/
           'language_education_certificate_id'=>'required',
           'located_city'=>'required',
           'work_experience_details'=>'required',
           'achievements'=>'required',
           'about_family'=>'required',
           'filename'=>'required',
           'country_id'=>'required',
           'specialty_id'=>'required',
           'university_id'=>'required',
           'education_language'=>'required',
           'deposit_object_id'=>'required',




           


        ];
    }
}
