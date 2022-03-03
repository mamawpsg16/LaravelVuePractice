<template>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <form
                id="create-customer-form"
                class="form-horizontal form-label-left"
            >
                <div class="row text-center">
                    <div class="col-sm-12 offset-md-6 col-md-6">
                        <label class="font-weight-bold">Date :</label>
                        <p>{{ getCustomerDetails.date }}</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-sm-12 col-md-6">
                        <label class="font-weight-bold">Name :</label>
                        <p>{{ getCustomerDetails.name }}</p>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label class="font-weight-bold">Address :</label>
                        <p>{{ getCustomerDetails.address }}</p>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-sm-12 col-md-6">
                        <label class="font-weight-bold">Contact # :</label>
                        <p>{{ getCustomerDetails.contact }}</p>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label class="font-weight-bold">Employee :</label>
                        <p>{{ getCustomerDetails.employee_name }}</p>
                    </div>
                </div>
                <div class="row table-responsive mb-4">
                    <table class="table table-sm table-bordered table-hover table-fixed">
                        <thead>
                            <tr>
                                <th class="th-w-multiselect">Inventory</th>
                                <th class="th-w-multiselect">Description</th>
                                <th class="th-w-amount">Quantity</th>
                                <th class="th-w-amount">Unit Price</th>
                                <th class="th-w-amount">Discount Rate</th>
                                <th class="th-w-amount">Discount Amount</th>
                                <th class="th-w-amount">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in getCustomerItems" :key="item.id">
                                <td>{{item.inventory_name}}</td>
                                <td>{{item.description}}</td>
                                <td class="text-right">{{item.quantity}}</td>
                                <td class="text-right">{{item.unit_price}}</td>
                                <td class="text-right">{{item.discount_rate}}</td>
                                <td class="text-right">{{item.discounted_amount}}</td>
                                <td class="text-right">{{item.total_price}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="offset-md-6 col-md-6">
                        <table class="table table-bordered table-hover table-fixed">
                        <tbody>
                            <tr>
                            <td class="thead-global">Total Discounted Amount</td>
                            <td class="text-right">
                                {{ getCustomerDetails.discounted_amount }}
                            </td>
                            </tr>
                            <tr>
                            <td class="thead-global">Total Amount</td>
                            <td class="text-right">
                                {{ getCustomerDetails.total_amount }}
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-sm-12 offset-md-6 col-md-6">
                        <label class="font-weight-bold">Status :</label>
                        <p>{{ getCustomerDetails.status }}</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import state from "./customer";
export default {
    name: "CustomerRead",
    data() {
        return {};
    },
    mounted() {},
    computed: {
        getCustomerDetails() {
            return state.state.customer_details;
        },
        getCustomerItems() {
            return state.state.customer_items;
        },
    },
    components: {},
    methods: {},
};
</script>

<style lang="scss" scoped></style>
