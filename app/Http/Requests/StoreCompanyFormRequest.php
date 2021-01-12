<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyFormRequest extends FormRequest
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
            'company_name' => 'required|max:255|unique:companies',
            'company_address' => 'required|max:255',
            'CEO' => 'required|max:255',
            'phone_company' => 'required|unique:companies',
            'email_company' => 'required|email|unique:companies',
            'quantity_employees' => 'required|integer',
            'id_district' => 'required|max:100',
            'id_activity_company' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'company_name.required' => 'Поле company_name обьязательное',
            'company_name.max' => 'Максимальное количество символов в поле company_name 255',
            'company_name.unique' => 'Компания с таким именем уже существует',
            'company_address.required' => 'Поле company_address обьязательное',
            'company_address.max' => 'Максимальное количество символов в поле company_address 255',
            'CEO.required' => 'Поле CEO обьязательное',
            'CEO.max' => 'Максимальное количество символов в поле CEO 255',
            'phone_company.required' => 'Поле phone_company обьязательное',
            'phone_company.unique' => 'Номер телефона уже существует',
            'email_company.required' => 'Поле email_company обьязательное',
            'email_company.email' => 'Не корректное значение email',
            'email_company.unique' => 'Email уже существует',
            'quantity_employees.required' => 'Поле quantity_employees обьязательное',
            'quantity_employees.integer' => 'Поле quantity_employees должно содержать только цифры',
            'id_district.required' => 'Поле district обьязательное',
            'id_district.max' => 'Максимальное количество символов в поле district 255',
            'id_activity_company.required' => 'Поле activity_company обьязательное',
            'id_activity_company.max' => 'Максимальное количество символов в поле activity_company 255',
        ];
    }
}
