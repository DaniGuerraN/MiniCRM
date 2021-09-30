<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Http\Requests\Employee\EmployeeUpdateRequest;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
class EmployeeController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->successResponse(Employee::Paginate(10));
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Employee\EmployeeStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeStoreRequest $request)
    {
        try {
            return $this->successResponse(Employee::create($request->validated()));
        } catch (\Throwable $th) {
            return $this->errorResponse($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        try {
            return $this->successResponse($employee);
        } catch (\Throwable $th) {
            return $this->errorResponse($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Employee\EmployeeUpdateRequest  $request
     * @param  App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        try {
            $employee->fill($request->validated())->save();
            return $this->successResponse($employee);
        } catch (\Throwable $th) {
            return $this->errorResponse($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        try {
            return $this->successResponse($employee->delete());
        } catch (\Throwable $th) {
            return $this->errorResponse($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
