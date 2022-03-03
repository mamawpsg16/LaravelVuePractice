<template lang="">
    <div class="container mx-auto">
        <div class="row mt-2">
            <div class="col-md-12 col-sm-12 text-right">
                <button
                    class="btn btn-sm btn-primary"
                    title="Add Customer"
                    @click="openAddCustomerModal()"
                >
                    <i class="fa fa-plus"></i>
                </button>
                <!-- <ul class="nav navbar-right mb-2">
                    <li>
                        <button class="btn btn-sm btn-danger"  v-if="show_create === true" @click="backOneStep" title="Back to Listing"><i class="fas fa-arrow-left"></i>
                        </button>
                    </li>
                </ul> -->
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-12">
                        <customer-list></customer-list>
                    </div>
                </div>
            </div>
        </div>
        <customer-create></customer-create>
    </div>
</template>
<script>
import CustomerList from "./CustomerList";
import CustomerCreate from "./CustomerCreate";
export default {
  name: "Customer",
  data() {
    return {
      // show_create:false
    };
  },
  components: {
    "customer-list": CustomerList,
    "customer-create": CustomerCreate,
  },
  methods: {
    openAddCustomerModal(e) {
      $("#create-customer-modal").modal("show");
      $("#myModalLabel").text("Create Customer");
      this.show_create = true;
    },
    // backOneStep(e){
    //     this.show_create = false;
    //     e.preventDefault();
    // },
  },
};
</script>
