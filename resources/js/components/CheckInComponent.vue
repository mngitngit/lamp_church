<template>
<div>
    <div v-if="!validated" class="row justify-content-center">
        <div class="col-md-3">
            <img width="100%" class="mb-3 rounded shadow" src="/images/2023_banner.jpg">
        </div>
    </div>

    <div v-if="validated" class="row justify-content-center mb-4">
        <div class="col-md-4">
            <h3>My Bookings</h3>
            <el-alert
                class="mb-3"
                :title="`Hey ${retrieved.details.firstname}! 👋🏻`"
                type="warning"
                description="Please select the date you like to check-in.">
            </el-alert>
            <el-card shadow="always" class="mb-3 pb-0" :style="!date.is_happening && date.attendance_status === 'Pending' ? 'opacity: 0.5;' : ''" v-for="date in retrieved.details.bookings" :key="date.id">
                <div class="clearfix">
                    <span><i class="el-icon-date"></i>&nbsp;&nbsp;{{ date.slot.event_date }}</span>
                    <el-button v-if="date.status === 'Confirmed' && date.attendance_status === 'Pending' && date.is_happening == true" style="float: right;" @click="check_in(date.id)" size="mini" type="success">Check in!</el-button>
                    <el-button v-else-if="date.attendance_status != 'Pending'" style="float: right;" size="mini" type="primary" plain @click="viewPass(date.attendance.id)">View Pass</el-button>
                </div>
            </el-card>
        </div>
    </div>

    <div v-else class="row justify-content-center mb-4">
        <div class="col-md-3">
            <el-card shadow="always" class="mb-3 pb-0" style="border-top: 10px solid rgb(60 189 181)">
                <h3>Online Check In</h3>
                <p class="mt-2 c-booking-subheader">Type in your details to check in.</p>

                <div class="px-2 row">
                    <el-alert
                        v-if="disabled"
                        title="Members' booking & rebooking is already closed. For other concerns, please reach out to your local AWTA Registrars."
                        type="warning"
                        :closable="false"
                        show-icon>
                    </el-alert>
                </div>

                <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="160px">
                    <div class="row mb-1">
                        <div class="col-md-12">
                            <el-form-item label="Last Name" prop="lastName" required :error="fieldErrors">
                                <el-input :disabled="disabled" v-model="ruleForm.lastName"></el-input>
                            </el-form-item>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-12">
                            <el-form-item label="Local Church" prop="localChurch" required :error="fieldErrors">
                                <el-select :disabled="disabled" v-model="ruleForm.localChurch" placeholder="Choose">
                                    <el-option v-for="(value, local_church) in assignments" :key="local_church" :label="local_church" :value="local_church"></el-option>
                                </el-select>
                            </el-form-item>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-12">
                            <el-form-item class="transform-uppercase" label="LAMP ID / Guest Number" prop="referenceNumber" required :error="fieldErrors">
                                <el-input :disabled="disabled" v-model="ruleForm.referenceNumber"></el-input>
                            </el-form-item>
                        </div>
                    </div>

                    <div v-if="error" class="row">
                        <div class="col-md-12">
                            <div style="color: #F56C6C;font-size: 12px;">{{ error }}</div>
                        </div>
                    </div>
                </el-form>
            </el-card>

            <div class="row">
                <div class="col-md-12">
                    <el-button :loading="isLoading" :autofocus="true" type="theme" @click="validateDelegate('ruleForm')" :disabled="disabled">Continue</el-button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        loc: {
            type: String,
            default: false,
        }
    },
    data () {
      return {
        ruleForm: {
            'lastName': '',
            'localChurch': '',
            'referenceNumber': ''
        },
        disabled: false,
        rules: {
            lastName: [
                { required: true, message: 'Please input Last Name', trigger: ['blur', 'change']}
            ],
            localChurch: [
                { required: true, message: 'Please select Local Church', trigger: 'change'}
            ],
            referenceNumber: [
                { required: true, message: 'Please input Reference Number', trigger: ['blur', 'change']},
            ],
        },
        validated: false,
        error: null,
        isLoading: false,
        fieldErrors: null,
        // retrieved: {"slots":[{"id":1,"event_date":"December 27","seat_count":600,"registration_type":"Member","created_at":"2023-08-30T11:17:41.000000Z","updated_at":"2023-08-30T11:17:41.000000Z","available":580,"taken":20,"percentage":"3.33"},{"id":2,"event_date":"December 28","seat_count":600,"registration_type":"Member","created_at":"2023-08-30T11:17:41.000000Z","updated_at":"2023-08-30T11:17:41.000000Z","available":582,"taken":18,"percentage":"3.00"},{"id":3,"event_date":"December 29","seat_count":600,"registration_type":"Member","created_at":"2023-08-30T11:17:41.000000Z","updated_at":"2023-08-30T11:17:41.000000Z","available":590,"taken":10,"percentage":"1.67"},{"id":4,"event_date":"December 30","seat_count":600,"registration_type":"Member","created_at":"2023-08-30T11:17:41.000000Z","updated_at":"2023-08-30T11:17:41.000000Z","available":592,"taken":8,"percentage":"1.33"}],"uuid":"LAMP00001","details":{"id":1,"uuid":"LAMP00001","email":"melanie.ngitngit@yahoo.com","firstname":"Melanie","lastname":"De Vera","fullname":"Melanie De Vera","facebook_name":"Melanie Ngitngit","registration_type":"Member","local_church":"Muntinlupa","cluster_group":"CB (Carmona/Biñan)","country":"Philippines","category":"Adult","attending_option":"Hybrid","rate":"900.000","payment_status":"Paid","booking_status":"Confirmed","with_awta_card":"none","can_book_rate":"450.000","can_book_days":5,"rebooking_limit":2,"is_booking_bypassed":0,"visitor_to_member":null,"medical_assistance_needed":"N/A","avail_new_lamp_id":null,"notes":[],"activities":[{"user":"Melanie Ngitngit","message":"updated Will avail new LAMP ID","timestamp":"Oct 18, 2023 07:47 PM"},{"user":"Melanie Ngitngit","message":"updated Will avail new LAMP ID","timestamp":"Sep 18, 2023 09:55 PM"},{"user":"Melanie Ngitngit","message":"updated Number of days can book\", \"Will avail new LAMP ID","timestamp":"Sep 18, 2023 09:53 PM"},{"user":"Melanie Ngitngit","message":"updated Will avail new LAMP ID","timestamp":"Sep 18, 2023 09:52 PM"},{"user":"Melanie Ngitngit","message":"updated is availing new LAMP ID","timestamp":"Sep 18, 2023 09:52 PM"},{"user":"Melanie Ngitngit","message":"updated Number of days can book, answer if will avail new LAMP ID","timestamp":"Sep 18, 2023 09:51 PM"},{"user":"Melanie Ngitngit","message":"updated answer if will avail new LAMP ID","timestamp":"Sep 18, 2023 09:51 PM"},{"user":"Melanie Ngitngit","message":"updated columns.avail_new_lamp_id","timestamp":"Sep 18, 2023 09:49 PM"},{"user":"Melanie Ngitngit","message":"updated Number of days can book","timestamp":"Sep 18, 2023 09:48 PM"},{"user":"Melanie Ngitngit","message":"resent email notification","timestamp":"Sep 03, 2023 12:26 AM"},{"user":"Ma.  Jerriper Oviedo","message":"Resent email notification.","timestamp":"Sep 02, 2023 10:05 PM"}],"booking_activities":[{"user":"Melanie Ngitngit","message":"Melanie De Vera rebooked for December 27, December 28, December 29, December 30","timestamp":"Dec 05, 2023 01:50 PM"},{"user":"Melanie Ngitngit","message":"Removed all the booked dates by Melanie Ngitngit","timestamp":"Dec 01, 2023 10:51 AM"},{"user":"Melanie Ngitngit","message":"This delegate was rebooked by Melanie Ngitngit for December 27, December 28","timestamp":"Dec 01, 2023 10:51 AM"},{"user":"Melanie Ngitngit","message":"Removed all the booked dates by Melanie Ngitngit","timestamp":"Dec 01, 2023 10:49 AM"},{"user":"Melanie Ngitngit","message":"This delegate was rebooked by Melanie Ngitngit for December 27, December 28","timestamp":"Dec 01, 2023 10:41 AM"},{"user":"Melanie Ngitngit","message":"This delegate was rebooked by Melanie Ngitngit for December 27, December 29, December 30, December 28","timestamp":"Oct 18, 2023 07:28 PM"},{"user":"Melanie Ngitngit","message":"This delegate was rebooked by Melanie Ngitngit for December 27, December 29, December 30","timestamp":"Sep 09, 2023 08:28 PM"}],"booked_date":"2023-12-05 13:50:24","created_at":"2023-08-30T12:12:42.000000Z","updated_at":"2023-12-05T05:50:24.000000Z","payments_sum_amount":"900.000","old_uuid":"LPMU00199","bookings":[{"id":98,"registration_uuid":"LAMP00001","slot_id":1,"local_church":"Muntinlupa","status":"Confirmed","created_at":"2023-12-05T05:50:24.000000Z","updated_at":"2023-12-05T05:50:24.000000Z","attendance":"Online Check In","is_happening":false,"slot":{"id":1,"event_date":"December 27","seat_count":600,"registration_type":"Member","created_at":"2023-08-30T11:17:41.000000Z","updated_at":"2023-08-30T11:17:41.000000Z","available":580,"taken":20,"percentage":"3.33"}},{"id":99,"registration_uuid":"LAMP00001","slot_id":2,"local_church":"Muntinlupa","status":"Confirmed","created_at":"2023-12-05T05:50:24.000000Z","updated_at":"2023-12-05T05:50:24.000000Z","attendance":"Pending","is_happening":true,"slot":{"id":2,"event_date":"December 28","seat_count":600,"registration_type":"Member","created_at":"2023-08-30T11:17:41.000000Z","updated_at":"2023-08-30T11:17:41.000000Z","available":582,"taken":18,"percentage":"3.00"}},{"id":100,"registration_uuid":"LAMP00001","slot_id":3,"local_church":"Muntinlupa","status":"Confirmed","created_at":"2023-12-05T05:50:24.000000Z","updated_at":"2023-12-05T05:50:24.000000Z","attendance":"Pending","is_happening":false,"slot":{"id":3,"event_date":"December 29","seat_count":600,"registration_type":"Member","created_at":"2023-08-30T11:17:41.000000Z","updated_at":"2023-08-30T11:17:41.000000Z","available":590,"taken":10,"percentage":"1.67"}},{"id":101,"registration_uuid":"LAMP00001","slot_id":4,"local_church":"Muntinlupa","status":"Confirmed","created_at":"2023-12-05T05:50:24.000000Z","updated_at":"2023-12-05T05:50:24.000000Z","attendance":"Pending","is_happening":false,"slot":{"id":4,"event_date":"December 30","seat_count":600,"registration_type":"Member","created_at":"2023-08-30T11:17:41.000000Z","updated_at":"2023-08-30T11:17:41.000000Z","available":592,"taken":8,"percentage":"1.33"}}]},"can_book_days":5}
        retrieved: {
            slots: [],
            uuid: null,
            details: {},
            can_book_days: null
        },
        assignments: window.env.cluster_groups,
      }
    },
    methods: {
        validateDelegate(formName) {
            this.validated = false;

            this.retrieved = {
                slots: [],
                uuid: null,
                details: {}
            }

            this.$refs[formName].validate(async (valid) => {
                if (valid) {
                    const loading = this.$loading({
                        lock: true,
                        text: 'Loading',
                        background: 'rgba(0, 0, 0, 0.7)'
                    });

                    this.fieldErrors, this.error = null

                    axios.get("/check-in/validate", { params: this.ruleForm })
                    .then(async (response) => {
                        loading.close()

                        this.validated = true

                        var data = response.data

                        this.retrieved = {
                            slots: data.slots,
                            uuid: data.delegate.uuid,
                            details: data.delegate,
                            can_book_days: data.delegate.can_book_days
                        }
                    })
                    .catch((error) => {
                        loading.close()
                        this.error = new Error(error.response.data.error)
                        this.fieldErrors = '    '
                });;
                }
            })
        },
        check_in(id) {
            this.$confirm(`Are you sure you want to continue?`, 'Warning', {
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

                await axios.post(`/check-in/${this.retrieved.details.uuid}`, {
                    booking: id,
                    loc: this.loc
                })
                .then(async (response) => {
                    var data = response.data[response.data.length-1];
                    window.location.href = `check-in/passes?id=${data.id}`;
                });
            });
        },
        viewPass(id) {
            window.open(
                `check-in/passes?id=${id}`,
                "mywindow",
                "menubar=1,resizable=1,width=800,height=800"
            );
        }
    }
}
</script>