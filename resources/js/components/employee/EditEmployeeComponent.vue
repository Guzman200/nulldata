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
                    Regresar 
                </button>

                <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">

                    <article class="flex max-w-xl flex-col items-start justify-between">
                        <div class="flex items-center gap-x-4 text-xs">
                        <time datetime="2020-03-16" class="text-gray-500">Nacimiento: {{employee.birthdate}}</time>

                        <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                            Domicilio: {{employee.residence}}
                        </a>

                        <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                            Email: {{employee.email}}
                        </a>

                        </div>
                        <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <a href="#">
                            <span class="absolute inset-0"></span>
                            Skills del empleado
                            </a>
                        </h3>
                        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">

                            <span  v-for="(skill, index) in employee.skills" :key="index"
                                        class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs ml-2">
                                        {{skill.skill.name}} - {{skill.calification}}
                            </span>

                            


                        </p>
                        </div>
                        <div class="relative mt-8 flex items-center gap-x-4">
                        <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-10 w-10 rounded-full bg-gray-50">
                        <div class="text-sm leading-6">
                            <p class="font-semibold text-gray-900">
                            <a href="#">
                                <span class="absolute inset-0"></span>
                                {{employee.name}}
                            </a>
                            </p>
                            <p class="text-gray-600">{{employee.job}}</p>
                        </div>
                        </div>
                    </article>

                <!-- More posts... -->
                </div>
                
            </div>

        </div>

    </div>
   
</template>

<script>
export default {
    data(){
        return {
            employee_id : "",
            cargando : true,
            employee : {
                id : 0,
                name : '',
                email : '',
                job : '',
                birthdate : '',
                residence : '',
                skills : []
            }
        }
    },
    mounted(){
        this.employee_id     = this.$route.params.id;
        this.getEmployee();
    },
    methods: {
        getEmployee(){
            
            axios.get('/api/v1/employee/' + this.employee_id).then( (response) => {
                
                console.log(response.data);

                this.employee = response.data;

            }).catch( ({response}) => {
                console.log(response);
            }).then(() => {
                this.cargando = false;
            })

        },
        irAEmployees(){
            this.$router.push({name: "employee.index"})
        }
    }
}
</script>