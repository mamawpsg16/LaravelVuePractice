<template>
    <button class="btn btn-primary btn-sm" @click="viewModal" title="View Employee Details">
        <slot><i class="fa fa-eye"></i></slot>
    </button>
</template>

<script>
    export default{
        name: 'EmployeeListDataTableAction',
        data: function() {
            return {
            }
        },
        mounted() {
        },
        methods: {
            viewModal() {
                var id  =   $(this.$el).closest('tr').find('input').val();
                console.log(id);
                return false;
                axios
                .post(`/api/getEmployeeDetails/${id}`, {
                    id: id,
                })
                .then((response) => {
                    $("#edit-employee-modal").modal("show");
                    $(".myModalLabel").text(
                        response.data.name +
                            " - " +
                            response.data.department_name
                    );
                    state.commit("getEmployeeDetailsArray", response.data);
                    state.commit("getTransactionId", response.data.id);
                })
                .catch((response) => {
                    this.$toast.top("Something went wrong!");
                });
           },
        },
    }
</script>