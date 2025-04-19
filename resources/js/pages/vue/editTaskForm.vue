<template>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Edit Task</h2>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="">
                        <label for="">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Title" v-model="task.title">
                    </div>
                    <div class="mt-2">
                        <label for="">Due Date <span class="text-danger">*</span></label>
                        <input type="date" name="due_date" class="form-control" v-model="task.due_date">
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="description">Description <span class="text-danger">*</span></label>
                    <textarea name="description" id="" class="form-control" rows="4" placeholder="Description"
                        v-model="task.description"></textarea>
                </div>
                <div class="d-flex justify-content-end gap-1 mt-3">
                    <router-Link to="/" class="btn btn-danger">Cancel</router-Link>
                    <button class="btn btn-dark" type="button" v-on:click="updateTask(task.id)">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from '../config/axios';
import toastr from 'toastr';

export default {
    data() {
        return {
            task: {}
        }
    },
    mounted() {
        this.getTask(this.$route.params.id);
    },
    methods: {
        getTask(id) {
            axios.get('api/tasks/edit/' + id)
                .then(response => {
                    this.task = response.data.data
                }).catch(error => {
                    console.log(error);
                })
        },
        updateTask(id) {
            axios.post('/api/tasks/update/' + id, this.task)
                .then(response => {
                    if (response.data.status == 1) {
                        toastr.success(response.data.message)
                        this.task = {}
                        this.$router.push('/');
                    } else {
                        toastr.error(response.data.message);
                    }
                })
                .catch(error => {
                    console.log("Error is saving Task", error);
                })
        }

    }
}
</script>