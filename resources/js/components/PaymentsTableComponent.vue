<template>
      <el-table
          :data="registration.payments"
          border
          style="width: auto">
            <el-table-column
            prop="date_paid"
            label="Payment Date">
            </el-table-column>
            <el-table-column
            prop="amount"
            label="Amount Paid">
            </el-table-column>
            <el-table-column
            prop="user_name"
            label="Assisted by">
            </el-table-column>
      </el-table>
</template>

<script>
  export default {
    props: {
        registration: {
            required: true,
            type: Object
        }
    },
    data() {
      return {
        
      }
    },
    methods: {
        
    }
  }
</script>