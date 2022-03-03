<template>
  <div
    class="modal fade bs-example-modal-lg"
    id="edit-customer-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editCustomerLabel"
    aria-hidden="true"
    ref="customer_details_modal"
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
                id="create-customer-form"
                class="form-horizontal form-label-left"
              >
                <div class="row">
                  <div class="col-sm-12 offset-md-6 col-md-6">
                    <label class="font-weight-bold mr-2 mb-4">Date</label>
                    <date-picker
                      v-model="$v.date.$model"
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
                    <label class="font-weight-bold">Employee</label>
                    <multiselect
                      v-model="$v.selected_employee.$model"
                      deselect-label="Can't remove this value"
                      track-by="name"
                      label="name"
                      placeholder="Select one"
                      :options="employees"
                      :searchable="true"
                      :allow-empty="false"
                    >
                    </multiselect>
                    <div v-if="$v.selected_employee.$dirty">
                      <p
                        class="text-danger"
                        v-if="!$v.selected_employee.required"
                      >
                        this select field is required.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 text-right">
                    <button
                      type="button"
                      class="btn btn-primary mt-3"
                      @click="addItem"
                    >
                      <i class="fas fa-plus" aria-hidden="true"></i> Add Item
                    </button>
                  </div>
                </div>
                <div class="row mt-4 mb-3">
                  <div class="table-responsive">
                    <table
                      class="
                        table table-sm table-hover table-bordered table-fixed
                      "
                    >
                      <tr>
                        <th class="th-w-multiselect">Inventory</th>
                        <th class="th-w-multiselect">Description</th>
                        <th class="th-w-amount">Quantity</th>
                        <th class="th-w-amount">Unit Price</th>
                        <th class="th-w-amount">Discount Rate</th>
                        <th class="th-w-amount">Discount</th>
                        <th class="th-w-amount">Discount Amount</th>
                        <th class="th-w-amount">Total Price</th>
                        <th class="th-w-action">Action</th>
                      </tr>
                      <tbody>
                        <tr
                          v-for="(item, id) in $v.added_items.$each.$iter"
                          :key="id"
                        >
                          <td>
                            <div class="row">
                              <div class="col-md-12">
                                <multiselect
                                  :id="'item-' + id"
                                  v-model="item.$model.selected_inventory"
                                  deselect-label="Can't remove this value"
                                  track-by="name"
                                  label="name"
                                  placeholder="Select one"
                                  :options="inventories"
                                  @select="eventOnSelectInventory"
                                  :searchable="true"
                                  :allow-empty="false"
                                >
                                </multiselect>
                                <div v-if="item.selected_inventory.$dirty">
                                  <p
                                    class="text-danger"
                                    v-if="!item.selected_inventory.required"
                                  >
                                    this select field is required.
                                  </p>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <input
                              type="text"
                              v-model="item.$model.description"
                              class="form-control"
                            />
                          </td>
                          <td>
                            <input
                              type="number"
                              v-model.number="item.$model.quantity"
                              @change="computeTotalPrice(id, $event)"
                              class="form-control"
                            />
                            <div v-if="item.quantity.$dirty">
                              <p
                                class="text-danger"
                                v-if="!item.quantity.required"
                              >
                                this select field is required.
                              </p>
                              <p
                                class="text-danger"
                                v-if="!item.quantity.minValue"
                              >
                                must be more than 0.
                              </p>
                            </div>
                          </td>
                          <td>
                            <input
                              type="number"
                              v-model.number="item.$model.unit_price"
                              step="0.001"
                              class="form-control text-right"
                              @change="computeTotalPrice(id, $event)"
                            />
                            <div v-if="item.unit_price.$dirty">
                              <p
                                class="text-danger"
                                v-if="!item.unit_price.required"
                              >
                                this select field is required.
                              </p>
                              <p
                                class="text-danger"
                                v-if="!item.unit_price.minValue"
                              >
                                must be more than 0.
                              </p>
                            </div>
                          </td>
                          <td>
                            <div class="row">
                              <div class="col-md-2">
                                <input
                                  type="checkbox"
                                  v-model="item.$model.discounted_method"
                                  @change="eventOnDiscountMethod(id, $event)"
                                />
                              </div>
                              <div class="col-md-10">
                                <input
                                  type="number"
                                  v-model.number="item.$model.discount_rate"
                                  class="form-control text-right"
                                  v-if="item.$model.discounted_method === false"
                                  value="0.00"
                                  readonly
                                />
                                <input
                                  v-else
                                  type="number"
                                  v-model="item.$model.discount_rate"
                                  @change="eventOnDiscountRate(id, $event)"
                                  class="form-control text-right"
                                  step="0.001"
                                />
                              </div>
                            </div>
                          </td>
                          <td>
                            <input
                              type="text"
                              class="text-right form-control"
                              @change="eventOnDiscount(id)"
                              v-model.number="item.$model.discount"
                            />
                          </td>
                          <td class="text-right">
                            {{ item.$model.discounted_amount }}
                          </td>
                          <td>
                            <input
                              type="text"
                              v-model="item.$model.total_price"
                              readonly="readonly"
                              class="text-right form-control"
                            />
                          </td>
                          <td class="text-center">
                            <button
                              type="button"
                              class="btn btn-danger btn-sm"
                              @click="deleteItemRow(item.$model.id, $event)"
                              v-if="id != 0"
                            >
                              <i class="fas fa-minus"></i>
                            </button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </form>
            </div>
            <div class="row mb-3">
              <div class="offset-md-6 col-md-6">
                <table class="table table-bordered table-hover table-fixed">
                  <tbody>
                    <tr>
                      <td class="thead-global">Total Discounted Amount</td>
                      <td class="text-right">
                        {{ totalDiscountedAmount }}
                      </td>
                    </tr>
                    <tr>
                      <td class="thead-global">Total Amount</td>
                      <td class="text-right">
                        {{ totalAmount }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="offset-md-6 col-md-6">
              <label class="font-weight-bold">Status</label>
              <select v-model="status" class="form-control">
                <option disabled value="">Select Status</option>
                <option value="1" :selected="status === 1">ACTIVE</option>
                <option value="0" :selected="status === 0">INACTIVE</option>
              </select>
            </div>
          </div>
          <customer-read v-if="form_edit === false"></customer-read>
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
            @click.prevent="deleteCustomer(getTransactionId)"
          >
            <i class="fa fa-trash"></i>
          </button>
          <button
            class="btn btn-primary"
            v-if="form_edit === false"
            @click="editCustomerDetails"
            title="Edit"
          >
            <i class="fa fa-pen"></i>
          </button>
          <button
            type="submit"
            class="btn btn-primary"
            title="Update"
            v-if="form_edit === true"
            @click.prevent="updateCustomerDetails"
          >
            Update
          </button>
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
import state from "./customer";
import CustomerRead from "./CustomerRead";
import Multiselect from "vue-multiselect";
import { required, minLength, maxLength } from "vuelidate/lib/validators";
import DatePicker from "vue2-datepicker";
const greaterThanZero = (value) => value > 0;
export default {
  name: "CustomerEdit",
  data() {
    return {
      status: "",
      form_edit: false,
      id: "",
      selected_employee: "",
      date: new Date(),
      employees: [],
      isLoading: false,
      name: "",
      inventories: [],
      address: "",
      contact: "",
      submitStatus: "",
      added_items: [
        {
          selected_inventory: null,
          description: "",
          quantity: 0,
          unit_price: 0.0,
          discounted_method: false,
          total_price: 0.0,
          discount_rate: 0.0,
          discount: 0,
          discounted_amount: 0.0,
        },
      ],
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
    date: {
      required,
    },
    selected_employee: {
      required,
    },
    added_items: {
      $each: {
        selected_inventory: {
          required,
        },
        quantity: {
          required,
          minValue: greaterThanZero,
        },
        unit_price: {
          required,
          minValue: greaterThanZero,
        },
      },
    },
  },
  components: {
    Multiselect,
    "customer-read": CustomerRead,
    DatePicker,
  },
  mounted() {
    this.getEmployees();
    this.getInventories();
    $(this.$refs.customer_details_modal).on(
      "hidden.bs.modal",
      this.modalOnHide
    );
    // $('#edit-customer-modal').on(
    //   'hidden.bs.modal',
    //   this.modalOnHide)
  },
  computed: {
    getTransactionId() {
      return state.state.transaction_id;
    },
    totalDiscountedAmount() {
      let array_length = this.added_items.length;
      let total_discounted_amount = 0;
      for (let index = 0; index < array_length; index++) {
        total_discounted_amount += parseFloat(
          this.added_items[index].discounted_amount
        );
      }
      return total_discounted_amount.toFixed(2);
    },
    totalAmount() {
      let array_length = this.added_items.length;
      let total_amount = 0;
      for (let index = 0; index < array_length; index++) {
        total_amount += parseFloat(this.added_items[index].total_price);
      }
      return total_amount.toFixed(2);
    },
  },
  methods: {
    getEmployees(query) {
      this.isLoading = true;
      axios
        .post("/api/getEmployees", {
          query: query,
        })
        .then((response) => {
          this.employees = response.data;
          this.isLoading = false;
        })
        .catch((error) => {
          this.$toast.top("Something went wrong!");
        });
    },
    getInventories(query) {
      axios
        .post("/api/getInventories", {
          query: query,
        })
        .then((response) => {
          this.inventories = response.data;
          this.isLoading = false;
        })
        .catch((error) => {
          this.$toast.top("Something went wrong!");
        });
    },
    // modalOnHide(e){
    //         this.$modalOnHide()
    //         this.code_error = false;
    // },
    modalOnHide(e) {
      console.log("modal on hide method");
      this.$modalOnHide();
      state.commit("getCustomerDetailsArray", "");
      state.commit("getCustomerItems", "");
      state.commit("getTransactionId", "");
    },
    editCustomerDetails() {
      this.name = state.state.customer_details.name;
      this.selected_employee = {
        id: state.state.customer_details.employee_id,
        name: state.state.customer_details.employee_name,
      };
      this.date = new Date(state.state.customer_details.date);
      this.address = state.state.customer_details.address;
      this.contact = state.state.customer_details.contact;
      this.status = state.state.customer_details.status_value;
      this.added_items = state.state.customer_items;
      this.id = state.state.transaction_id;
      this.form_edit = true;
    },
    updateCustomerDetails(e) {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.submitStatus = "ERROR";
      } else {
        axios
          .post(`/api/updateCustomer/${this.id}`, {
            id: this.id,
            status: this.status,
            name: this.name,
            contact: this.contact,
            address: this.address,
            date: JSON.stringify(this.date),
            employee_id: this.selected_employee.id,
            items: this.added_items,
            total_amount: this.totalAmount,
            total_discounted_amount: this.totalDiscountedAmount,
          })
          .then((response) => {
            this.form_edit = false;
            this.submitStatus = "OK";
            state.commit(
              "getCustomerDetailsArray",
              response.data.customer_details
            );
            state.commit("getCustomerItems", response.data.item_details);
            state.commit("getTransactionId", response.data.customer_details.id);
            this.$toast.top("Customer Updated Successfully");
            // window.location.reload();
          });
        e.preventDefault();
        return false;
      }
    },
    eventOnSelectInventory(selectedOption, id) {
      let index_id = id.split("-");
      this.added_items[index_id[1]].description = selectedOption.description;
      this.added_items[index_id[1]].unit_price = parseFloat(
        selectedOption.unit_price
      );
    },
    computeTotalPrice(id, e) {
      let total_price =
        parseFloat(this.added_items[id].unit_price) *
        parseFloat(this.added_items[id].quantity);
      this.added_items[id].total_price = total_price.toFixed(2);
      this.computeDiscountAmount(id);
      e.preventDefault();
    },
    computeDiscountAmount(id) {
      if (this.added_items[id].discount_rate != 0) {
        let discount_rate =
          parseFloat(this.added_items[id].discount_rate) / 100;
        let discount =
          parseFloat(this.added_items[id].total_price) *
          parseFloat(discount_rate);
        let discounted_amount =
          parseFloat(this.added_items[id].total_price) - parseFloat(discount);
        this.added_items[id].discount = discount.toFixed(2);
        this.added_items[id].discounted_amount = discounted_amount.toFixed(2);
      } else if (this.added_items[id].discount != 0) {
        let discount =
          parseFloat(this.added_items[id].total_price) -
          parseFloat(this.added_items[id].discount);
        this.added_items[id].discounted_amount = discount.toFixed(2);
      } else {
        this.added_items[id].discounted_amount = 0;
      }
    },
    eventOnDiscountMethod(id, e) {
      this.added_items[id].discount = 0;
      this.added_items[id].discount_rate = 0;
      this.added_items[id].discounted_amount = 0;
      e.preventDefault();
    },
    eventOnDiscount(id) {
      this.computeDiscountAmount(id);
    },
    eventOnDiscountRate(id, e) {
      if (this.added_items[id].discount_rate >= 100) {
        this.added_items[id].discount_rate = 100;
      } else if (this.added_items[id].discount_rate <= 0) {
        this.added_items[id].discount_rate = 0.0;
      }
      this.computeDiscountAmount(id);
      e.preventDefault();
    },
    addItem(e) {
      var index_count = this.added_items.length;
      this.added_items.push({
        id: index_count,
        selected_inventory: null,
        description: "",
        quantity: 0,
        unit_price: 0.0,
        discounted_method: false,
        total_price: 0.0,
        discount_rate: 0.0,
        discount: 0,
        discounted_amount: 0.0,
      });
      e.preventDefault();
      return false;
    },
    deleteCustomer(id) {
      axios
        .post(`/api/deleteCustomer/${id}`, {
          id: id,
        })
        .then((response) => {
          this.$toast.top("Customer Succesfully Deleted!");
          window.location.reload();
        })
        .catch((error) => {
          this.$toast.top("Something went wrong!");
        });
    },
    deleteItemRow(i, e) {
      this.added_items = this.added_items.filter(function (obj) {
        return obj.id !== i;
      });
      e.preventDefault();
    },
  },
};
</script>
