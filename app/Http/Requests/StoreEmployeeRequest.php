<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
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
            'name' => ['required','max:50'],
            'email' => ['required','email', 'unique:employees'],
            'area' => ['sometimes', 'required','max:30'],
            'categorie_id' => ['sometimes', 'required'],
            'companie' => ['sometimes', 'required','max:30'],
            'url_logo' => ['sometimes', 'required','image','dimensions:min_width=200,min_height=200'],
            'satisfaction' => ['required'],
            'favorite' => ['sometimes', 'required', RuLe::in(['0','1'])],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El :attribute es obligatorio y maximo de 50 caracteres.',
            'name.max' => 'El :attribute debe tener un maximo de 50 caracteres.',
            'email.required' => 'El :attribute es obligatorio.',
            'email.email' => 'El :attribute debe tener un formato corecto.',
            'email.unique' => 'El :attribute debe ser unico.',
            'area.required' => 'El :attribute es obligatoria y maximo de 30 caracteres.',
            'area.max' => 'El :attribute debe tener un maximo de 30 caracteres.',
            'categorie_id.required' => 'El :attribute es obligatoria.',
            'companie.required' => 'La :attribute es obligatoria y maximo de 30 caracteres.',
            'companie.max' => 'La :attribute debe tener un maximo de 30 caracteres.',
            'url_logo.required' => 'El :attribute es obligatorio.',
            'url_logo.dimensions' => 'El :attribute debe ser como minimo un tamaño de 200x200.',
            'satisfaction.required' => 'El :attribute es obligatorio.',
            'favorite.required' => 'El campo :attribute es obligatorio.'
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
