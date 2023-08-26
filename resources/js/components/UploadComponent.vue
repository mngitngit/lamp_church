<template>
  <div>
      <el-upload
          class="upload-demo"
          ref="upload"
          action="https://jsonplaceholder.typicode.com/posts/"
          :auto-upload="false"
          :multiple="false"
          :limit="1"
          :on-exceed="handleExceed"
          :before-remove="beforeRemove"
          name="lookup">
          <el-button slot="trigger" size="small" type="primary">select file</el-button>
          <el-button style="margin-left: 10px;" size="small" type="success" @click="submitUpload">upload to server</el-button>
          <div class="el-upload__tip" slot="tip">xlx/xls/xlsx files with maximum of 2048 rows</div>
      </el-upload>        
  </div>
</template>

<script>
  export default {
    methods: {
      submitUpload() {
        this.$refs.upload.submit();
      },
      handleExceed(files, fileList) {
        this.$message.warning(`The limit is 1, you selected ${files.length} files this time, add up to ${files.length + fileList.length} totally`);
      },
      beforeRemove(file, fileList) {
        return this.$confirm(`Cancel the attachment of ${ file.name } ?`);
      }
    }
  }
</script>