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
            <template slot-scope="scope">
                {{ $func.formatAmount(scope.row.amount) }}
            </template>
            </el-table-column>
            <el-table-column
            prop="user_name"
            label="Assisted by">
            </el-table-column>
            <el-table-column
              fixed="right"
              label="Operations"
              align="center"
              width="120">
              <template slot-scope="scope">
                <el-button v-if="permissions.can_delete_payment" type="text" size="small" @click="deletePayment(scope.row.id)">Delete</el-button>
              </template>
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
        permissions: window.auth_user.permissions
      }
    },
    methods: {
      deletePayment(id) {
        this.$confirm(`Are you sure you want to delete this payment?`, 'Warning', {
            customClass: 'prompt-message',
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
            await axios.delete(`/payments/${id}/delete`)
            .then(async (response) => {
              loading.close()
              
              this.$alert('', 'Payment Successfully Deleted!', {
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