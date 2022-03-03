<template>
  <div class="card">
    <div class="card-header">
      <div class="card-title">Inventory List</div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table
          class="table-sm table-bordered table-hover text-center"
          width="100%"
        >
          <thead>
            <tr>
              <th class="pt-3 pb-3">Code</th>
              <th>Name</th>
              <th>Unit Price</th>
              <th>Description</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="inventories.length === 0">
              <td colspan="12" class="text-center">No Data Available</td>
            </tr>
            <tr v-else v-for="inventory in inventories" :key="inventory.id">
              <td>{{ inventory.code }}</td>
              <td>{{ inventory.name }}</td>
              <td>{{ inventory.unit_price }}</td>
              <td>{{ inventory.description }}</td>
              <td>{{ inventory.date }}</td>
              <td>{{ inventory.status === 1 ? "ACTIVE" : "INACTIVE" }}</td>
              <td>
                <button
                  title="View"
                  class="btn btn-primary"
                  @click="viewModal(inventory.id)"
                >
                  <i class="fa fa-eye"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <inventory-edit></inventory-edit>
  </div>
</template>

<script>
import state from "./inventory";
import InventoryEdit from "./InventoryEdit.vue";
export default {
  name: "InventoryList",
  data() {
    return {
      inventories: [],
    };
  },
  mounted() {
    this.getInventoryLists();
  },
  components: {
    "inventory-edit": InventoryEdit,
  },
  methods: {
    getInventoryLists() {
      axios
        .get("/api/getInventoryLists")
        .then((response) => {
          this.inventories = response.data;
        })
        .catch((error) => {
          console.log("Something went wrong");
        });
    },
    viewModal(id) {
      console.log("show modal");
      axios
        .post(`/api/getInventoryDetails/${id}`, {
          id: id,
        })
        .then((response) => {
          $("#edit-inventory-modal").modal("show");
          $(".myModalLabel").text(
            response.data.code + " - " + response.data.name
          );
          state.commit("getInventoryDetailsArray", response.data);
          state.commit("getTransactionId", response.data.id);
        })
        .catch((response) => {
          this.$toast.top("Something went wrong!");
        });
    },
  },
};
</script>
