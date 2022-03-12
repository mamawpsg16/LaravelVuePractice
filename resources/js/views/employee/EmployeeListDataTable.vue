<template>
  <div class="card">
    <div class="card-header">
      <div class="card-title">Employee List</div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table
          id="employee-table"
          class="table-sm table-bordered table-hover text-center display"
          width="100%"
        >
          <thead>
            <tr>
              <th class="pt-3 pb-3">
                <input
                  type="text"
                  placeholder="#"
                  class="form-control"
                  style="font-size: 9px"
                />
                <br />
                <p style="font-size: 11px; font-weight: bolder">#</p>
              </th>
              <th class="pt-3 pb-3">
                <input
                  type="text"
                  placeholder="Name"
                  class="form-control"
                  style="font-size: 9px"
                />
                <br />
                <p style="font-size: 11px; font-weight: bolder">Name</p>
              </th>
              <th class="pt-3 pb-3">
                <input
                  type="text"
                  placeholder="Address"
                  class="form-control"
                  style="font-size: 9px"
                />
                <br />
                <p style="font-size: 11px; font-weight: bolder">Address</p>
              </th>
              <th class="pt-3 pb-3">
                <input
                  type="text"
                  placeholder="Contact"
                  class="form-control"
                  style="font-size: 9px"
                />
                <br />
                <p style="font-size: 11px; font-weight: bolder">Contact</p>
              </th>
              <th class="pt-3 pb-3">
                <input
                  type="text"
                  placeholder="Department"
                  class="form-control"
                  style="font-size: 9px"
                />
                <br />
                <p style="font-size: 11px; font-weight: bolder">Department</p>
              </th>
              <th class="column-search">
                <select class="form-control" style="font-size: 9px">
                  <option value="">ALL STATUS</option>
                  <option value="1">ACTIVE</option>
                  <option value="0">INACTIVE</option>
                </select>
                <br />
                <p style="font-size: 11px; font-weight: bolder">Status</p>
              </th>
              <th class="column-search">
                <input
                  type="text"
                  placeholder="Actions"
                  class="form-control"
                  style="font-size: 9px"
                  disabled="disabled"
                />
                <br />
                <p style="font-size: 11px; font-weight: bolder">Actions</p>
              </th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
//For Datatable to work
import "datatables.net";
import EmployeeEdit from "./EmployeeEdit.vue";
export default {
  name: "EmployeeList",
  data() {
    return {
      employees: [],
    };
  },
  mounted() {
    this.getEmployeeLists();
    this.taetae();
  },
  components: {
    "employee-edit": EmployeeEdit,
  },
  methods: {
    taetae(){
      console.log(this.$el);
    },

    getEmployeeLists() {
      // INITIALIZE DATATABLE
      $("#employee-table")
        .DataTable({
          //LOADING
          //   processing: true,
          //AJAX
          serverSide: true,
          //DIRECTION
          order: [[1, "desc"]],
          //AJAX
          ajax: {
            url: "/api/getEmployeeLists",
            dataList: "json",
            type: "POST",
            // data: { _token: "{{csrf_token()}}" },
          },
          //TABLE COLUMNS SHOULD BE THE SAME IN CONTROLLER
          columns: [
            { data: "#" },
            { data: "name" },
            { data: "address" },
            { data: "contact" },
            { data: "department" },
            { data: "status" },
            {
              data: "actions",
              //allowing modification
              // createdCell(cell, cellData, rowData) {
              //   console.log(cellData);
              //   let EmployeeListDataTableActions = Vue.extend(
              //     require("./EmployeeListDataTableAction.vue").default
              //   );
              //   let instance = new EmployeeListDataTableActions().$mount();
              //   $(cell).empty().append(instance.$el);
              // },
            },
          ],
          //View Count in Table
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
          ],
        })
        .columns();
    },
    beforeDestroy: function () {
      $(this.$el).DataTable().destroy();
    },
  },
};
</script>
