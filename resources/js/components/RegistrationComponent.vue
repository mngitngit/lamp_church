<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img width="100%" class="mb-3 rounded shadow" src="/images/registration_banner.jpg">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <banner-component />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <find-data-component @next="nextStep" v-if="step === 1" />

                <el-form v-else :model="ruleForm" :rules="rules" ref="ruleForm" label-width="160px">
                    <el-card shadow="always" class="mb-4">
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
                            <div v-if="ruleForm.registrationType == 'Member' && ruleForm.withAwtaCard != 'none'" class="col-md-6">
                                <el-form-item label="AWTA Card Number" prop="awtaCardNumber" :required="ruleForm.registrationType == 'Member' && ruleForm.withAwtaCard != 'none'">
                                    <el-input v-model="ruleForm.awtaCardNumber" :readonly="ruleForm.registrationType == 'Member' && ruleForm.withAwtaCard != 'none'" :clearable="true"></el-input>
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
                        </div>
                    </el-card> 


                    <el-card v-if="ruleForm.registrationType === 'Member'" shadow="always" class="mb-3                                                                                                                               ">
                        <div class="row">
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

                            <div v-if="ruleForm.registrationType == 'Member' && ruleForm.attendingOption == 'Hybrid'" class="col-md-12">
                                <el-form-item label="Will you book a hotel or any accommodation nearby?" prop="withAccommodation" :required="ruleForm.registrationType === 'Member' && ruleForm.attendingOption === 'Hybrid'">
                                    <el-radio-group v-model="ruleForm.withAccommodation">
                                        <el-radio label="yes">Yes</el-radio>
                                        <el-radio label="none">No</el-radio>
                                    </el-radio-group>
                                </el-form-item>
                            </div>
                        </div>
                    </el-card>

                    <el-card v-if="ruleForm.registrationType == 'Member' && ruleForm.attendingOption == 'Hybrid'" shadow="always" class="mb-3">
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

                    <el-row>
                        <div class="col-md-12">
                            <el-button type="warning" @click="submitForm('ruleForm')">Submit</el-button>
                            <el-link type="primary" class="float-end" @click="resetForm('ruleForm')">Clear Form</el-link>
                        </div>
                    </el-row>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            var checkName = async (rule, value, callback) => {
                var fields = document.querySelectorAll(".check-name");
                for (var i = 0; i < fields.length; i++) {
                    var str = fields[i].classList.remove("is-error")
                }

                const loading = this.$loading({
                            lock: true,
                            text: 'Loading',
                            background: 'rgba(0, 0, 0, 0.7)'
                        });

                await axios.get(`/registration/validate`, {
                    params: {
                        firstName: this.ruleForm.firstName,
                        lastName: this.ruleForm.lastName,
                        localChurch: this.ruleForm.localChurch
                    }
                })
                .then(async (response) => {
                    loading.close()
                }).catch((error) => {
                    loading.close()

                    var fields = document.querySelectorAll(".check-name");
                    for (var i = 0; i < fields.length; i++) {
                        var str = fields[i].classList.add("is-error")
                    }

                    callback(new Error(error.response.data.error))
                });
            };
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
                    priorityDates: []
                },
                rules: {
                    firstName: [
                        { validator: checkName, trigger: ['submit'] },
                        { required: true, message: 'Please input First Name', trigger: ['blur', 'change']}
                    ],
                    lastName: [
                        { required: true, message: 'Please input Last Name', trigger: ['blur', 'change']}
                    ],
                    localChurch: [
                        { required: true, message: 'Please select Local Church', trigger: 'change'}
                    ],
                    country: [
                        { required: true, message: 'Please select Country', trigger: 'change'}
                    ],
                    awtaCardNumber: [
                        { required: true, message: 'Please input AWTA Card Number', trigger: ['blur', 'change']},
                    ],
                    attendingOption: [
                        { required: true, message: 'Please select your attending option', trigger: 'blur'},
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
                step: 1,
                countries: this.$allCountries
            }
        },
        watch: {
            'ruleForm.attendingOption'(data) {
                this.ruleForm.withAccommodation = this.ruleForm.attendingOption === 'Online' ? 'none' : ''
                this.ruleForm.modeOfTranspo = ''
                this.ruleForm.priorityDates = []
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
                            await axios.post("/registration", this.ruleForm)
                            .then(async (response) => {
                                loading.close()
                                
                                this.showTicket(response.data.uuid)

                                this.$refs[formName].resetFields();
                            });
                        }, 1000);
                    } else {
                        return false;
                    }
                });
            },
            showTicket(uuid) {
                window.location.href = `registration/${uuid}`;
            },
            resetForm(formName) {
                this.$confirm('This will remove your answers from all questions, and cannot be undone.', 'Clear form?', {
                    confirmButtonText: 'Clear Form',
                    cancelButtonText: 'Cancel'
                }).then(() => {
                    this.$refs[formName].resetFields();
                    this.step = 1
                });  
            },
            async nextStep(data) {
                this.ruleForm.email = data.email
                this.ruleForm.firstName = data.firstName
                this.ruleForm.lastName = data.lastName
                this.ruleForm.facebookName = data.facebookName
                this.ruleForm.registrationType = data.registrationType
                this.ruleForm.localChurch = data.localChurch
                this.ruleForm.country = data.country
                this.ruleForm.awtaCardNumber = data.awtaCardNumber
                this.ruleForm.category = data.category
                this.ruleForm.attendingOption = data.attendingOption
                this.ruleForm.withAwtaCard = data.withAwtaCard
                this.ruleForm.withAccommodation = data.withAccommodation
                this.ruleForm.modeOfTranspo = data.modeOfTranspo
                this.ruleForm.priorityDates = data.priorityDates
                this.step = 2
            }
        }
    }
</script>
