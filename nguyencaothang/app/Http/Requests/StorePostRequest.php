<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        return [
            'title' => 'required|min:6' //required là nếu chưa nhập vào form mà bấm submit thì nó báo lỗi, min:6 là ký tự ngắn nhất là 6 nếu nhỏ hơn 6 thì báo lỗi
        ];
    }

    //Phần hiển thị thông báo báo lỗi
    public function messages(): array //messages sẽ được dùng ở errỏ message ở admin.post.index
    {
        return [
            'title.required' => 'Tiêu đề không để trống!',
            'title.min' => 'Tiêu đề bài đăng ít nhất 6 ký tự'
        ];
    }
}