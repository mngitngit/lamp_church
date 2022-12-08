<template>
<div class="w-full">
    <div v-if="! validated" class="row justify-content-center">
        <div class="col-md-6">
            <el-card shadow="always" class="mb-3 p-1" style="border-top: 10px solid #e9c843; height: 100% !important;">
                <div class="text-black">
                    <h6 class="fw-bolder text-muted">LAMP WORLDWIDE AWTA 2022</h6>
                    <small>
                    Timeline: December 27, 28, 29 and 30<br/>
                    Venue: Calamba Tent<br/>
                    Theme: Matthew 16:18 Upon this Rock of Salvation I Will Build My Church<br/>
                    <br/>
                    </small>

                    <h6 class="fw-bolder text-muted">GUIDELINES: </h6>
                    <small>
                    Both members and visitors will be able to start booking their seats on October 9 until November 30, 2022 for Hybrid Attendees.<br/><br/>

                    Hybrid Attendees will book for intended AWTA days only. Visitors will need to coordinate with their local coordinators for their bookings.<br/><br/>

                    Rebooking is until November 30, 2022 only. <br/><br/>
                    For any booking isues, please report to your AWTA local coordinators.<br/><br/>

                    Book now — hurry while seats last!
                    </small>
                </div>
            </el-card>
        </div>
        <div class="col-md-6">
            <el-card shadow="always" class="mb-3 pb-0" style="border-top: 10px solid #e9c843">
                <h3>Manage Booking</h3>
                <p class="mt-2 c-booking-subheader">Type in your details to manage your booking</p>

                <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="160px">
                    <div class="row mb-1">
                        <div class="col-md-12">
                            <el-form-item label="Last Name" prop="lastName" required :error="fieldErrors">
                                <el-input v-model="ruleForm.lastName"></el-input>
                            </el-form-item>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-12">
                            <el-form-item label="Local Church" prop="localChurch" required :error="fieldErrors">
                                <el-select v-model="ruleForm.localChurch" placeholder="Choose">
                                    <el-option label="Binan" value="Binan"></el-option>
                                    <el-option label="Canlubang" value="Canlubang"></el-option>
                                    <el-option label="Dasmarinas" value="Dasmarinas"></el-option>
                                    <el-option label="DC Cruz" value="DC Cruz"></el-option>
                                    <el-option label="Granada" value="Granada"></el-option>
                                    <el-option label="Isabela" value="Isabela"></el-option>
                                    <el-option label="Muntinlupa" value="Muntinlupa"></el-option>
                                    <el-option label="Pateros" value="Pateros"></el-option>
                                    <el-option label="Tarlac" value="Tarlac"></el-option>
                                    <el-option label="Valenzuela" value="Valenzuela"></el-option>
                                </el-select>
                            </el-form-item>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-12">
                            <el-form-item class="transform-uppercase" label="AWTA Card Number / Guest Number" prop="referenceNumber" required :error="fieldErrors">
                                <el-input v-model="ruleForm.referenceNumber"></el-input>
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
                    <el-button :loading="isLoading" type="warning" @click="validateDelegate('ruleForm')">Continue</el-button>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="row justify-content-center">
        <div class="col-md-12">
            <el-tabs type="border-card" class="p-0">
                <el-tab-pane label="Ticket">
                    <el-alert
                        class="mb-3"
                        title="Congratulations! You are already booked for the AWTA 2022."
                        type="success"
                        description="Please do screenshot this ticket if your AWTA card is lost, this will be your gate pass to the event place."
                        :closable="false"
                        show-icon>
                    </el-alert>
                    <ticket-component :registration="retrieved.details" :booked_dates="retrieved.booked_dates_plucked" />
                </el-tab-pane>
                <el-tab-pane label="Booking">
                    <el-alert
                        v-if="(retrieved.details.rebooking_limit === 0)"
                        class="mb-3"
                        title="You already reached your rebooking limit. Delegates can only rebook 3x."
                        type="warning"
                        :closable="false">
                    </el-alert>
                    <booking :booked_dates="retrieved.booked_dates" :slots="retrieved.slots" :uuid="retrieved.uuid" :can_book_days="retrieved.can_book_days" :self_redirect="false" :hide_button="retrieved.details.rebooking_limit === 0"/>
                </el-tab-pane>
            </el-tabs>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data () {
      return {
        ruleForm: {
            lastName: '',
            localChurch: '',
            referenceNumber: ''
        },
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
        retrieved: {
            booked_dates: [],
            booked_dates_plucked: [],
            slots: [],
            uuid: null,
            details: {},
            can_book_days: null
        }
      }
    },
    mounted() {
        document.getElementsByClassName('transform-uppercase')[0].getElementsByClassName('el-form-item__content')[0].getElementsByClassName('el-input')[0].getElementsByTagName('input')[0].style = 'text-transform: uppercase !important';
    },
    methods: {
        validateDelegate(formName) {
            this.validated = false;

            this.retrieved = {
                booked_dates: [],
                booked_dates_plucked: [],
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

                    axios.get("/booking/validate", { params: this.ruleForm })
                    .then(async (response) => {
                        loading.close()

                        this.validated = true

                        var data = response.data

                        this.retrieved = {
                            booked_dates: data.bookings,
                            booked_dates_plucked: data.booked_dates,
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
        }
    }
}
</script>

<style>

</style>