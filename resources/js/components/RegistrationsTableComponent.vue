<template>
  <el-table
    ref="filterTable"
    :data="tableData"
    border
    style="width: 100%">
    <el-table-column
      prop="count"
      label="#"
      fixed="left"
      align="center"
      width="50">
      <template slot-scope="scope">
          {{ scope.$index + registrations.from }}
      </template>
    </el-table-column>
    <el-table-column
      label="Personal Details"
      width="305">
      <template slot-scope="scope">
        <el-descriptions class="margin-top" :column="1" size="mini" border>
          <el-descriptions-item>
            <template slot="label">
              <i class="el-icon-user"></i>
              Generated ID
            </template>
            {{ scope.row.uuid }}
          </el-descriptions-item>
          <el-descriptions-item label="Complete Name">{{ scope.row.firstname }} {{ scope.row.lastname }}</el-descriptions-item>
          <el-descriptions-item label="Facebook Name">{{ scope.row.facebook_name || '--' }}</el-descriptions-item>
          <el-descriptions-item label="Registration Type">
            <el-tag effect="plain" size="mini" :type="scope.row.registration_type === 'Guest' ? '' : 'warning'">{{ scope.row.registration_type }}</el-tag>
          </el-descriptions-item>
          <el-descriptions-item label="Local Church">{{ scope.row.local_church }}</el-descriptions-item>
          <el-descriptions-item label="Date Registered">{{ $func.formatToDateTime(scope.row.created_at) }}</el-descriptions-item>
        </el-descriptions>
      </template>
    </el-table-column>
    <el-table-column
      label="Other Details"      
      width="300">
      <template slot-scope="scope">
        <el-descriptions class="margin-top" :column="1" size="mini" border>
          <el-descriptions-item label="Category"><i>{{ scope.row.category }}</i></el-descriptions-item>
          <el-descriptions-item label="Attending Option">{{ scope.row.attending_option }}</el-descriptions-item>
          <el-descriptions-item label="Rate">{{ $func.formatAmount(scope.row.rate) }}</el-descriptions-item>
          <el-descriptions-item label="Booking Confirmation Rate">{{ $func.formatAmount(scope.row.can_book_rate) }}</el-descriptions-item>
          <el-descriptions-item label="Total Paid">{{ $func.formatAmount(scope.row.payments_sum_amount || 0) }}</el-descriptions-item>
          <el-descriptions-item label="Payment Status">
            <el-tag size="mini" effect="dark" :type="scope.row.payment_status === 'Paid' ? 'success' : (scope.row.payment_status === 'Free' ? 'info' : 'warning')">{{ scope.row.payment_status }}</el-tag>
          </el-descriptions-item>
        </el-descriptions>
      </template>
    </el-table-column>
    <el-table-column
      label="Booked dates"
      align="center"
      width="255">
      <template slot-scope="scope">
        <el-alert
            v-if="scope.row.is_booking_bypassed"
            class="py-1 text-xs d-inline"
            title="All Days Pass"
            type="info"
            :closable="false">
        </el-alert>

        <el-descriptions v-else-if="scope.row.booked_dates.length > 0" class="margin-top" :column="1" size="mini" border>
          <el-descriptions-item label="Booking Status" contentClassName="text-center">
            <el-tag size="mini" :type="scope.row.booking_status === 'Confirmed' ? 'success' : (scope.row.booking_status === 'Cancelled' ? 'danger' : 'warning')">{{ scope.row.booking_status }}</el-tag>  
          </el-descriptions-item>

          <el-descriptions-item v-for="(dates, index) in scope.row.booked_dates" :key="index" :label="index === 0 ? 'Booked Dates' : ''" contentClassName="text-center">{{ dates }}</el-descriptions-item>
        </el-descriptions>

        <span v-else>--</span>
      </template>
    </el-table-column>
    <el-table-column
      label="Dates Attended"
      align="center"
      fixed="right"
      width="230">
      <template slot-scope="scope">
          <div v-if="scope.row.attended_dates.length > 0" v-html="transformDates(scope.row.attended_dates)"></div>
          <span v-else>--</span>
      </template>
    </el-table-column>
    <el-table-column
      fixed="right"
      label="Operations"
      align="center"
      width="120">
      <template slot-scope="scope">
        <el-button @click="handleClick(scope.row.uuid)" type="text" size="small">Payments</el-button>
        <a v-if="permissions.can_edit_delegate" :href="`/registration/${scope.row.uuid}/edit`"><el-button type="text" size="small">Edit Details</el-button></a>
        <a v-if="permissions.can_edit_delegate && scope.row.attending_option === 'Hybrid'" :href="`/booking/${scope.row.uuid}/edit`"><el-button type="text" size="small">Booking</el-button></a> <br />
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
            type: Object
        },
    },
    data() {
      return {
        tableData: [],
        permissions: window.auth_user.permissions
      }
    },
    mounted() {
      this.tableData = this.registrations.data
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
        },
        transformDates(dates, withStatus = false, status = null) {
          var arr = typeof dates === 'object' ? dates : dates.split(", ")
          var html = "";

          arr.forEach(element => {
            // if (withStatus) {
            //   if (status === 'Confirmed')
            //     html += "<i class='el-icon-s-flag' style='color: green'></i> ";

            //   if (status === 'Pending Payment')
            //     html += "<i class='el-icon-time' style='color: orange'></i> ";

            //   if (status === 'Cancelled')
            //     html += "<i class='el-icon-s-flag' style='color: red'></i> ";
            // }

            html += element;
          });

          return html;
        }
    }
  }
</script>