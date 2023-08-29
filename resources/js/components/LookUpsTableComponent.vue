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
            {{ scope.$index + lookups.from }}
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
</template>

<script>
  export default {
    props: {
        lookups: {
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
      this.tableData = this.lookups.data
    },
}
</script>