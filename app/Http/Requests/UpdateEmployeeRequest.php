<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
        $method = $this->method();
        if($method == 'PUT'){
            return [
                'name' => ['sometimes', 'required','max:50'],
                'email' => ['sometimes', 'required','email'],
                'area' => ['sometimes', 'required','max:30'],
                'categorie_id' => ['sometimes', 'required'],
                'companie' => ['sometimes', 'required','max:30'],
                'url_logo' => ['sometimes', 'required','image','dimensions:min_width=200,min_height=200'],
                'satisfaction' => ['sometimes', 'required'],
                'favorite' => ['sometimes', 'required',RuLe::in(['0','1'])],
            ];
        }else{
            return [
                'name' => ['sometimes', 'required','max:50'],
                'email' => ['sometimes', 'required','email','unique:employees'],
                'area' => ['sometimes', 'required','max:30'],
                'categorie_id' => ['sometimes', 'required'],
                'companie' => ['sometimes', 'required','max:30'],
                'url_logo' => ['sometimes', 'required','image','dimensions:min_width=200,min_height=200'],
                'satisfaction' => ['sometimes', 'required'],
                'favorite' => ['sometimes', 'required',RuLe::in(['0','1'])],                    
            ];
        }
    }

    // public function prepareForValidation()
    // {
    //     $this->merge([
    //         'name' => json_encode($this->name, true),
    //         'email' => json_encode($this->email, true),
    //         'area' => json_encode($this->area, true),
    //         'categorie_id' => json_encode($this->categorie_id, true),
    //         'companie' => json_encode($this->companie, true),
    //         'url_logo' => json_encode($this->url_logo, true),
    //         'satisfaction' => json_encode($this->satisfaction, true),
    //         'favorite' => json_encode($this->favorite, true),
    //     ]);
    // }

    public function messages()
    {
        return [
            'name.max' => 'El :attribute debe tener un maximo de 50 caracteres.',
            'email.email' => 'El :attribute debe tener un formato corecto.',
            'email.unique' => 'El :attribute debe ser unico.',
            'area.max' => 'El :attribute debe tener un maximo de 30 caracteres.',
            'companie.max' => 'La :attribute debe tener un maximo de 30 caracteres.',
            'url_logo.image' => 'El :attribute debe ser una imagen.',
            'url_logo.dimensions' => 'El :attribute debe ser como minimo un tamaño de 200x200.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nombre Completo',
            'email' => 'Correo Electrónico',
            'area' => 'Area',
            'categorie_id' => 'Categoria',
            'companie' => 'Empresa',
            'url_logo' => 'Logo',
            'satisfaction' => 'Nivel de Satisfacción',
            'favorite' => 'Favorito'
        ];
    }

    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return new JsonResponse($errors, 400);
            // return response()->json(['error' => $errors], 400);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }
}
