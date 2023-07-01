<?php

namespace App\Services;

use App\Models\Skill;
use App\Models\UserSkill;

class EmployeeService {

    /**
     * Actualiza la foto de portada de todos los empleados del administrador
     * 
     *  @param \App\Models\User $administrador
     *  @param String $imagen nombre de la imagen
     * 
     * @return void
     */
    public static function getSkills($employee_id)
    {
        return  UserSkill::with(['skill'])->where('user_id', $employee_id)->get();
    }

}