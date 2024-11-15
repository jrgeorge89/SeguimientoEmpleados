<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Filters\EmployeeFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new EmployeeFilter();
        $queryItems = $filter->transform($request);

        $sorting = new Employee();
        $parameter = $sorting->sortingParameter($request);
        $column = $parameter[0];
        $direction = $parameter[1];
        
        // Filtros Personalizados y Ordenamiento a los Empleados
        $employees = Employee::where($queryItems)->orderBy($column, $direction)->paginate(4);
        $employees->appends($request->query());

        return new EmployeeCollection($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = new Employee($request->validated());

        if ($request->hasFile('url_logo')) {
            $path = $request->file('url_logo')->store('companylogo', 'public'); 
            // Para personalizar el nombre de la imagen, se debe configurar en config/filesystems.php el 'driver' => 'local' a 'public':
            // $path = $request->file('url_logo')->store('companylogo', strtolower($request->companie) . '_' . Carbon::now()->format('YmdHis') . '.' . $request->url_logo->extension());
            $employee->url_logo = $path;
        }
    
        $employee->save();

        $data = [
            'message' => 'Empleado creado',
            'data' => new EmployeeResource($employee),
            // 'data' => new EmployeeResource(Employee::create($request->validated())),
            'status' => 200
        ];
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee, $id)
    {
        $employee = Employee::find($id);
        return new EmployeeResource($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee, $id)
    {
        // $data = $request->all();
        // $request2 = [
        //     'Request' => $data,
        //     // 'Name 1' => $data['name'],
        //     'Name 2' => $request->name,
        //     'Name 3' => $request->input('name'),
        //     'Logo 1' => $request->url_logo,
        //     'Logo 2' => $request->input('url_logo'),
        // ];
        // return response()->json($request2, 200);
        
        $employee = Employee::find($id);

        if (!$employee) {
            $data = [
                'message' => 'Empleado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        if ($request->has('name')) {
            $employee->name = $request->name;
        }
        if ($request->has('email')) {
            $employee->email = $request->email;
        }
        if ($request->has('area')) {
            $employee->area = $request->area;
        }
        if ($request->has('categorie_id')) {
            $employee->categorie_id = $request->categorie_id;
        }
        if ($request->has('companie')) {
            $employee->companie = $request->companie;
        }
        if ($request->has('satisfaction')) {
            $employee->satisfaction = $request->satisfaction;
        }
        if ($request->has('favorite')) {
            $employee->favorite = $request->favorite;
        }

        if ($request->hasFile('url_logo')) {
            $path = $request->file('url_logo')->store('companylogo', 'public');
            $employee->url_logo = $path;
        }

        $employee->update();
        // Storage::delete($path); //Elimina la imagen del Storage

        $data = [
            'message' => 'Empleado actualizado',
            'data' => new EmployeeResource($employee),
            'status' => 200
        ];        
        return response()->json($data, 200);

        // Devuelve una respuesta JSON
        // if ($request->ajax()) {
        //     return response()->json($data, 200);
        // } else {
        //     return redirect()->route('model.index');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            $data = [
                'message' => 'Empleado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $employee->delete();
        
        $data = [
            'message' => 'Empleado eliminado',
            'status' => 202
        ];
        return response()->json($data, 202);
    }

}
