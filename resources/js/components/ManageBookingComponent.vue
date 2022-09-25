<template>
<div class="w-full">
    <div v-if="! validated" class="row">
        <div class="col-md-5">
            <el-card shadow="hover" class="mb-3 pb-0">
                <p class="c-booking-subheader mb-2">Reminders:</p>
                <p class="c-booking-subheader mb-1"><span class="el-icon-check text-success">&nbsp;&nbsp;</span>Book up to 2 days.</p>
                <p class="c-booking-subheader mb-1"><span class="el-icon-check text-success">&nbsp;&nbsp;</span>Pay minimum of 500 to book.</p>
            </el-card>
        </div>
        <div class="col-md-7">
            <el-card shadow="hover" class="mb-3 pb-0">
                <h3>Manage Booking</h3>
                <p class="mt-2 c-booking-subheader">Type in your details to manage your booking</p>

                <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="160px">
                    <div class="row">
                        <div class="col-md-6">
                            <el-form-item label="First Name" prop="firstName" required :error="fieldErrors">
                                <el-input v-model="ruleForm.firstName"></el-input>
                            </el-form-item>
                        </div>
                        <div class="col-md-6">
                            <el-form-item label="Last Name" prop="lastName" required :error="fieldErrors">
                                <el-input v-model="ruleForm.lastName"></el-input>
                            </el-form-item>
                        </div>
                    </div>
                    <div class="row">
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
                    <div class="row">
                        <div class="col-md-12">
                            <el-form-item label="AWTA Card Number / Guest Number" prop="referenceNumber" required :error="fieldErrors">
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
    <div v-else class="row">
        <booking :booked_dates="retrieved.booked_dates" :slots="retrieved.slots" :uuid="retrieved.uuid" :can_book_days="retrieved.can_book_days"/>
    </div>
</div>
</template>

<script>
export default {
    props: {
        
    },
    data () {
      return {
        ruleForm: {
            firstName: '',
            lastName: '',
            localChurch: '',
            referenceNumber: ''
        },
        rules: {
            firstName: [
                { required: true, message: 'Please input First Name', trigger: ['blur', 'change']}
            ],
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
            slots: [],
            uuid: null,
            details: {},
            can_book_days: null
        }
      }
    },
    methods: {
        validateDelegate(formName) {
            this.validated = false;

            this.retrieved = {
                booked_dates: [],
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