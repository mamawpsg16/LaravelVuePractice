<template>
  <div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="row text-center">
        <div class="col-sm-12 col-md-6">
          <label class="font-weight-bold">Name :</label>
          <p>{{ getEmployeeDetails.name }}</p>
        </div>
        <div class="col-sm-12 col-md-6">
          <label class="font-weight-bold">Address :</label>
          <p>{{ getEmployeeDetails.address }}</p>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-sm-12 col-md-6">
          <label class="font-weight-bold">Contact # :</label>
          <p>{{ getEmployeeDetails.contact }}</p>
        </div>
        <div class="col-sm-12 col-md-6">
          <label class="font-weight-bold">Department :</label>
          <p>{{ getEmployeeDetails.department_name }}</p>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-sm-12 offset-md-6 col-md-6">
          <label class="font-weight-bold">Status :</label>
          <p>{{ getEmployeeDetails.status }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import state from "./employee";
export default {
  name: "EmployeeRead",
  data() {
    return {};
  },
  mounted() {},
  computed: {
    getEmployeeDetails() {
      return state.state.employee_details;
    },
  },
  components: {},
  methods: {},
};
</script>

<style lang="scss" scoped></style>
