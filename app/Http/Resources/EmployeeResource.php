<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'area' => $this->area,
            // 'categorie_id' => $this->categorie_id,
            'companie' => $this->companie,
            'url_logo' => $this->url_logo,
            'satisfaction' => $this->satisfaction,
            'favorite' => $this->favorite,
            'category' => new CategoryResource(Category::find($this->categorie_id)),
        ];
    }
}
