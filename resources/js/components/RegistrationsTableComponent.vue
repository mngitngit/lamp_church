<template>
  <el-table
    :data="registrations"
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
      align="center"
      width="130">
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
        
      }
    },
    methods: {
        handleClick(id) {
            window.location.href = `/payments/${id}/create`;
        }
    }
  }
</script>