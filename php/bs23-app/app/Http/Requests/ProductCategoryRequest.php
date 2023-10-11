<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');
        //dd($this->route);
//$id =1;
        if($id) {
            return [
               // 'productCategoryName' => ['required',Rule::unique('product_categories,name')->ignore($id)],
                'productCategoryName' => 'required',
                'productCategoryStatus' => 'numeric',
            ];
        }
        return [
            'productCategoryName' => 'required|unique:product_categories,name',
            'productCategoryStatus' => 'numeric'
        ];
    }
}
