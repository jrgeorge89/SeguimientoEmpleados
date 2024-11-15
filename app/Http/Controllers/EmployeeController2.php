<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $data = [
                'message' => 'No se encontraron Empleados',
                'status' => 200
            ];
            return response()->json($data, 200);
        }
        return response()->json($employees, 200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employeeData = $request->validated();

        $employee = Employee::create($employeeData);
        
        return response()->json($employee, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            $data = [
                'message' => 'Empleado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'message' => $employee,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            $data = [
                'message' => 'Empleado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $validator = validator::make($request->all(), [
            'fullname' => 'required|max:50',
            'email' => 'required|email|unique:employees',
            'area' => 'required|max:30',
            'category_id' => 'required',
            'company' => 'required|max:30',
            'url_logo' => '',
            'satisfaction' => 'required',
            'favorite' => ''
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $employee->fullname = $request->fullname;
        $employee->email = $request->email;
        $employee->area = $request->area;
        $employee->category_id = $request->category_id;
        $employee->company = $request->company;
        $employee->url_logo = $request->url_logo;
        $employee->satisfaction = $request->satisfaction;
        $employee->favorite = $request->favorite;

        $employee->save();

        $data = [
            'message' => 'Empleado actualizado',
            'employee' => $employee,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function updatePartial(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            $data = [
                'message' => 'Empleado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $validator = validator::make($request->all(), [
            'fullname' => 'max:50',
            'email' => 'email|unique:employees',
            'area' => 'max:30',
            'category_id' => '',
            'company' => 'max:30',
            'url_logo' => '',
            'satisfaction' => '',
            'favorite' => ''
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('fullname')) {
            $employee->fullname = $request->fullname;
        }
        if ($request->has('email')) {
            $employee->email = $request->email;
        }
        if ($request->has('area')) {
            $employee->area = $request->area;
        }
        if ($request->has('category_id')) {
            $employee->category_id = $request->category_id;
        }
        if ($request->has('company')) {
            $employee->company = $request->company;
        }
        if ($request->has('url_logo')) {
            $employee->url_logo = $request->url_logo;
        }
        if ($request->has('satisfaction')) {
            $employee->satisfaction = $request->satisfaction;
        }
        if ($request->has('favorite')) {
            $employee->favorite = $request->favorite;
        }

        $employee->save();

        $data = [
            'message' => 'Empleado actualizado',
            'employee' => $employee,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
