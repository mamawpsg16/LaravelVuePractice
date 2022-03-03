<template>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Employee List</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table
                    class="table-sm table-bordered table-hover text-center"
                    width="100%"
                >
                    <thead>
                        <tr>
                            <th class="pt-3 pb-3">Name</th>
                            <th>Address</th>
                            <th>Contact #</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="employees.length === 0">
                            <td colspan="12" class="text-center">No Data Available</td>
                        </tr>
                        <tr v-else v-for="employee in employees" :key="employee.id">
                            <td>{{ employee.name }}</td>
                            <td>{{ employee.address }}</td>
                            <td>{{ employee.contact }}</td>
                            <td>{{ employee.department_name }}</td>
                            <td>{{ employee.status }}</td>
                            <td>
                                <button
                                    title="View"
                                    class="btn btn-primary"
                                    @click="viewModal(employee.id)"
                                >
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button
                                    title="Delete"
                                    class="btn btn-danger ml-1"
                                    @click.prevent="deleteEmployee(employee.id)"
                                >
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <employee-edit></employee-edit>
    </div>
</template>

<script>
import state from "./employee";
import EmployeeEdit from "./EmployeeEdit.vue";
export default {
    name: "EmployeeList",
    data() {
        return {
            employees: [],
        };
    },
    mounted() {
        this.getEmployeeLists();
    },
    components: {
        "employee-edit": EmployeeEdit,
    },
    methods: {
        getEmployeeLists() {
            axios
                .get("/api/getEmployeeLists")
                .then((response) => {
                    this.employees = response.data;
                })
                .catch((error) => {
                    console.log("Something went wrong");
                });
        },
        viewModal(id) {
            console.log("show modal");
            axios
                .post(`/api/getEmployeeDetails/${id}`, {
                    id: id,
                })
                .then((response) => {
                    console.log("oks pa ");
                    $("#edit-employee-modal").modal("show");
                    console.log("oks pa  1");
                    $(".myModalLabel").text(
                        response.data.name +
                            " - " +
                            response.data.department_name
                    );
                    console.log("oks pa 2");
                    state.commit("getEmployeeDetailsArray", response.data);
                    state.commit("getTransactionId", response.data.id);
                    console.log("oks pa 3");
                })
                .catch((response) => {
                    this.$toast.top("Something went wrong!");
                });
        },
        deleteEmployee(id) {
            axios
                .post(`/api/deleteEmployee/${id}`, {
                    id: id,
                })
                .then((response) => {
                    this.$toast.top("Employee Succesfully Deleted!");
                    window.location.reload();
                })
                .catch((error) => {
                    this.$toast.top("Something went wrong!");
                });
        },
    },
};
</script>
