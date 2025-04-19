<template>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Tasks</h2>
                <router-link to="/add-task" class="btn btn-dark">Add New Task</router-link>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-dark">
                            <th></th>
                            <th>Sr No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(task, index) in tasks" :key="index">
                            <td>
                                <input type="checkbox" class="check-width" :checked="task.status == 2 ? true : false"
                                    @click="updateCheck(task.id)">
                            </td>
                            <td>{{ ++index }}</td>
                            <td :class="task.status == 2 ? 'text-decoration-line-through' : ''">{{ task.title }}</td>
                            <td :class="task.status == 2 ? 'text-decoration-line-through' : ''">{{ task.description }}
                            </td>
                            <td :class="task.status == 2 ? 'text-decoration-line-through' : ''">{{ task.due_date }}</td>
                            <td v-if="task.status == 1">
                                <button class="btn btn-warning btn-sm">
                                    Pending
                                </button>
                            </td>
                            <td v-else>
                                <button class="btn btn-success btn-sm">
                                    Completed
                                </button>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <router-link :to="`/edit-task/${task.id}`" class="btn btn-info btn-sm text-white">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </router-link>
                                    <button @click="removeitem(task.id)" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<style>
.check-width {
    width: 18px;
    height: 18px;
    cursor: pointer;
}
</style>

<script>
import axios from '../config/axios';
import toastr from 'toastr';
import Swal from 'sweetalert2';

export default {
    data: function () {
        return {
            tasks: [],
        }
    },
    mounted() {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "3000",
        }
        this.getList();
    },
    methods: {
        getList() {
            axios.get('api/tasks')
                .then(response => {
                    this.tasks = response.data.data
                })
                .catch(error => {
                    console.log(error);
                })
        },
        updateCheck(id) {
            axios.get('api/tasks/status/' + id)
                .then(response => {
                    if (response.data.status == 1) {
                        toastr.success(response.data.message);
                    } else {
                        toastr.warning(response.data.message);
                    }
                    this.getList();
                }).catch(error => {
                    console.log(error);
                })
        },
        async removeitem(id) {
            const result = await Swal.fire({
                title: 'Are you Sure ?',
                icon: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            });

            if (result.isConfirmed) {
                axios.get('api/tasks/destroy/' + id)
                    .then((response) => {
                        toastr.success(response.data.message)
                        this.getList();
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    },
}
</script>