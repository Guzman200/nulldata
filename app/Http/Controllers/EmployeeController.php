<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeEmployeeRequest;
use App\Models\User;
use App\Models\UserSkill;
use App\Services\EmployeeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::select(['id', 'name', 'email', 'job', 'birthdate', 'residence'])
            ->paginate();

        foreach ($employees as $employee) {

            $employee->skills = EmployeeService::getSkills($employee->id);
            $employee->birthdate = Carbon::parse($employee->birthdate)->format('d/m/Y');
        }

        return response()->json($employees);
    }

    public function store(storeEmployeeRequest $request)
    {

        try {

            DB::beginTransaction();

            $employee = new User();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->job = $request->job;
            $employee->birthdate = $request->birthdate;
            $employee->residence = $request->residence;
            $employee->password = 'static';
            $employee->save();

            foreach ($request->skills as $skill) {
                
                UserSkill::create([
                    'user_id'      => $employee->id, 
                    'skill_id'     => $skill['id'], 
                    'calification' => $skill['calification']
                ]);
            }

            DB::commit();

        } catch (Throwable $e) {

            DB::rollBack();

            return response()->json(['message' => 'Error Server'], 500);
        }


        return response()->json(['message' => 'Empleyee created'], 201);
    }
}
