<template lang="">
    <div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <task-sidebar></task-sidebar>
                <department-sidebar></department-sidebar>
                <employee-sidebar></employee-sidebar>
                <inventory-sidebar></inventory-sidebar>
                <customer-sidebar></customer-sidebar>
                <exercise-sidebar></exercise-sidebar>
            </ul>
        </nav>
    </div>
</template>
<script>
import DropdownSidebar from './DropdownSidebar.vue'
import TaskSidebar from "./TaskSidebar.vue";
import DepartmentSidebar from "./DepartmentSidebar.vue";
import EmployeeSidebar from "./EmployeeSidebar.vue";
import ExerciseSidebar from "./ExerciseSidebar"
import InventorySidebar from "./InventorySidebar"
import CustomerSidebar from "./CustomerSidebar"
export default {
    name: "Sidebar",
    components: {
        "task-sidebar": TaskSidebar,
        "department-sidebar": DepartmentSidebar,
        'employee-sidebar': EmployeeSidebar,
        'dropdown-sidebar': DropdownSidebar,
        'exercise-sidebar': ExerciseSidebar,
        'inventory-sidebar' : InventorySidebar,
        'customer-sidebar' : CustomerSidebar,
    },
};
</script>
<style lang=""></style>
