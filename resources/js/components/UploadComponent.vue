<template>
  <div>
      <el-upload
          class="upload-demo"
          drag
          ref="upload"
          action="/lookup-upload"
          :auto-upload="false"
          :multiple="false"
          :limit="1"
          :on-exceed="handleExceed"
          :before-remove="beforeRemove"
          name="lookup">
          <i class="el-icon-upload"></i>
          <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
          <div class="el-upload__tip" slot="tip">xlx/xls/xlsx files with maximum of 2048 rows</div>
      </el-upload> 
      <el-button style="margin-left: 10px;" class="m-0 mt-2" size="small" type="success" :loading="isLoading" @click="submitUpload">upload to server</el-button>       
  </div>
</template>

<script>
import axios from 'axios';

  export default {
    data() {
      return {
        isLoading: false
      }
    },
    methods: {
      submitUpload() {
        this.$refs.upload.submit();
        // this.isLoading = true;
        // let photo = document.getElementsByName("lookup")[0].files;
        // console.log(photo)
        // let formData = new FormData();
        // formData.append("lookup", photo);
        
        // axios.post('lookup-upload', formData, {
        //   headers: {
        //     'Content-Type': 'multipart/form-data'
        //   }
        // }).then(() => {
        //   this.isLoading = false;
        //   this.$message({
        //     message: 'Successfully uploaded.',
        //     type: 'success'
        //   });
        // })
        // .catch((error) => {
        //   this.isLoading = false;
        //   this.$message.error(error.response.data.errors.lookup[0]);
        // });
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