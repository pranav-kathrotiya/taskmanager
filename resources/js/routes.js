import TaskList from './pages/vue/listTask.vue';
import AddTaskForm from './pages/vue/addTaskForm.vue';
import EditTaskForm from './pages/vue/editTaskForm.vue';

export const routes = [{
        path: '/',
        component: TaskList
    },
    {
        path: '/add-task',
        component: AddTaskForm
    },
    {
        path: '/edit-task/:id',
        component: EditTaskForm
    }
];
