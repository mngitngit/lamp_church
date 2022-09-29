<template>
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="160px">
        <div class="card mb-3">
            <div class="card-body pt-0">
                <div class="row justify-content-center">
                    <el-form-item class="check-dates" :label="`Choose the dates you would like to attend physically. Please select at least 1 day (maximum of ${max} days)`" prop="booked" required>
                        <el-checkbox-group v-model="ruleForm.booked" size="small">
                            <div class="row">
                                <div v-for="(date, index) in dates" :key="index" class="col-md-3 text-center">
                                    <el-badge :value="`${date.available} left!`" class="item m-3 c-booking-date" :type="date.available <= 10 ? 'danger' : (date.available <= 100 ? 'warning' : 'success')">
                                        <el-checkbox
                                            :label="date.id"
                                            name="booked"
                                            border
                                            :disabled="(!ruleForm.booked.includes(date.id) && ruleForm.booked.length === max) || (date.available === 0 && !ruleForm.booked.includes(date.id) && !initial.includes(date.id))"
                                            @change="onChangeProcessed($event,date.id)">
                                            {{ date.event_date }}
                                        </el-checkbox>
                                    </el-badge>
                                </div>
                            </div>
                        </el-checkbox-group>
                    </el-form-item>
                </div>
            </div>
        </div>

        <el-row>
            <div class="col-md-12">
                <el-button type="warning" @click="submitForm('ruleForm')">Continue</el-button>
            </div>
        </el-row>
    </el-form>
</template>

<script>
export default {
    props: {
        uuid: {
            required: true,
            type: String
        },
        booked_dates: {
            required: false,
            type: Array
        },
        slots: {
            required: false,
            type: Array
        },
        can_book_days: {
            required: true,
            type: Number
        }
    },
    data () {
      return {
        dates: [],
        initial: [],
        ruleForm: {
            booked: [],
        },
        rules: {
            booked: [
                {required: true, message: 'Please select atleast one day', trigger: 'change'}
            ],
        },
        max: 2
      }
    },
    mounted() {
        this.dates = this.slots.map(({event_date, id, available, seat_count}) => ({event_date, id, available, seat_count}) );
        this.ruleForm.booked = this.booked_dates.map(function (date) { return date.slot.id; });
        this.initial = this.booked_dates.map(function (date) { return date.slot.id; });
        this.max = this.can_book_days
    },
    methods: {
        submitForm(formName) {
            this.$refs[formName].validate(async (valid) => {
                this.$confirm(`Are you sure you want to continue?`, 'Warning', {
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(async () => {
                    const loading = this.$loading({
                        lock: true,
                        text: 'Loading',
                        background: 'rgba(0, 0, 0, 0.7)'
                    });

                    await axios.post(`/booking/${this.uuid}/update`, {
                        dates: this.ruleForm.booked
                    })
                    .then(async (response) => {
                        loading.close()

                        this.$alert('', 'Successfully Booked!', {
                            confirmButtonText: 'OK',
                            showCancelButton: false,
                            closeOnPressEscape: false,
                            closeOnClickModal: false,
                            showClose: false,
                            center: true,
                            type: 'success',
                            callback: action => {
                                window.location.href = `registration/${this.uuid}`;
                            }
                        });
                    }).catch((error) => {
                        loading.close()

                        this.$alert('', error.response.data.error, {
                            confirmButtonText: 'OK',
                            showCancelButton: false,
                            closeOnPressEscape: false,
                            closeOnClickModal: false,
                            showClose: false,
                            center: true,
                            type: 'error',
                            callback: action => {
                                window.location.reload();
                            }
                        });
                    });
                });
            })
        },
        onChangeProcessed(isChecked, id) {
            var result;
            for (var i = 0, len = this.dates.length; i < len; i++) {
                if (this.dates[i]['id'] === id) {
                    this.dates[i]['available'] += isChecked ? -1 : 1
                    break;
                }
            }
        }
    }
}
</script>