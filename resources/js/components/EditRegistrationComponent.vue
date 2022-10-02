<template>
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="160px">
        <el-card shadow="hover" class="mb-4">
            <div class="row">
                <div class="col-md-12">
                    <el-form-item label="Email Address" prop="email">
                        <el-input v-model="ruleForm.email"></el-input>
                    </el-form-item>
                </div>
                <div class="col-md-6">
                    <el-form-item class="check-name" label="First Name" prop="firstName" required>
                        <el-input v-model="ruleForm.firstName"></el-input>
                    </el-form-item>
                </div>
                <div class="col-md-6">
                    <el-form-item class="check-name" label="Last Name" prop="lastName" required>
                        <el-input v-model="ruleForm.lastName"></el-input>
                    </el-form-item>
                </div>
                <div class="col-md-12">
                    <el-form-item label="Facebook Name" prop="facebookName">
                        <el-input v-model="ruleForm.facebookName" placeholder="If none, kindly type in the Facebook name of your event companion"></el-input>
                    </el-form-item>
                </div>

                <div class="col-md-6">
                    <el-form-item label="Local Church" prop="localChurch" required>
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
                <div class="col-md-6">
                    <el-form-item label="Country" prop="country" required>
                        <el-select v-model="ruleForm.country" placeholder="Choose">
                            <el-option v-for="country in countries" v-bind:key="country" :label="country" :value="country"></el-option>
                        </el-select>
                    </el-form-item>
                </div>
                <div class="col-md-6">
                    <el-form-item label="Rate Category" prop="category" required>
                        <el-select v-model="ruleForm.category" placeholder="Choose">
                            <el-option label="Adult" value="Adult"></el-option>
                            <el-option label="Kids" value="Kids"></el-option>
                            <el-option label="Free" value="Free"></el-option>
                        </el-select>
                    </el-form-item>
                </div>
            </div>
        </el-card> 

        <el-card v-if="ruleForm.registrationType === 'Member'" shadow="hover" class="mb-3">
            <div class="row">
                <div v-if="ruleForm.registrationType === 'Member'" class="col-md-6">
                    <el-form-item label="Do you have an awta card?" prop="withAwtaCard" required>
                        <el-select v-model="ruleForm.withAwtaCard" placeholder="Choose">
                            <el-option label="None, I’m a new member." value="none"></el-option>
                            <el-option label="Yes, but I lost it." value="lost"></el-option>
                            <el-option label="Yes, and I still have it." value="yes"></el-option>
                        </el-select>
                    </el-form-item>
                </div>

                <div v-if="ruleForm.registrationType == 'Member'" class="col-md-6">
                    <el-form-item label="How will you attend the AWTA?" prop="attendingOption" :required="ruleForm.registrationType === 'Member'">
                        <el-select v-model="ruleForm.attendingOption" placeholder="Choose">
                            <el-option value="Hybrid" label="Hybrid"></el-option>
                            <el-option value="Online" label="Online"></el-option>
                        </el-select>
                    </el-form-item>
                </div>

                <div v-if="ruleForm.registrationType == 'Member' && ruleForm.attendingOption == 'Hybrid'" class="col-md-6">
                    <el-form-item label="What is your primary mode of transportation?" prop="modeOfTranspo" :required="ruleForm.registrationType === 'Member' && ruleForm.attendingOption === 'Hybrid'">
                        <el-select v-model="ruleForm.modeOfTranspo" placeholder="Choose">
                            <el-option value="Private Vehicle" label="Private Vehicle"></el-option>
                            <el-option value="Carpool" label="Carpool"></el-option>
                            <el-option value="Public Transportation" label="Public Transportation"></el-option>
                        </el-select>
                    </el-form-item>
                </div>

                <div v-if="ruleForm.registrationType == 'Member' && ruleForm.attendingOption == 'Hybrid'" class="col-md-6">
                    <el-form-item label="Will you book a hotel or any accommodation nearby?" prop="withAccommodation" :required="ruleForm.registrationType === 'Member' && ruleForm.attendingOption === 'Hybrid'">
                        <el-radio-group v-model="ruleForm.withAccommodation">
                            <el-radio label="yes">Yes</el-radio>
                            <el-radio label="none">No</el-radio>
                        </el-radio-group>
                    </el-form-item>
                </div>
            </div>
        </el-card>

        <el-card v-if="ruleForm.registrationType == 'Member' && ruleForm.attendingOption == 'Hybrid'" shadow="hover" class="mb-3">
            <div class="col-md-12">
                <el-form-item label="In case optimization or scheduling is needed due to limited seating capacity, What day/s are you most likely to attend? (Choose all that apply)" prop="priorityDates" :required="ruleForm.registrationType === 'Member' && ruleForm.attendingOption === 'Hybrid'">
                    <el-checkbox-group v-model="ruleForm.priorityDates">
                    <el-checkbox label="December 27" name="priorityDates"></el-checkbox>
                    <el-checkbox label="December 28" name="priorityDates"></el-checkbox>
                    <el-checkbox label="December 29" name="priorityDates"></el-checkbox>
                    <el-checkbox label="December 30" name="priorityDates"></el-checkbox>
                    </el-checkbox-group>
                </el-form-item>
            </div>
        </el-card>

        <el-card v-if="ruleForm.attendingOption == 'Hybrid' && permissions.can_edit_delegate_config" shadow="hover" class="mb-3">
            <div class="row">
                <div class="col-md-5">
                    <el-form-item label="Turn on if delegate is allowed to book" required>
                        <el-switch
                            @change="warnUser()"
                            style="display: block"
                            v-model="ruleForm.canBook"
                            active-color="#13ce66"
                            active-text="can book"
                            inactive-text="">
                        </el-switch>
                    </el-form-item>
                </div>
                <div class="col-md-2">
                    <el-form-item label="Days can book" required>
                        <el-input v-model="ruleForm.canBookDays"></el-input>
                    </el-form-item>
                </div>
                <div class="col-md-2">
                    <el-form-item label="Rebooking Limit" required>
                        <el-input v-model="ruleForm.rebookingLimit"></el-input>
                    </el-form-item>
                </div>
                <div class="col-md-2">
                    <el-form-item label="Booking Rate" required>
                        <el-input v-model="ruleForm.bookingRate"></el-input>
                    </el-form-item>
                </div>
            </div>
        </el-card>

        <el-row>
            <div class="col-md-12">
                <el-button type="warning" @click="submitForm('ruleForm')">Update</el-button>
                <el-link type="primary" class="float-end" @click="viewPayments()">View Payments</el-link>
            </div>
        </el-row>
    </el-form>
</template>

<script>
export default {
    props: {
        registration: {
            required: true,
            type: Object
        },
    },
    data() {
        return {
            ruleForm: {
                email: '',
                firstName: '',
                lastName: '',
                facebookName: '',
                registrationType: 'Member',
                localChurch: '',
                country: 'Philippines',
                awtaCardNumber: '',
                category: 'Adult',
                attendingOption: '',
                withAwtaCard: '',
                withAccommodation: '',
                modeOfTranspo: '',
                priorityDates: [],
                canBookDays: 0,
                rebookingLimit: 0,
                category: '',
                canBook: false,
                bookingRate: 0
            },
            rules: {
                firstName: [
                    { required: true, message: 'Please input First Name', trigger: ['blur', 'change']}
                ],
                lastName: [
                    { required: true, message: 'Please input Last Name', trigger: ['blur', 'change']}
                ],
                localChurch: [
                    { required: true, message: 'Please select Local Church', trigger: ['blur', 'change']}
                ],
                country: [
                    { required: true, message: 'Please select Country', trigger: ['blur', 'change']}
                ],
                awtaCardNumber: [
                    { required: true, message: 'Please input AWTA Card Number', trigger: ['blur', 'change']},
                ],
                attendingOption: [
                    { required: true, message: 'Please select your attending option', trigger: ['blur', 'change']},
                ],
                withAccommodation: [
                    {required: true, message: 'Please select an answer', trigger: ['blur', 'change']}
                ],
                modeOfTranspo: [
                    {required: true, message: 'Please select your mode of transportation', trigger: ['blur', 'change']}
                ],
                priorityDates: [
                    {required: true, message: 'Please select atleast one day', trigger: 'change'}
                ],
            },
            countries: this.$allCountries,
            permissions: window.auth_user.permissions
        }
    },
    watch: {
        'ruleForm.attendingOption'(newData, oldData) {
            if (oldData != newData && oldData != '' && newData != '') {
                this.ruleForm.withAccommodation = this.ruleForm.attendingOption === 'Online' ? 'none' : ''
                this.ruleForm.modeOfTranspo = ''
                this.ruleForm.priorityDates = []
            }
        },
        'ruleForm.withAwtaCard'(newData, oldData) {
            if (oldData != newData && oldData != '' && newData != '') {
                this.ruleForm.attendingOption =''
                this.ruleForm.withAccommodation =''
                this.ruleForm.modeOfTranspo =''
                this.ruleForm.priorityDates =[]
            }
        }
    },
    mounted() {
        this.ruleForm = {
                email: this.registration.email,
                firstName: this.registration.firstname,
                lastName: this.registration.lastname,
                facebookName: this.registration.facebook_name,
                registrationType: this.registration.registration_type,
                localChurch: this.registration.local_church,
                country: this.registration.country,
                category: this.registration.category,
                attendingOption: this.registration.attending_option,
                withAwtaCard: this.registration.with_awta_card,
                withAccommodation: this.registration.with_accommodation,
                modeOfTranspo: this.registration.mode_of_transpo,
                priorityDates: JSON.parse(this.registration.priority_dates),
                category: this.registration.category,
                canBook: this.registration.can_book === 1,
                canBookDays: this.registration.can_book_days,
                rebookingLimit: this.registration.rebooking_limit,
                bookingRate: this.registration.can_book_rate
            }
    },
    methods: {
        submitForm(formName) {
            this.$refs[formName].validate(async (valid) => {
                if (valid) {
                    const loading = this.$loading({
                        lock: true,
                        text: 'Loading',
                        background: 'rgba(0, 0, 0, 0.7)'
                    });

                    setTimeout(async () => {
                        await axios.post(`/registration/${this.registration.uuid}/update`, this.ruleForm)
                        .then(async (response) => {
                            loading.close()

                            this.$alert('', 'Details Successfully Updated!', {
                                confirmButtonText: 'OK',
                                showCancelButton: false,
                                closeOnPressEscape: false,
                                closeOnClickModal: false,
                                showClose: false,
                                center: true,
                                type: 'success',
                                callback: action => {
                                    window.location.reload();
                                }
                            });
                        });
                    }, 1000);
                } else {
                    return false;
                }
            });
        },
        viewPayments() {
          window.location.href = `/payments/${this.registration.uuid}/create`;
        },
        warnUser() {
            if (! this.ruleForm.canBook) {
                this.$notify({
                    title: 'Warning',
                    type: 'warning',
                    message: 'Turning off the `allowed to book` will lose all the booked dates of the delegate.',
                    duration: 0
                });
            }
        }
    }
}
</script>

<style>

</style>