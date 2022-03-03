<template>
  <div
    class="modal fade bs-example-modal-lg"
    id="edit-employee-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editEmployeeLabel"
    aria-hidden="true"
    ref="employee_details_modal"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="myModalLabel"></h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row" v-if="form_edit === true">
            <div class="col-md-12 col-sm-12">
              <form
                id="update-employee-form"
                class="form-horizontal form-label-left"
              >
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <label class="font-weight-bold">Name</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="$v.name.$model"
                      required
                    />
                    <div v-if="$v.name.$dirty">
                      <p class="text-danger" v-if="!$v.name.required">
                        this field is required.
                      </p>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <label class="font-weight-bold">Address</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="$v.address.$model"
                      required
                    />
                    <div v-if="$v.address.$dirty">
                      <p class="text-danger" v-if="!$v.address.required">
                        this field is required.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="row mt-1">
                  <div class="col-sm-12 col-md-6">
                    <label class="font-weight-bold">Contact #</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="$v.contact.$model"
                      required
                    />
                    <div v-if="$v.contact.$dirty">
                      <p class="text-danger" v-if="!$v.contact.required">
                        this field is required.
                      </p>
                      <p class="text-danger" v-if="!$v.contact.maxLength">
                        this field has a maximum of 11 numbers.
                      </p>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <label class="font-weight-bold">Department</label>
                    <multiselect
                      v-model="$v.selected_department.$model"
                      deselect-label="Can't remove this value"
                      track-by="name"
                      label="name"
                      placeholder="Select one"
                      :options="departments"
                      :searchable="true"
                      :allow-empty="false"
                    >
                    </multiselect>
                    <div v-if="$v.selected_department.$dirty">
                      <p
                        class="text-danger"
                        v-if="!$v.selected_department.required"
                      >
                        this select field is required.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 offset-md-6 col-md-6">
                    <label class="font-weight-bold">Status</label>
                    <select v-model="status" class="form-control">
                      <option disabled value="">Select Status</option>
                      <option value="1" :selected="status === 1">ACTIVE</option>
                      <option value="0" :selected="status === 0">
                        INACTIVE
                      </option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <employee-read v-if="form_edit === false"></employee-read>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-dismiss="modal"
            title="Close"
          >
            <i class="fa fa-times"></i>
          </button>
          <button
            title="Delete"
            class="btn btn-danger ml-1"
            v-if="form_edit === false"
            @click.prevent="deleteEmployee(getTransactionId)"
          >
            <i class="fa fa-trash"></i>
          </button>
          <button
            class="btn btn-primary"
            v-if="form_edit === false"
            @click="editEmployeeDetails"
            title="Edit"
          >
            <i class="fa fa-pen"></i>
          </button>
          <button
            type="submit"
            class="btn btn-primary"
            title="Update"
            v-if="form_edit === true"
            @click.prevent="updateEmployeeDetails"
          >
            Update
          </button>
          <br />
          <p class="typo__p" v-if="submitStatus === 'OK'">
            Thanks for your submission!
          </p>
          <p class="typo__p" v-if="submitStatus === 'ERROR'">
            Please fill the form correctly.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import state from "./employee";
import EmployeeRead from "./EmployeeRead";
import Multiselect from "vue-multiselect";
import { required, minLength, maxLength } from "vuelidate/lib/validators";
export default {
  name: "EmployeeEdit",
  data() {
    return {
      selected_department: "",
      departments: [],
      isLoading: false,
      name: "",
      address: "",
      contact: "",
      status: "",
      submitStatus: null,
      form_edit: false,
      id: "",
    };
  },
  validations: {
    name: {
      required,
    },
    contact: {
      required,
      maxLength: maxLength(11),
    },
    address: {
      required,
    },
    selected_department: {
      required,
    },
  },
  components: {
    Multiselect,
    "employee-read": EmployeeRead,
  },
  mounted() {
    this.getDepartments();
    $(this.$refs.employee_details_modal).on(
      "hidden.bs.modal",
      this.modalOnHide
    );
  },
  computed: {
    getTransactionId() {
      return state.state.transaction_id;
    },
  },
  methods: {
    getDepartments(query) {
      this.isLoading = true;
      axios
        .post("/api/getDepartments", {
          query: query,
        })
        .then((response) => {
          this.departments = response.data;
          this.isLoading = false;
        })
        .catch((error) => {
          this.$toast.top("Something went wrong!");
        });
    },
    modalOnHide(e) {
      this.$modalOnHide();
      state.commit("getEmployeeDetailsArray", "");
      state.commit("getTransactionId", "");
    },
    updateEmployeeDetails(e) {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.submitStatus = "ERROR";
      } else {
        axios
          .post(`/api/updateEmployee/${this.id}`, {
            id: this.id,
            name: this.name,
            contact: this.contact,
            address: this.address,
            department_id: this.selected_department.id,
            status: this.status,
          })
          .then((response) => {
            this.form_edit = false;
            this.submitStatus = "OK";
            state.commit("getEmployeeDetailsArray", response.data);
            this.$toast.top("Employee Updated Successfully");
            window.location.reload();
          });
        e.preventDefault();
        return false;
      }
    },
    editEmployeeDetails() {
      this.id = state.state.transaction_id;
      this.name = state.state.employee_details.name;
      this.contact = state.state.employee_details.contact;
      this.address = state.state.employee_details.address;
      this.status = state.state.employee_details.status_value;
      this.selected_department = {
        id: state.state.employee_details.department_id,
        name: state.state.employee_details.department_name,
      };
      this.form_edit = true;
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
