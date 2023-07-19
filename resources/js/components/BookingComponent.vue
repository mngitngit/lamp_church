<template>
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="160px">
        <div class="card">
            <div class="card-body pt-0">
                <div class="row justify-content-center">
                    <el-form-item class="check-dates" :label="`Choose the dates you would like to attend physically. Please select at least 1 day, maximum of ${max} days.`" prop="booked" required>
                        <el-checkbox-group v-model="ruleForm.booked" size="small">
                            <div class="row">
                                <div v-for="(date, index) in dates" :key="index" class="col-md-3 text-center">
                                    <el-badge :value="`${date.available} left!`" class="item my-3 c-booking-date" :type="date.available <= 10 ? 'danger' : (date.available <= 100 ? 'warning' : 'success')">
                                        <el-checkbox
                                            :label="date.id"
                                            name="booked"
                                            border
                                            @change="onChangeProcessed($event,date.id)">
                                            <span v-if="ruleForm.booked.includes(date.id)">&#10003;&nbsp;</span>{{ date.event_date }}
                                        </el-checkbox>
                                    </el-badge>
                                </div>
                            </div>
                        </el-checkbox-group>
                    </el-form-item>
                </div>
            </div>
        </div>
    </el-form>
</template>

<script>
export default {
    props: {
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
        ruleForm: {
            booked: [],
        },
        rules: {
            booked: [
                {required: true, message: 'Please select atleast one day', trigger: ['blur', 'change']},
            ],
        },
        max: 2
      }
    },
    mounted() {
        this.dates = this.slots.map(({event_date, id, available, seat_count}) => ({event_date, id, available, seat_count}) );
        this.ruleForm.booked = this.booked_dates.map(function (date) { return date.slot.id; });
        this.max = this.can_book_days
    },
    methods: {
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