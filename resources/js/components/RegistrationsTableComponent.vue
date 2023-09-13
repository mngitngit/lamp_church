<template>
  <div class="row justify-content-center">
    <div class="col-md-24">
      <el-table
        ref="filterTable"
        class="mb-3"
        :data="tableData.data"
        border
        style="width: 100%">
        <el-table-column>
          <template slot="header" slot-scope="scope">
            <table>
              <tr style="background-color: #f5f7fa;">
              <td width="250">
                <small>Search by Name or LAMP ID</small>
                <input type="hidden" name="type" value="lookup" />
                <el-input
                  clearable
                  v-model="search.keyword"
                  size="mini"
                  name="search"
                  placeholder="Type to search"/>
              </td>

              <td width="120">
                <small>Payment Status</small>
                <el-select size="mini" v-model="search.payment_status" clearable placeholder="select">
                  <el-option label="Unsettled" value="Unsettled"></el-option>
                  <el-option label="Partial" value="Partial"></el-option>
                  <el-option label="Paid" value="Paid"></el-option>
                </el-select>
              </td>

              <td width="120">
                <small>Booking Status</small>
                <el-select size="mini" v-model="search.booking_status" clearable placeholder="select">
                  <el-option label="Pending" value="Pending Payment"></el-option>
                  <el-option label="Cancelled" value="Cancelled"></el-option>
                  <el-option label="Confirmed" value="Confirmed"></el-option>
                </el-select>
              </td>

              <td width="120">
                <small>Reg Type</small>
                <el-select size="mini" v-model="search.registration_type" clearable placeholder="select">
                  <el-option label="Member" value="Member"></el-option>
                  <el-option label="Guest" value="Guest"></el-option>
                </el-select>
              </td>

              <td width="120">
                <small>Attending Option</small>
                <el-select size="mini" v-model="search.attending_option" clearable placeholder="select">
                  <el-option label="Hybrid" value="Hybrid"></el-option>
                  <el-option label="Online" value="Online"></el-option>
                </el-select>
              </td>

              <td width="120">
                <small>Rate Category</small>
                <el-select size="mini" v-model="search.category" clearable placeholder="select">
                  <el-option label="Adult" value="Adult"></el-option>
                  <el-option label="Kids" value="Kids"></el-option>
                  <el-option label="Free" value="Free"></el-option>
                </el-select>
              </td>

              <td width="120">
                <small>Local Church</small>
                <el-select size="mini" v-model="search.local_church" clearable placeholder="select">
                  <el-option value="Bacolod" label="Bacolod"></el-option>
                  <el-option value="Binan" label="Binan"></el-option>
                  <el-option value="Canlubang" label="Canlubang"></el-option>
                  <el-option value="Dasmarinas" label="Dasmarinas"></el-option>
                  <el-option value="Granada" label="Granada"></el-option>
                  <el-option value="Hinigaran" label="Hinigaran"></el-option>
                  <el-option value="Isabela" label="Isabela"></el-option>
                  <el-option value="Muntinlupa" label="Muntinlupa"></el-option>
                  <el-option value="Pateros" label="Pateros"></el-option>
                  <el-option value="Tarlac" label="Tarlac"></el-option>
                  <el-option value="Valenzuela" label="Valenzuela"></el-option>
                </el-select>
              </td>
              <td>
                <br />
                <el-button @click="fetchRegistrations()" size="mini" type="primary">Search</el-button>
              </td>
              <td>
                <br />
                <a href="/registrations/export">
                <el-button type="success" size="mini" class="float-end">Export to Excel&nbsp;<i class="el-icon-download el-icon-right"></i></el-button>
                </a>
              </td>
              </tr>
              </table>
          </template>
          <el-table-column
            prop="count"
            label="#"
            fixed="left"
            align="center"
            width="50">
            <template slot-scope="scope">
                {{ scope.$index + tableData.from }}
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
            width="305">
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
            width="305">
            <template slot-scope="scope">
              <el-alert
                  v-if="scope.row.is_booking_bypassed"
                  class="py-1 text-xs d-inline"
                  title="All Days Pass"
                  type="info"
                  :closable="false">
              </el-alert>

              <el-descriptions v-else-if="scope.row.booked_dates.length > 0" class="margin-top" :column="1" size="mini" border>
                <el-descriptions-item label="Date Booked" contentClassName="text-center">{{ $func.formatToDateTime(scope.row.booked_date) }}</el-descriptions-item>

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
            width="305">
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
              <a :href="`/registration/${scope.row.uuid}/edit`"><el-button type="text" size="small">View Details</el-button></a>
              <el-button v-if="scope.row.email" type="text" size="small" @click="resendMail(scope.row.id)">Resend Mail</el-button>
              <el-button v-if="permissions.can_delete_delegate" class="text-danger" type="text" size="small" @click="deleteRegistration(scope.row.uuid)">Delete</el-button>
            </template>
          </el-table-column>
        </el-table-column>
      </el-table>

      <pagination 
          v-if="tableData.data.length > 0"
          class="m-0"
          :pagination="tableData"
          @paginate="fetchRegistrations()"
          :offset="4">
      </pagination>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        search: {
          keyword: '',
          payment_status: '',
          booking_status: '',
          registration_type: '',
          attending_option: '',
          category: '',
          local_church: ''
        },
        tableData: {
          total: 0,
          per_page: 2,
          from: 1,
          to: 0,
          current_page: 1,
          data: []
        },
        permissions: window.auth_user.permissions
      }
    },
    mounted() {
      this.fetchRegistrations();
    },
    methods: {
      fetchRegistrations() {
        if (this.search != '')
          this.tableData.current_page = 1;
          
        axios
            .get(`/registration/all`, {
                params: {
                    search: this.search,
                    page: this.tableData.current_page,
                }
            })
            .then(async response => {
                this.tableData = response.data;
            })
            .catch(error => {
                console.log(this.tableData)
                this.$notify.error({
                    title: error
                });
            });
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
      },
      resendMail(id) {
        const loading = this.$loading({
            lock: true,
            text: 'Loading',
            background: 'rgba(0, 0, 0, 0.7)'
        });

        axios
            .get(`/registration/${id}/resend-mail`)
            .then(async response => {
              loading.close()

              this.$notify.success({
                title: 'Email resent successfully.'
              });
            })
      }
    }
  }
</script>