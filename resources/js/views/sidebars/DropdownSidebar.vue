<template>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="fa fa-building"></i>
            <p>
                General
                <i class="fas fa-angle-left right">
                </i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <task-sidebar></task-sidebar>
            <department-sidebar></department-sidebar>
            <employee-sidebar></employee-sidebar>
        </ul>
    </li>
</template>
<script>
import TaskSidebar from "./TaskSidebar.vue";
import DepartmentSidebar from "./DepartmentSidebar.vue";
import EmployeeSidebar from "./EmployeeSidebar.vue";
export default {
    name:'DropdownSidebar',
    components:{
        "task-sidebar": TaskSidebar,
        "department-sidebar": DepartmentSidebar,
        'employee-sidebar': EmployeeSidebar
    }
}
</script>
