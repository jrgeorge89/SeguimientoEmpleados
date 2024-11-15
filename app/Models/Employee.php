<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    // protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'area',
        'categorie_id',
        'companie',
        'url_logo',
        'satisfaction',
        'favorite'
    ];

    /**
     * Sort employees in ascending or descending order
     *
     * @return \Illuminate\Validation\Rule
     */
    public function sortingParameter(Request $request)
    {
        if ($request->has('direction')) {            
            $request->validate([
                'direction' => [Rule::in(['asc', 'desc'])],
            ]);
        }
        // Obtener parámetros de ordenamiento
        $column = $request->input('column', 'id'); // columna por defecto
        $direction = $request->input('direction', 'desc'); // dirección por defecto

        // Validar la columna de ordenamiento
        $allowedColumns = ['id', 'categorie_id', 'satisfaction']; // Lista de columnas permitidas
        if (!in_array($column, $allowedColumns)) {
            $column = 'id'; // Si la columna no es válida, usar por defecto 'id'
        }

        return [$column, $direction];
    }

}
