<template>
  <el-table
    ref="filterTable"
    :data="tableData"
    border
    style="width: 100%">
    <el-table-column
      prop="created_at"
      label="Date Registered"
      align="center"
      width="230">
      <template slot-scope="scope">
          {{ $func.formatToDateTime(scope.row.created_at) }}
      </template>
    </el-table-column>
    <el-table-column
      prop="uuid"
      label="ID"
      align="center"
      width="120">
    </el-table-column>
    <el-table-column
      prop="name"
      label="Name"
      width="200">
      <template slot-scope="scope">
          {{ scope.row.firstname }} {{ scope.row.lastname }}
      </template>
    </el-table-column>
    <el-table-column
      prop="facebook_name"
      label="Facebook Name"
      width="200">
    </el-table-column>
    <el-table-column
      prop="registration_type"
      label="Registration Type"
      align="center"
      width="150">
    </el-table-column>
    <el-table-column
      prop="category"
      label="Category"
      align="center"
      width="100">
    </el-table-column>
    <el-table-column
      prop="local_church"
      label="Local Church"
      align="center"
      column-key="date"
      :filters="[{text: 'Binan', value: 'Binan'},{text: 'Canlubang', value: 'Canlubang'},{text: 'Dasmarinas', value: 'Dasmarinas'},{text: 'DC Cruz', value: 'DC Cruz'},{text: 'Granada', value: 'Granada'},{text: 'Isabela', value: 'Isabela'},{text: 'Muntinlupa', value: 'Muntinlupa'},{text: 'Pateros', value: 'Pateros'},{text: 'Tarlac', value: 'Tarlac'},{text: 'Valenzuela', value: 'Valenzuela'},{text: 'Villamar/Maao'}]"
      :filter-method="filterHandler"
      filter-placement="bottom-end"
      width="150">
    </el-table-column>
    <el-table-column
      prop="country"
      label="Country"
      align="center"
      width="150">
    </el-table-column>
    <el-table-column
      prop="attending_option"
      label="Attending Option"
      filters="[{text: 'Hybrid', value: 'Hybrid'},{text: 'Online', value: 'Online'}]"
      :filter-method="filterHandler"
      align="center"
      width="130">
    </el-table-column>
    <el-table-column
      prop="with_awta_card"
      label="with AWTA card number?"
      align="center"
      width="130">
    </el-table-column>
    <el-table-column
      prop="with_accommodation"
      label="with accommodation?"
      align="center"
      width="130">
    </el-table-column>
    <el-table-column
      prop="mode_of_transpo"
      label="Mode of transpo"
      align="center"
      width="130">
    </el-table-column>
    <el-table-column
      prop="priority_dates"
      label="Preferred dates"
      align="center"
      width="200">
    </el-table-column>
    <el-table-column
      prop="rate"
      label="Rate"
      align="center"
      width="100">
      <template slot-scope="scope">
          {{ $func.formatAmount(scope.row.rate) }}
      </template>
    </el-table-column>
    <el-table-column
      prop="payments_sum_amount"
      label="Total Paid"
      align="center"
      width="100">
      <template slot-scope="scope">
          {{ $func.formatAmount(scope.row.payments_sum_amount || 0) }}
      </template>
    </el-table-column>
    <el-table-column
      fixed="right"
      prop="payment_status"
      label="Status"
      align="center"
      width="125">
        <template slot-scope="scope">
            <el-alert
                class="py-1 text-xs d-inline"
                :title="scope.row.payment_status"
                :type="scope.row.payment_status === 'Paid' || scope.row.payment_status === 'Free' ? 'success' : 'warning'"
                :closable="false">
            </el-alert>
        </template>
    </el-table-column>
    <el-table-column
      fixed="right"
      label="Operations"
      align="center"
      width="120">
      <template slot-scope="scope">
        <el-button @click="handleClick(scope.row.uuid)" type="text" size="small">View Payments</el-button>
        <a v-if="permissions.can_edit_delegate" :href="`/registration/${scope.row.uuid}/edit`"><el-button type="text" size="small">Edit Details</el-button></a>
        <el-button v-if="permissions.can_delete_delegate" type="text" size="small" @click="deleteRegistration(scope.row.uuid)">Delete</el-button>
      </template>
    </el-table-column>
  </el-table>
</template>

<script>
  export default {
    props: {
        registrations: {
            required: true,
            type: Array
        },
    },
    data() {
      return {
        tableData: [],
        permissions: window.auth_user.permissions
      }
    },
    mounted() {
      this.tableData = this.registrations
    },
    methods: {
        handleClick(id) {
          window.location.href = `/payments/${id}/create`;
        },
        filterHandler(value, row, column) {
          const property = column['property'];
          return row[property] === value;
        },
        deleteRegistration(uuid) {
          this.$confirm(`Are you sure you want to delete this registration?`, 'Warning', {
              confirmButtonText: 'Yes',
              cancelButtonText: 'Cancel',
              type: 'warning'
          }).then(async () => {
            const loading = this.$loading({
                lock: true,
                text: 'Loading',
                background: 'rgba(0, 0, 0, 0.7)'
            });

            setTimeout(async () => {
              await axios.delete(`/registration/${uuid}/delete`)
              .then(async (response) => {
                loading.close()
                
                this.$alert('', 'Registration Successfully Deleted!', {
                    confirmButtonText: 'OK',
                    showCancelButton: false,
                    closeOnPressEscape: false,
                    closeOnClickModal: false,
                    showClose: false,
                    center: true,
                    type: 'success',
                    callback: action => {
                        window.location.reload();
                    }
                });
              })
            }, 1000);
          })
        }
    }
  }
</script>