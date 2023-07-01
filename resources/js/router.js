import { createRouter, createWebHistory } from 'vue-router'

import TableEmployeeComponent from './components/employee/TableEmployeeComponent'
import CreateEmployeeComponent from './components/employee/CreateEmployeeComponent'
import EditEmployeeComponent from './components/employee/EditEmployeeComponent'

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/employees', component: TableEmployeeComponent, name : 'employee.index' },
        { path: '/new-employee', component: CreateEmployeeComponent, name: 'employee.new' },
        { path: '/employee/:id', component: EditEmployeeComponent, name: 'employee.show' }
    ]
})

