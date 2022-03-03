<template>
  <div class="card">
    <div class="card-header">
      <div class="card-title">Customer List</div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table-sm table-bordered table-hover" width="100%">
          <thead>
            <tr>
              <th class="pt-3 pb-3 text-center">Name</th>
              <th class="text-center">Address</th>
              <th class="text-center">Contact #</th>
              <th class="text-center">Employee</th>
              <th class="text-center">Date</th>
              <th class="text-center">Total Discounted Amount</th>
              <th class="text-center">Total Amount</th>
              <th class="text-center">Status</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="customers.length === 0">
              <td colspan="12" class="text-center font-weight-bold">
                No Data Available
              </td>
            </tr>
            <tr v-else v-for="customer in customers" :key="customer.id">
              <td class="text-center">{{ customer.name }}</td>
              <td class="text-center">{{ customer.address }}</td>
              <td class="text-center">{{ customer.contact }}</td>
              <td class="text-center">{{ customer.employee_name }}</td>
              <td class="text-center">{{ customer.date }}</td>
              <td class="text-right">
                {{ $transformToAbsolute(customer.discounted_amount) }}
              </td>
              <td class="text-right">
                {{ $transformToAbsolute(customer.total_amount) }}
              </td>
              <td class="text-center">{{ customer.status }}</td>
              <td>
                <div class="row">
                  <div class="text-center col-md-5">
                    <button
                      title="View"
                      class="btn btn-primary"
                      @click="viewModal(customer.id, $event)"
                    >
                      <i class="fa fa-eye"></i>
                    </button>
                  </div>
                  <div class="text-center col-md-5">
                    <button
                      title="Delete"
                      class="btn btn-danger ml-1"
                      @click.prevent="deleteCustomer(customer.id)"
                    >
                      <i class="fa fa-trash"></i>
                    </button>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <customer-edit></customer-edit>
  </div>
</template>

<script>
import state from "./customer";
import CustomerEdit from "./CustomerEdit";
export default {
  name: "CustomerList",
  data() {
    return {
      customers: [],
    };
  },
  mounted() {
    this.getCustomerLists();
  },
  components: {
    "customer-edit": CustomerEdit,
  },
  methods: {
    getCustomerLists() {
      axios
        .get("/api/getCustomerLists")
        .then((response) => {
          this.customers = response.data;
        })
        .catch((error) => {
          console.log("Something went wrong");
        });
    },
    viewModal(id, e) {
      axios
          .post(`/api/getCustomerDetails/${id}`, {
              id: id,
          })
          .then((response) => {
              $("#edit-customer-modal").modal("show");
              $(".myModalLabel").text(
                  response.data.customer_details.name
              );
              state.commit("getCustomerDetailsArray", response.data.customer_details);
              state.commit("getCustomerItems", response.data.item_details);
              state.commit("getTransactionId", response.data.customer_details.id);
          })
          .catch((response) => {
              this.$toast.top("Something went wrong!");
          });
      e.preventDefault();
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
  },
};
</script>
