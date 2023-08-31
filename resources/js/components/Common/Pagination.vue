<template>
    <ul class="pagination">
        <li v-if="pagination.current_page > 1">
            <el-button class="mr-2" aria-label="Previous" v-on:click.prevent="changePage(pagination.current_page - 1)">
                <span aria-hidden="true">«</span>
            </el-button>
        </li>
        <li v-for="page in pagesNumber" :class="{'active': page == pagination.current_page}">
            <el-button class="mr-2" v-if="page == pagination.current_page" type="primary" v-on:click.prevent="changePage(page)">{{ page }}</el-button>
            <el-button class="mr-2" v-else v-on:click.prevent="changePage(page)">{{ page }}</el-button>
        </li>
        <li v-if="pagination.current_page < pagination.last_page">
            <el-button class="mr-2" aria-label="Next" v-on:click.prevent="changePage(pagination.current_page + 1)">
                <span aria-hidden="true">»</span>
            </el-button>
        </li>
    </ul>
</template>
<script>
  export default{
      props: {
      pagination: {
          type: Object,
          required: true
      },
      offset: {
          type: Number,
          default: 4
      }
    },
    computed: {
      pagesNumber() {
        if (!this.pagination.to) {
          return [];
        }
        let from = this.pagination.current_page - this.offset;
        if (from < 1) {
          from = 1;
        }
        let to = from + (this.offset * 2);
        if (to >= this.pagination.last_page) {
          to = this.pagination.last_page;
        }
        let pagesArray = [];
        for (let page = from; page <= to; page++) {
          pagesArray.push(page);
        }
          return pagesArray;
      }
    },
    methods : {
      changePage(page) {
        this.pagination.current_page = page;
        this.$emit('paginate');
      }
    }
  }
</script>