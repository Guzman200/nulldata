<template>
        <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <img class="mx-auto h-12 w-auto"
                        src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="Workflow">
                    <h2 class="mt-6 text-center text-3xl tracking-tight font-bold text-gray-900">
                        Prueba técnica NullData
                    </h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                        <hr>
                        <a @click="employees()" href="#" class="font-medium text-danger-600 hover:text-indigo-500">
                            Iniciar
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <router-view></router-view>
</template>

<script>
export default {
    methods: {
        employees(){
            this.$router.push({name: "employee.index"})
        }
    },
};
</script>
