<template>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <form
                id="create-inventory-form"
                class="form-horizontal form-label-left"
            >
                 <div class="row text-center">
                    <div class="col-sm-12 offset-md-6 col-md-6">
                        <label class="font-weight-bold">Date :</label>
                        <p>{{ getInventoryDetails.date }}</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-sm-12 col-md-6">
                        <label class="font-weight-bold">Code :</label>
                        <p>{{ getInventoryDetails.code }}</p>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label class="font-weight-bold">Name :</label>
                        <p>{{ getInventoryDetails.name }}</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-sm-12 col-md-6">
                        <label class="font-weight-bold">Unit Price :</label>
                        <p>{{ getInventoryDetails.unit_price }}</p>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label class="font-weight-bold">Description :</label>
                        <p>{{ getInventoryDetails.description }}</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-sm-12 offset-md-6 col-md-6">
                        <label class="font-weight-bold">Status :</label>
                        <p>{{ (getInventoryDetails.status === 1) ? 'ACTIVE' : 'INACTIVE' }}</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import state from "./inventory";
export default {
    name: "InventoryRead",
    data() {
        return {};
    },
    mounted() {},
    computed: {
        getInventoryDetails() {
            return state.state.inventory_details;
        },
    },
    components: {},
    methods: {},
};
</script>

<style lang="scss" scoped></style>
