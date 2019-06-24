<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
class ProjectRequest extends FormRequest
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
            'title' => 'required',
            'totalPrice' => 'required|numeric',
            'clientName' => 'required',
            'experts.*' => 'required|exists:experts,id',
            'projectAdminId' => 'required|exists:users,id',
            'marketerId' => 'required|exists:users,id',
            // 'starting_at' => 'nullable|date|date_format:Y-m-d',
            // 'ending_at' => 'nullable|date|date_format:Y-m-d',
            'descriptions' => 'nullable|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'totalPrice' => 'مبلغ کل پروژه',
            'clientName' => 'نام مشتری',
            'experts' => 'دسته بندی',
            'projectAdminId' => 'مدیر پروژه',
            'marketerId' => 'بازاریاب',
            'starting_at' => 'تاریخ شروع',
            'ending_at' => 'تاریخ پایان',
            'descriptions' => 'توضیحات',
        ];
    }

    public function getValidatorInstance()
    {
        $this->dateConvert();
        $this->priceConvert();
        return parent::getValidatorInstance();
    }

    protected function dateConvert()
    {
        $num = ['0','1','2','3','4','5','6','7','8','9','.'];
		$persian = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹',','];
        $this->merge([
            'starting_at' => str_replace($persian, $num, $this->starting_at),
            'ending_at' => str_replace($persian, $num, $this->ending_at),
        ]);
    }

    protected function priceConvert(){
        $this->merge([
            'totalPrice' => str_replace(',', '', $this->totalPrice),
        ]);
    }
}
