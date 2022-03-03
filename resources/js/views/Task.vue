<template>
    <div class="pt-4">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">My Tasks</div>
                    <div class="card-body">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" v-model="task.name" v-on:keyup.enter="addTask()">
                            <span class="input-group-button ml-1">
                                <button class="btn btn-success" v-on:click="addTask()">Add</button>
                            </span>
                        </div>
                        <div class="alert alert-danger" v-if="!tasks.length">
                            You have no tasks!
                        </div>
                        <div class="tasks-lists">
                            <ul class="list-unstyled">
                                <li v-for="task in tasks" :key="task.id" :class="{ done:task.completed }">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"  v-model="task.completed" @click="updateTask(task)">{{ task.name }} <label class="form-check-label">
                                        </label>
                                        <a href="#" class="pull-right" @click.prevent="deleteTask(task)">x</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer" v-if="tasks.length">
                        <span class="p-1 bg-primary">You have {{ tasks.length }} tasks</span>
                        <span class="p-1 bg-warning">{{ remainingTasks() }} tasks left</span>
                        <span class="p-1 bg-success">{{ completedTasks() }} tasks completed</span>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:'Task',
        data(){
            return{
                tasks:[],
                task:{
                    name:''
                }
            }
        },
        mounted() {
            this.getTasks()
        },
        methods:{
            remainingTasks(){
                return this.tasks.filter(task => {
                    return !task.completed
                }).length
            },
            
            completedTasks(){
                return this.tasks.filter(task => {
                    return task.completed
                }).length
            },
            
            getTasks(){
                axios.get('/api/tasks')
                .then((response) =>{
                    this.tasks = response.data
                })
                .catch((error) =>{
                    console.log(error)
                })
            },

            addTask(){
                axios.post('/api/addTask',this.task)
                .then((response) =>{
                    this.$toast.top('Task succesfully added!');
                    this.tasks.unshift(response.data)
                    this.task.name = ''
                })
                .catch((error) =>{
                    this.$toast.top('Something went wrong!');
                })
            },

            updateTask(task){
                axios.post(`/api/updateTask/${task.id}`,{
                    completed: !task.completed,
                    id:task.id
                })
                .then((response) =>{
                    this.$toast.top('Task succesfully updated!');
                })
                .catch((error) =>{
                    this.$toast.top('Something went wrong!');
                })
            },

            deleteTask(task){
                axios.post(`/api/deleteTask/${task.id}`,{
                    id:task.id
                })
                .then((response) =>{
                    this.$toast.top('Task succesfully deleted!');
                    let taskIndex = this.tasks.indexOf(task);
                    this.tasks.splice(taskIndex,1)
                })
                .catch((error) =>{
                    this.$toast.top('Something went wrong!');
                })
            }
        }
    }
</script>
<style scoped>
    .done{
        text-decoration: line-through;
    }
</style>
