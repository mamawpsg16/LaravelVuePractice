<template>
    <div
        class="modal fade bs-example-modal-lg"
        id="create-inventory-modal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="createInventoryLabel"
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
                                id="create-inventory-form"
                                class="form-horizontal form-label-left"
                            >
                                <div class="row mb-3">
                                    <div class="col-sm-12 offset-md-6 col-md-6">
                                        <label class="font-weight-bold pr-3s"
                                            >Date
                                        </label>
                                        <date-picker
                                            v-model="date"
                                            format="YYYY-MM-DD"
                                            type="date"
                                            placeholder="Select date"
                                        ></date-picker>
                                        <div v-if="$v.date.$dirty">
                                            <p
                                                class="text-danger"
                                                v-if="!$v.date.required"
                                            >
                                                this field is required.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <label class="font-weight-bold"
                                            >Code</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="$v.code.$model"
                                            required
                                        />
                                        <div v-if="$v.code.$dirty">
                                            <p
                                                class="text-danger"
                                                v-if="!$v.code.required"
                                            >
                                                this field is required.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label class="font-weight-bold"
                                            >Name</label
                                        >
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="$v.name.$model"
                                            required
                                        />
                                        <div v-if="$v.name.$dirty">
                                            <p
                                                class="text-danger"
                                                v-if="!$v.name.required"
                                            >
                                                this field is required.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-sm-12 col-md-6">
                                        <label class="font-weight-bold"
                                            >Description #</label
                                        >
                                        <input
                                            type="text"
                                            v-model="description"
                                            class="form-control"
                                        />
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label class="font-weight-bold"
                                            >Unit Price</label
                                        >
                                        <input
                                            type="number"
                                            step="0.01"
                                            v-model="unit_price"
                                            class="form-control"
                                        />
                                        <div v-if="$v.unit_price.$dirty">
                                            <p
                                                class="text-danger"
                                                v-if="!$v.unit_price.required"
                                            >
                                                this select field is required.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div
                                        class="col-md-12 text-right mt-2"
                                    ></div>
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
                                @click.prevent="createInventory"
                                title="Save"
                            >
                                Create
                            </button>
                            <div class="col-md-12 text-right">
                                <p class="typo__p" v-if="submitStatus === 'OK'">
                                    Thanks for your submission!
                                </p>
                                <p
                                    class="typo__p"
                                    v-if="submitStatus === 'ERROR'"
                                >
                                    Please fill the form correctly.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { required, minLength, maxLength } from "vuelidate/lib/validators";
import Multiselect from "vue-multiselect";
import DatePicker from "vue2-datepicker";
export default {
    name: "InventoryCreate",
    data() {
        return {
            isLoading: false,
            code: "",
            name: "",
            description: "",
            date: new Date(),
            unit_price: 0.0,
            submitStatus: "",
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
        createInventory(e) {
            this.$v.$touch();
            if (this.$v.$invalid) {
                this.submitStatus = "ERROR";
            } else {
                axios
                    .post("/api/addInventory", {
                        name: this.name,
                        code: this.code,
                        name: this.name,
                        description: this.description,
                        unit_price: this.unit_price,
                        date: this.date,
                    })
                    .then((response) => {
                        this.$v.$reset();
                        this.submitStatus = "OK";
                        this.date = new Date();
                        this.name = "";
                        this.code = "";
                        this.description = "";
                        this.unit_price = null;
                        this.$toast.top("Inventory Successfully Added");
                        window.location.reload();
                    });
                e.preventDefault();
                return false;
            }
        },
        reset() {
            this.$v.$reset();
            this.submitStatus = "";
            this.date = new Date();
            this.name = "";
            this.code = "";
            this.description = "";
            this.unit_price = null;
            this.$toast.top("Form Reset Successfully");
        },
    },
};
</script>
