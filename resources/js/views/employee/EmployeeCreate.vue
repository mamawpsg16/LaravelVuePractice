<template>
  <div
    class="modal fade bs-example-modal-lg"
    id="create-employee-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="createEmployeeLabel"
    aria-hidden="true"
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
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <form
                id="create-employee-form"
                class="form-horizontal form-label-left"
              >
                <div class="row">
                  <div class="col-sm-6 col-md-6">
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
                  <div class="col-sm-6 col-md-6">
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
                  <div class="col-sm-6 col-md-6">
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
                  <div class="col-sm-6 col-md-6">
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
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-md-12 text-right">
              <button
                class="btn btn-primary"
                @click.prevent="reset"
                title="Reset"
              >
                <i class="fa fa-undo"></i>
              </button>
              <button
                class="btn btn-success"
                type="submit"
                @click.prevent="createEmployee"
                title="Save"
              >
                Create
              </button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mr-1 text-right">
            <p v-if="submitStatus === 'OK'">Thanks for your submission!</p>
            <p v-if="submitStatus === 'ERROR'">
              Please fill the form correctly.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import { required, minLength, maxLength } from "vuelidate/lib/validators";
export default {
  name: "EmployeeCreate",
  data() {
    return {
      selected_department: "",
      departments: [],
      isLoading: false,
      name: "",
      address: "",
      contact: "",
      submitStatus: "",
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
  },
  mounted() {
    this.getDepartments();
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
    createEmployee(e) {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.submitStatus = "ERROR";
      } else {
        axios
          .post("/api/addEmployee", {
            name: this.name,
            contact: this.contact,
            address: this.address,
            department_id: this.selected_department.id,
          })
          .then((response) => {
            this.$v.$reset();
            this.submitStatus = "OK";
            this.name = "";
            this.address = "";
            this.contact = "";
            this.selected_department = null;
            this.$modalOnReload();
            this.$toast.top("Employee Successfully Added");
            window.location.reload();
          });
        e.preventDefault();
        return false;
      }
    },
    reset() {
      this.submitStatus = "";
      this.name = "";
      this.address = "";
      this.contact = "";
      this.selected_department = null;
      this.$v.$reset();
      this.$toast.top("Form Reset Successfully");
    },
  },
};
</script>
