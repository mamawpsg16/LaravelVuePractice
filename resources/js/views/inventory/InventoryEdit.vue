<template>
  <div
    class="modal fade bs-example-modal-lg"
    id="edit-inventory-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editInventoryLabel"
    aria-hidden="true"
    ref="inventory_details_modal"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="myModalLabel"></h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            @click="modalOnHide($event)"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row" v-if="form_edit === true">
            <div class="col-md-12 col-sm-12">
              <form
                id="update-inventory-form"
                class="form-horizontal form-label-left"
              >
                <div class="row mb-3">
                  <div class="col-sm-12 offset-md-6 col-md-6">
                    <label class="font-weight-bold pr-3s">Date </label>
                    <date-picker
                      v-model="date"
                      format="YYYY-MM-DD"
                      type="date"
                      placeholder="Select date"
                    ></date-picker>
                    <div v-if="$v.date.$dirty">
                      <p class="text-danger" v-if="!$v.date.required">
                        this field is required.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <label class="font-weight-bold">Code</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="$v.code.$model"
                      required
                    />
                    <div v-if="$v.code.$dirty">
                      <p class="text-danger" v-if="!$v.code.required">
                        this field is required.
                      </p>
                    </div>
                  </div>
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
                </div>
                <div class="row mt-1">
                  <div class="col-sm-12 col-md-6">
                    <label class="font-weight-bold">Description #</label>
                    <input
                      type="text"
                      v-model="description"
                      class="form-control"
                    />
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <label class="font-weight-bold">Unit Price</label>
                    <input
                      type="number"
                      step="0.01"
                      v-model="unit_price"
                      class="form-control"
                    />
                    <div v-if="$v.unit_price.$dirty">
                      <p class="text-danger" v-if="!$v.unit_price.required">
                        this select field is required.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="offset-md-6 col-md-6">
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
          <inventory-read v-if="form_edit === false"></inventory-read>
        </div>
        <div class="modal-footer">
          <button
            title="Delete"
            class="btn btn-danger ml-1"
            v-if="form_edit === false"
            @click.prevent="deleteInventory(getTransactionId)"
          >
            <i class="fa fa-trash"></i>
          </button>
          <button
            class="btn btn-primary"
            v-if="form_edit === false"
            @click="editInventoryDetails"
            title="Edit"
          >
            <i class="fa fa-pen"></i>
          </button>
          <button
            type="submit"
            class="btn btn-primary"
            title="Update"
            v-if="form_edit === true"
            @click.prevent="updateInventoryDetails"
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
import state from "./inventory";
import InventoryRead from "./InventoryRead";
import Multiselect from "vue-multiselect";
import { required, minLength, maxLength } from "vuelidate/lib/validators";
import DatePicker from "vue2-datepicker";
export default {
  name: "InventoryEdit",
  data() {
    return {
      isLoading: false,
      code: "",
      name: "",
      description: "",
      date: new Date(),
      unit_price: 0.0,
      status: "",
      submitStatus: "",
      form_edit: false,
    };
  },
  validations: {
    name: {
      required,
    },
    code: {
      required,
    },
    date: {
      required,
    },
    unit_price: {
      required,
    },
  },
  components: {
    Multiselect,
    DatePicker,
    "inventory-read": InventoryRead,
  },
  mounted() {
    this.getDepartments();
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
      state.commit("getInventoryDetailsArray", "");
      state.commit("getTransactionId", "");
    },
    updateInventoryDetails(e) {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.submitStatus = "ERROR";
      } else {
        axios
          .post(`/api/updateInventory/${this.id}`, {
            id: this.id,
            name: this.name,
            code: this.code,
            name: this.name,
            description: this.description,
            unit_price: this.unit_price,
            date: this.date,
            status: this.status,
          })
          .then((response) => {
            this.form_edit = false;
            this.submitStatus = "OK";
            state.commit("getInventoryDetailsArray", response.data);
            this.$toast.top("Inventory Updated Successfully");
            window.location.reload();
          });
        e.preventDefault();
        return false;
      }
    },
    deleteInventory(id) {
      axios
        .post(`/api/deleteInventory/${id}`, {
          id: id,
        })
        .then((response) => {
          this.$toast.top("Inventory Succesfully Deleted!");
          window.location.reload();
        })
        .catch((error) => {
          this.$toast.top("Something went wrong!");
        });
    },
    editInventoryDetails() {
      this.id = state.state.transaction_id;
      this.code = state.state.inventory_details.code;
      this.name = state.state.inventory_details.name;
      this.description = state.state.inventory_details.description;
      this.unit_price = state.state.inventory_details.unit_price;
      this.date = new Date(state.state.inventory_details.date);
      this.status = state.state.inventory_details.status;
      this.form_edit = true;
    },
  },
};
</script>
