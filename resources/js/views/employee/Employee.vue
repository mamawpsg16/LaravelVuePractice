<template lang="">
    <div class="container mx-auto">
        <div class="row mt-2">
            <div class="col-md-12 col-sm-12 text-right">
                <button
                    class="btn btn-sm btn-primary"
                    title="Add Employee"
                    @click="openAddEmployeeModal()"
                >
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-12">
                        <!-- <employee-list></employee-list> -->
                        <employee-datatable></employee-datatable>
                    </div>
                </div>
            </div>
        </div>
        <employee-create></employee-create>
    </div>
</template>
<script>
// import EmployeeList from "./EmployeeList";
import EmployeeListDataTable from "./EmployeeListDataTable";
import EmployeeCreate from "./EmployeeCreate";
export default {
    name: "Employee",
    components: {
        // "employee-list": EmployeeList,
        "employee-datatable": EmployeeListDataTable,
        "employee-create": EmployeeCreate,
    },
    methods: {
        openAddEmployeeModal(e) {
            $("#create-employee-modal").modal("show");
            $(".myModalLabel").text("Create Employee");
        },
    },
};
</script>
