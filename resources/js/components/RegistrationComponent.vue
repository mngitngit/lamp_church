<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img width="100%" class="mb-2" src="/images/banner.png">
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
                    <el-card shadow="hover" class="mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <el-form-item label="Email Address" prop="email" required>
                                    <el-input v-model="ruleForm.email"></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-md-6">
                                <el-form-item label="First Name" prop="firstName" required>
                                    <el-input v-model="ruleForm.firstName"></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-md-6">
                                <el-form-item label="Last Name" prop="lastName" required>
                                    <el-input v-model="ruleForm.lastName"></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-md-12">
                                <el-form-item label="Facebook Name" prop="facebookName" required>
                                    <el-input v-model="ruleForm.facebookName" placeholder="If none, kindly type in the Facebook name of your event companion"></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-md-6">
                                <el-form-item label="Registration type" prop="registrationType" required>
                                    <el-select v-model="ruleForm.registrationType" placeholder="Choose">
                                        <el-option label="Member" value="Member"></el-option>
                                        <el-option label="Guest" value="Guest"></el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div v-if="ruleForm.registrationType == 'Member'" class="col-md-6">
                                <el-form-item label="AWTA Card" prop="awtaCardNumber" :required="ruleForm.registrationType == 'Member'">
                                    <el-input v-model="ruleForm.awtaCardNumber" :readonly="ruleForm.registrationType == 'Member'"></el-input>
                                </el-form-item>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <el-form-item label="Local Church" prop="localChurch" required>
                                    <el-select v-model="ruleForm.localChurch" placeholder="Choose">
                                        <el-option label="Binan" value="Binan"></el-option>
                                        <el-option label="Cadiz" value="Cadiz"></el-option>
                                        <el-option label="Canlubang" value="Canlubang"></el-option>
                                        <el-option label="Dasmarinas" value="Dasmarinas"></el-option>
                                        <el-option label="DC Cruz" value="DC Cruz"></el-option>
                                        <el-option label="Granada" value="Granada"></el-option>
                                        <el-option label="Iloilo" value="Iloilo"></el-option>
                                        <el-option label="Isabela" value="Isabela"></el-option>
                                        <el-option label="Muntinlupa" value="Muntinlupa"></el-option>
                                        <el-option label="Pateros" value="Pateros"></el-option>
                                        <el-option label="Tarlac" value="Tarlac"></el-option>
                                        <el-option label="Valenzuela" value="Valenzuela"></el-option>
                                        <el-option label="Villamar/Maao" value="Villamar/Maao"></el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-md-6">
                                <el-form-item label="Country" prop="country" required>
                                    <el-select v-model="ruleForm.country" placeholder="Choose">
                                        <el-option label="Philippines" value="Philippines"></el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                        </div>
                    </el-card>
                    <el-row>
                        <div class="col-md-12">
                            <el-button type="primary" @click="submitForm('ruleForm')">Submit</el-button>
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
                    category: 'Adult'
                },
                rules: {
                    email: [
                        { required: true, message: 'Please input Email Address', trigger: 'blur'}
                    ],
                    firstName: [
                        { required: true, message: 'Please input First Name', trigger: 'blur'}
                    ],
                    lastName: [
                        { required: true, message: 'Please input Last Name', trigger: 'blur'}
                    ],
                    facebookName: [
                        { required: true, message: 'Please input Facebook Name', trigger: 'blur'}
                    ],
                    registrationType: [
                        { required: true, message: 'Please select Registration Type', trigger: 'change'}
                    ],
                    localChurch: [
                        { required: true, message: 'Please select Local Church', trigger: 'change'}
                    ],
                    country: [
                        { required: true, message: 'Please select Country', trigger: 'change'}
                    ],
                    awtaCardNumber: [
                        { required: true, message: 'Please input AWTA Card Number', trigger: 'blur'},
                    ],
                },
                step: 1
            }
        },
        mounted() {
            
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
                if (data) {
                    this.ruleForm.email = data.email
                    this.ruleForm.firstName = data.firstname
                    this.ruleForm.lastName = data.lastname
                    this.ruleForm.facebookName = data.facebook_name
                    this.ruleForm.registrationType = data.registration_type
                    this.ruleForm.localChurch = data.local_church
                    this.ruleForm.country = data.country
                    this.ruleForm.awtaCardNumber = data.awta_card_number
                    this.ruleForm.category = data.category
                } else {
                    this.ruleForm.email = '',
                    this.ruleForm.firstName = '',
                    this.ruleForm.lastName = '',
                    this.ruleForm.facebookName = '',
                    this.ruleForm.registrationType = 'Guest',
                    this.ruleForm.localChurch = '',
                    this.ruleForm.country = 'Philippines'
                    this.ruleForm.awtaCardNumber = ''
                    this.ruleForm.category = 'Free'
                }

                this.step = 2
            }
        }
    }
</script>
