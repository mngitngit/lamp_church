<template>
    <div v-if="!retrieved" class="col-md-4">
      <div class="border-0 card shadow">
          <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-md-12">
                    <p class="mb-0 text-black-50 text-center mt-2 text-xxs">Align the barcode within the <br/>reader to scan</p>
                  </div>
                  <div class="col-md-6">
                    <img width="100%" class="mb-3" src="/images/barcode.png">
                  </div>
                </div>
              <div class="row" style="border-top: 2px dashed #dee2e6;">
                <div class="col-md-12">
                  <p class="mb-0 text-black-50 text-center mt-2 text-xxs">Or enter your code below</p>
                  <el-input placeholder="Your code" class="mt-2" @change="submit()" v-model="input" :autofocus="true">
                    <template style="cursor: pointer" type="primary" plain slot="append" @click="submit()">Validate</template>
                  </el-input>
                  <p v-if="error" class="text-danger">{{ error }}</p>
                </div>
              </div>
          </div>
      </div>
    </div>
    <div v-else class="col-md-5">
      <div class="border-0 card shadow mb-3">
          <div class="card-body">
            <div class="row text-center">
                <div class="col-md-12">
                  <div class="row mb-3 pt-4">
                      <div class="col-md-12">
                          <h4 class="text-lg mb-0 font-bold d-block text-uppercase">{{ retrieved.delegate.firstname }} {{ retrieved.delegate.lastname }}</h4>
                      </div>

                      <div class="col-md-12">
                          <span class="text-description d-block">{{ retrieved.delegate.local_church }}, {{ retrieved.delegate.country }}</span>
                          <small class="text-uppercase font-bold d-block">{{ retrieved.delegate.registration_type }}</small>
                      </div>
                  </div>
                </div>
                <div class="col-md-12">
                    <barcode-component :uuid="retrieved.delegate.uuid" />
                </div>
                <div class="col-md-12 mb-3">
                  <small class="text-description d-block mb-2">BOOKED DATES</small>
                    <el-tag v-for="(date, index) in retrieved.booked_dates" :key="index" class="mx-2 mb-3">{{ date }}</el-tag>
                </div>
                <div class="col-md-12 pt-3">
                  <small class="text-description d-block mb-2">ATTENDANCE STATUS (TODAY)</small>
                  <h5 class="text-success" v-if="retrieved.attended">PRESENT</h5>
                  <h5 class="text-danger" v-else>NOT YET PRESENT</h5>
                </div>
            </div>
          </div>
      </div>

      <el-button :autofocus="true" type="primary" @click="attendance()">{{ retrieved.attended ? 'Continue' : 'MARK AS PRESENT' }}</el-button>
    </div>
</template>

<script>
export default {
  data() {
    return {
      input: '',
      loading: false,
      error: null,
      retrieved: null,
      slot_id: 1
    }
  }, 
  methods: {
    async submit() {
      this.error = null;
      this.loading = true;
      this.retrieved = null

      if (! this.input)
        this.error = 'Please enter AWTA Card/Guest number.'

      await axios.get(`/attendance/` + this.input, {
        params: {
          slot_id: this.slot_id
        }
      })
      .then(async (response) => {
        this.loading = false;
        this.retrieved = response.data
      }).catch((error) => {
        this.loading = false;
        this.error = error.response.data.error;
      });
    },
    async attendance() {
      if (! this.retrieved.attended) {
        await axios.post(`/attendance/`, {
          details: this.retrieved.delegate,
          slot_id: this.slot_id
        })
        .then(async (response) => {
          this.$alert('Already recorded!', 'Attendance', {
            confirmButtonText: 'OK',
            callback: action => {
              location.reload();
            }
          });
        });
      } else {
        this.$alert('Already recorded!', 'Attendance', {
          confirmButtonText: 'OK',
          callback: action => {
            location.reload();
          }
        });
      }
    }
  }
}
</script>