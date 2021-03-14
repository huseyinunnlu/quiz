<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()// false varsa true yap cunku auth islemi varsa bunu yapacak
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
            'title'=>'min:3|required|max:255',
            'desc'=>'nullable|max:1000',
            'finished_at'=>'nullable|after:'.now()
        ];
    }

    public function attributes() {  //title desc yerine başlık açıklama yazmak icin
        return [
            'title'=>'Quiz Başlığı',
            'desc'=>'Quiz Açıklaması',
            'finished_at'=>'Bitiş Tarihi'
        ];
    }
}
