<template>

    <!-- component -->
    <div class="overflow-x-auto">
        <div class="min-w-screen flex items-center justify-center font-sans overflow-hidden">
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">

                    <button @click="toNewEmployee()"
                        type="button"
                        class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline"
                    >
                        Crear empleado
                    </button>


                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">ID del empleado</th>
                                <th class="py-3 px-6 text-left">Nombre</th>
                                <th class="py-3 px-6 text-center">Email</th>
                                <th class="py-3 px-6 text-center">Puesto</th>
                                <th class="py-3 px-6 text-center">Fecha de nacimiento</th>
                                <th class="py-3 px-6 text-center">Domicilio</th>
                                <th class="py-3 px-6 text-center">Skills</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            <tr 
                                v-for="(employee, index) in employees" :key="index"
                                class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{employee.id}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <img class="w-6 h-6 rounded-full" src="https://randomuser.me/api/portraits/men/1.jpg"/>
                                        </div>
                                        <span>{{employee.name}}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{employee.email}}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{employee.job}}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
                                        {{employee.birthdate}}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
                                        {{employee.residence}}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span v-for="(item, index) in employee.skills" :key="index"
                                        class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs ml-2">
                                        {{item.skill.name}} - {{item.calification}}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        
                                        <div @click="showEmployee(employee)" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg class="h-5 w-5 flex-none stroke-sky-500" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><path d="M17.25 10c0 1-1.75 6.25-7.25 6.25S2.75 11 2.75 10 4.5 3.75 10 3.75 17.25 9 17.25 10Z"></path><circle cx="10" cy="10" r="2.25"></circle></svg>
                                        </div>
                                        <div @click="deleteEmployee(employee)" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import { responseAxios } from './../../helper';

export default {
    data(){
        return {
            employees : [],
            loading : true
        }
    },
    mounted(){
        this.getEmployees();
    },
    methods : {
        getEmployees(){

            this.loading = true;
            
            axios.get('/api/v1/employee').then( (response) => {
                this.employees = response.data.data;
            }).catch( ({response}) => {
                console.log(response);
            }).then(() => {
                this.loading = false;
            })

        },
        deleteEmployee(employee){
            
            axios.delete('/api/v1/employee/' + employee.id).then( (response) => {

                responseAxios(response)

                this.getEmployees();


            }).catch( ({response}) => {
                console.log(response);
            }).then(() => {
                
            })

        },
        toNewEmployee(){
            this.$router.push({name : 'employee.new'})
        },
        showEmployee(employee){
            this.$router.push({name : 'employee.show', params : {id : employee.id}})
        }
    }
}
</script>