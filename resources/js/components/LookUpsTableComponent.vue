<template>
  <div class="row justify-content-center">
    <div class="col-md-24">
      <el-table
        ref="filterTable"
        class="mb-3"
        :data="tableData.data"
        border
        style="width: 100%"
        size="mini">
        <el-table-column>
          <template slot="header" slot-scope="scope">
            <table class="w-100">
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
                  <small>Local Church</small>
                  <el-select size="mini" v-model="search.local_church" clearable placeholder="select">
                    <el-option label="All" value=""></el-option>
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
                <td width="120">
                  <small>Registration Status</small>
                  <el-select size="mini" v-model="search.registration_status" clearable placeholder="select">
                    <el-option label="All" value=""></el-option>
                    <el-option :value="1" label="Registered"></el-option>
                    <el-option :value="0" label="Not yet registered"></el-option>
                  </el-select>
                </td>
                <td width="120">
                  <br />
                  <el-button @click="fetchLookUps()" size="mini" type="primary">Search</el-button>
                </td>
                <td>
                  <br />
                  <a class="float-end" v-if="permissions.can_add_lookup_data" href="/lookup/create"><el-button size="mini" type="info" class="mx-1">Create New</el-button></a>
                  <el-button v-if="permissions.can_add_lookup_data" size="mini" type="success" class="float-end" @click="dialogVisible = true">Upload Excel&nbsp;<i class="el-icon-upload el-icon-right"></i></el-button>
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
          prop="count"
          label="AWTA Card #"
          fixed="left"
          align="center">
          <template slot-scope="scope">
              {{ scope.row.lamp_card_number }}
          </template>
        </el-table-column>
        <el-table-column
          prop="count"
          label="Complete Name"
          fixed="left"
          align="center">
          <template slot-scope="scope">
              {{ scope.row.fullname }}
          </template>
        </el-table-column>
        <el-table-column
          prop="count"
          label="Email Address"
          fixed="left"
          align="center">
          <template slot-scope="scope">
              <small>{{ scope.row.email }}</small>
          </template>
        </el-table-column>
        <el-table-column
          prop="count"
          label="Local Church"
          fixed="left"
          align="center">
          <template slot-scope="scope">
              {{ scope.row.local_church }}
          </template>
        </el-table-column>
        <el-table-column
          prop="count"
          label="Registration Status"
          fixed="left"
          align="center">
          <template slot-scope="scope">
            <el-tag v-if="scope.row.is_registered">Registered</el-tag>
            <el-tag v-else type="danger">Not yet registered</el-tag>
          </template>
        </el-table-column>
        <el-table-column
          prop="count"
          label="Days can book"
          fixed="left"
          align="center">
          <template slot-scope="scope">
            {{ scope.row.can_book_days }}
          </template>
        </el-table-column>
        <el-table-column
          fixed="right"
          label="Operations"
          align="center"
          width="120">
          <template slot-scope="scope">
            <a :href="`/lookup/${scope.row.lamp_card_number}/edit`"><el-button type="text" size="small">View Details</el-button></a>
          </template>
        </el-table-column>
      </el-table-column>
      </el-table>

      <pagination 
          v-if="tableData.data.length > 0"
          class="m-0"
          :pagination="tableData"
          @paginate="fetchLookUps(false)"
          :offset="4">
      </pagination>
    </div>

    <el-dialog
        title="Upload Look-up Data"
        :visible.sync="dialogVisible"
        width="30%">
        
        <span>
        <upload-component />
        </span>
    </el-dialog>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        search: '',
        tableData: {
          total: 0,
          per_page: 2,
          from: 1,
          to: 0,
          current_page: 1,
          data: []
        },
        search: {
          keyword: '',
          local_church: '',
          registration_status: ''
        },
        dialogVisible: false,
        permissions: window.auth_user.permissions
      }
    },
    mounted() {
      this.fetchLookUps();
    },
    methods: {
        fetchLookUps(ignore_page = true) {
          if ((this.search.keyword != '' || this.search.local_church != '' || this.search.registration_type != '') && ignore_page)
            this.tableData.current_page = 1;
            
          axios
              .get(`/lookup`, {
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
      }
}
</script>