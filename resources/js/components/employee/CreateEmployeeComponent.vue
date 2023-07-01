<template>
    <div>

        
                    

        <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
            <div class="w-full lg:w-4/6">

                <button type="button" class="
                    px-6
                    py-2.5
                    bg-blue-600
                    text-white
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    rounded
                    shadow-md
                    hover:bg-blue-700 hover:shadow-lg
                    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-blue-800 active:shadow-lg
                    transition
                    duration-150
                    ease-in-out"
                    @click="irAEmployees()">
                    Regresa
                </button>

                <br>
                <br>

                <div v-if="success" class="alert bg-green-100 rounded-lg py-5 px-6 mb-3 text-base text-green-700 inline-flex items-center w-full alert-dismissible fade show" role="alert">
                    <strong class="mr-1">Empleado creado!</strong>
                    <button type="button" class="btn-close box-content w-4 h-4 p-1 ml-auto text-yellow-900 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-yellow-900 hover:opacity-75 hover:no-underline" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div v-if="error" class="bg-red-100 rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" role="alert">
                    {{error_mesagge}}
                </div>

                <div class="block p-6 rounded-lg shadow-lg bg-white">
                    <form>
                        
                        <!-- Name -->
                        <div class="form-group mb-6">
                            <label for="exampleInputPassword1" class="form-label inline-block mb-2 text-gray-700">Nombre</label>
                            <input v-model="name" type="text" class="form-control block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
                                placeholder="Nombre">
                        </div>

                        <!-- Email -->
                        <div class="form-group mb-6">
                            <label for="exampleInputPassword1" class="form-label inline-block mb-2 text-gray-700">Email</label>
                            <input v-model="email" type="email" class="form-control block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
                                placeholder="Email">
                        </div>

                        <!-- Job -->
                        <div class="form-group mb-6">
                            <label for="exampleInputPassword1" class="form-label inline-block mb-2 text-gray-700">Puesto</label>
                            <input v-model="job" type="text" class="form-control block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
                                placeholder="Puesto">
                        </div>
                       
                        <!-- Fecha de nacimiento -->
                        <div class="form-group mb-6">
                            <label for="exampleInputPassword1" class="form-label inline-block mb-2 text-gray-700">Fecha de nacimiento</label>
                            <input v-model="birthdate" type="date" class="form-control block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
                                placeholder="Fecha de nacimiento">
                        </div>

                        <!-- Residence -->
                        <div class="form-group mb-6">
                            <label for="exampleInputPassword1" class="form-label inline-block mb-2 text-gray-700">Domicilio</label>
                            <input v-model="residence" type="text" class="form-control block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInputPassword1"
                                placeholder="Domicilio">
                        </div>

                        <!-- Skills -->
                        <div class="form-group mb-6">
                            <label for="exampleInputEmail1" class="form-label inline-block mb-2 text-gray-700">
                                {{(cargando) ? 'Cargando skills ...' : 'Skills'}}
                            </label>
                            <select class="form-select appearance-none
                                block
                                w-full
                                px-3
                                py-1.5
                                text-base
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out
                                m-0
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"
                                v-model="skill_id">
                                    
                                    <option value="">Selecciona los skills de este empleado</option>
                                    <option v-for="(skill, index) in skills" :key="index" :value="skill.id">
                                        {{skill.name}}
                                    </option>
                            </select>
                        </div>

                        <button type="button" class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                            @click="addSkill()">
                                Agregar skill
                        </button>

                        <br>
                        <br>

                        

                        <div v-if="skill_adds.length > 0">
                            <ul class="bg-white rounded-lg border border-gray-200 w-96 text-gray-900 max-w">
                                <li class="px-6 py-2 border-b border-gray-200 w-full rounded-t-lg"
                                    v-for="(skill_item, index) in skill_adds" :key="index">
                                    {{skill_item.name}}
                                    <button type="button" class=" inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                    @click="deleteSkill(skill_item.id)">
                                        Eliminar
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <br>

                    
                        <button type="button" class="
                        px-6
                        py-2.5
                        bg-blue-600
                        text-white
                        font-medium
                        text-xs
                        leading-tight
                        uppercase
                        rounded
                        shadow-md
                        hover:bg-blue-700 hover:shadow-lg
                        focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-blue-800 active:shadow-lg
                        transition
                        duration-150
                        ease-in-out"
                        @click="saveEmployee()">Guardar empleado</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
   
</template>

<script>

import { responseAxios } from './../../helper'

export default {
    data(){
        return {
            cargando : true,
            skills : [],
            skill_id : "",
            name : "",
            email : "",
            job : "",
            birthdate : "",
            residence : "",
            skill_adds : [],
            error_mesagge : "",
            error : false,
            success : false,
            calification : 5,
        }
    },
    mounted(){
        this.getSkills();
    },
    methods: {
        getSkills(){

            this.cargando = true;
            
            axios.get('/api/v1/skills').then( (response) => {
                this.skills = response.data;
            }).catch( ({response}) => {
                console.log(response);
            }).then(() => {
                this.cargando = false;
            })

        },
        addSkill(){

            if(!this.skillIsPresent(this.skill_id)){

                let skill = this.skills.filter((item) => item.id == this.skill_id);

                if(skill.length > 0){

                    console.log('Agregando skill');
                    console.log(skill[0]);

                    this.skill_adds.push({
                        id : skill[0].id,
                        calification : this.calification,
                        name : skill[0].name
                    })

                }

                

                

            }

            
        },
        skillIsPresent(skill_id){

            for(let item_ of this.skill_adds){
                if(item_.id == skill_id){
                    return true;
                }
            }

            return false;

        },
        deleteSkill(skill_id){

            this.skill_adds = this.skill_adds.filter((item_) => {
                return skill_id != item_.id;
            })

        },
        saveEmployee(){

            axios.post('/api/v1/employee', {
                name : this.name,
                email : this.email,
                job  : this.job,
                birthdate : this.birthdate,
                residence : this.residence,
                skills    : this.skill_adds
            }).then( (response) => {

                this.success = true;
                this.resetPrperties();
                

            }).catch( ({response}) => {
                console.log(response);

                responseAxios(response)

                /*if(response.status == 422){

                    let errors = response.data.errors;

                    console.log(error);

                

                    this.error = true;
                    this.error_mesagge = '';

                }
                */

                

            }).then(() => {
                this.cargando = false;
            })

        },


        resetPrperties(){
            this.skill_adds = [];
            this.name = "";
            this.email = "";
            this.job = "";
            this.birthdate = "";
            this.residence = "";
        },
        irAEmployees(){
            this.$router.push({name: "employee.index"})
        }
    }
}
</script>