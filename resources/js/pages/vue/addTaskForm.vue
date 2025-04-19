<template>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Add New Task</h2>
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
                    <button class="btn btn-dark" type="button" v-on:click="saveTask()">Save</button>
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
    methods: {
        saveTask() {
            axios.post('/api/tasks/store', this.task)
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