<template>
    <div class="pt-4">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">Create Department</div>
                    <div class="card-body">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" v-model="department.name" v-on:keyup.enter="addDepartment()">
                            <span class="input-group-button ml-1">
                                <button class="btn btn-success" v-on:click="addDepartment()">Add</button>
                            </span>
                        </div>
                        <div class="alert alert-danger" v-if="!departments.length">
                            You have no departments!
                        </div>
                        <div class="table-responsive">
                            <table class="table-sm table-bordered table-hover text-center" width="100%">
                                <thead>
                                    <tr>
                                        <th class="pt-3 pb-3">Department</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="department in departments" :key="department.id">
                                        <td>{{ department.name }}</td>
                                        <td>
                                            <div class="form-group">
                                                <select v-model="department.status"  @change="updateDepartmentStatus($event,department.id)" class="form-control">
                                                    <option disabled value="">Select Status</option>
                                                    <option value="1" :selected="status === 1">ACTIVE</option>
                                                    <option value="0" :selected="status === 0">INACTIVE</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer" v-if="departments.length">
                        <span class="p-1 bg-primary">Departments:<span class="badge  badge-primary">{{ departments.length }} </span></span>
                        <span class="p-1 bg-primary">Active:<span class="badge  badge-primary">{{ getActiveDepartmentsCount() }} </span></span>
                        <span class="p-1 bg-primary">Inactive:<span class="badge  badge-primary">{{ getInactiveDepartmentsCount() }} </span></span>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:'Department',
        data(){
            return{
                departments:[],
                department:{
                    name:''
                },
                status:''
            }
        },
        mounted() {
            this.getDepartments()
        },
        methods:{
            getDepartments(){
                axios.get('/api/departments')
                .then((response) =>{
                    this.departments = response.data
                })
                .catch((error) =>{
                    console.log(error)
                })
            },
    
            getActiveDepartmentsCount(){
                return this.departments.filter(department =>{
                    return department.status
                }).length
            },

            getInactiveDepartmentsCount(){
                return this.departments.filter(department =>{
                    return !department.status
                }).length
            },

            addDepartment(){
                axios.post('/api/addDepartment',this.department)
                .then((response) =>{
                    this.$toast.top('Department succesfully added!');
                    this.departments.unshift(response.data)
                    this.department.name = ''
                })
                .catch((error) =>{
                    this.$toast.top('Something went wrong!');
                })
            },

            updateDepartmentStatus(e,id){
                axios.post(`/api/updateDepartmentStatus/${id}`,{
                    status: e.target.value,
                    id:id
                })
                .then((response) =>{
                    this.$toast.top('Department succesfully updated!');
                })
                .catch((error) =>{
                    this.$toast.top('Something went wrong!');
                })
            },
        }
    }
</script>
<style scoped>
    .done label {
        text-decoration: line-through;
    }
</style>
