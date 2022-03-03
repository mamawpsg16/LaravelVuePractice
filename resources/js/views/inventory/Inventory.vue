<template lang="">
    <div class="container mx-auto">
        <div class="row mt-2">
            <div class="col-md-12 col-sm-12 text-right">
                <button
                    class="btn btn-sm btn-primary"
                    title="Add Inventory"
                    @click="openAddInventoryModal()"
                >
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-12">
                        <inventory-list></inventory-list>
                    </div>
                </div>
            </div>
        </div>
        <inventory-create></inventory-create>
    </div>
</template>
<script>
import InventoryList from "./InventoryList";
import InventoryCreate from "./InventoryCreate";
export default {
    name: "Inventory",
    components: {
        "inventory-list": InventoryList,
        "inventory-create": InventoryCreate,
    },
    methods: {
        openAddInventoryModal(e) {
            $("#create-inventory-modal").modal("show");
            $(".myModalLabel").text("Create Inventory");
        },
    },
};
</script>
