<template>
  <div class="row justify-content-center">
    <div class="row">
        <div class="col-md-5 mb-3 p-0">
          <div class="input-with-select el-input el-input-group el-input-group--append">
              <input type="hidden" name="type" value="lookup" />
              <input type="text" autocomplete="off" placeholder="Search by Name or ID" name="search" v-model="search" class="el-input__inner">
              <div class="el-input-group__append">
                  <button type="submit" @click="fetchLookUps()" class="el-button el-button--submit" value="Submit">
                      <i class="el-icon-search"></i>
                  </button>
              </div>
          </div>
        </div>
        <div class="col-md-7 mb-3 p-0">
            <el-button type="success" class="float-end" @click="dialogVisible = true">Upload Excel&nbsp;<i class="el-icon-upload el-icon-right"></i></el-button>
        </div>
    </div>
    <div class="col-md-24">
      <el-table
        ref="filterTable"
        class="mb-3"
        :data="tableData.data"
        border
        style="width: 100%">
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
          label="Full Name"
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
            <a :href="`/lookup/${scope.row.lamp_card_number}/edit`"><el-button type="text" size="small">Edit Details</el-button></a>
          </template>
        </el-table-column>
      </el-table>

      <pagination 
          v-if="tableData.data.length > 0"
          class="m-0"
          :pagination="tableData"
          @paginate="fetchLookUps()"
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
        dialogVisible: false,
        permissions: window.auth_user.permissions
      }
    },
    mounted() {
      this.fetchLookUps();
    },
    methods: {
        fetchLookUps() {
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