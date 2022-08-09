<template>
    <el-row :gutter="12">
        <!-- <el-col :span="14" :offset="5">
            <img height="203" class="mb-2" src="/images/banner.png">
        </el-col> -->
        <el-col :span="!isMobile() ? 12 : 24" :offset="!isMobile() ? 6 : 0">
            <el-card shadow="hover" class="mb-3 pb-0">
                <h2>LAMP WORLDWIDE AWTA 2022</h2>
                <p>
                    BE BLESSED PHYSICALLY, MATERIALLY & SPIRITUALLY <br/>
                    Event Timing: DECEMBER 27-30, 2022 <br/>
                    Event Place: Calamba Tent <br/>
                </p>

                <p>
                    Chosen people of God in the old testament gather for a so-called solemn assembly (Leviticus 23:36, Joel 1:14) where "offering made by fire unto the Lord" are given to celebrate God. But with Christ's death as ultimate sacrifice for all, today, animal sacrifices are no longer offered. Yet true worshipers of God continue to offer & make fire in the form of praise, worship & thanksgiving. <br/><br/>

                    Annually, LAMP Church gathers & invites every one to congregate for one purpose -- offer worship & thanksgiving to the Lord of lords!
                </p>
            </el-card>
        </el-col>
        <el-col :span="!isMobile() ? 12 : 24" :offset="!isMobile() ? 6 : 0">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="160px">
                <el-card shadow="hover" class="mb-4 pt-3">
                    <el-row :gutter="20">
                        <el-col :span="24">
                            <el-form-item label="Email Address" prop="email" required>
                                <el-input v-model="ruleForm.email"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item label="First Name" prop="firstName" required>
                                <el-input v-model="ruleForm.firstName"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item label="Last Name" prop="lastName" required>
                                <el-input v-model="ruleForm.lastName"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="24">
                            <el-form-item label="Facebook Name" prop="facebookName" required>
                                <el-input v-model="ruleForm.facebookName" placeholder="If none, kindly type in the Facebook name of your event companion"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="12">
                            <el-form-item label="Registration type" prop="registrationType" required>
                                <el-select v-model="ruleForm.registrationType" placeholder="please select">
                                    <el-option label="Member" value="Member"></el-option>
                                    <el-option label="Guest" value="Guest"></el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
                    <el-row :gutter="20">
                        <el-col :span="12">
                            <el-form-item label="Local Church" prop="localChurch" required>
                                <el-select v-model="ruleForm.localChurch" placeholder="please select">
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
                        </el-col>
                        <el-col :span="12">
                            <el-form-item label="Country" prop="country" required>
                                <el-select v-model="ruleForm.country" placeholder="please select">
                                    <el-option label="Philippines" value="Philippines"></el-option>
                                </el-select>
                            </el-form-item>
                        </el-col>
                    </el-row>
                </el-card>
                <el-row>
                    <el-col :span="24">
                        <el-button type="primary" @click="submitForm('ruleForm')">Submit</el-button>
                        <el-link type="primary" class="float-end" @click="resetForm('ruleForm')">Clear Form</el-link>
                    </el-col>
                </el-row>
            </el-form>
        </el-col>
    </el-row>
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
                    country: 'Philippines'
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
                    ]
                },
                fullscreenLoading: false,
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
                            spinner: 'el-icon-loading',
                            background: 'rgba(0, 0, 0, 0.7)'
                        });

                        this.fullscreenLoading = true

                        await axios.post("/registration", this.ruleForm)
                        .then(async (response) => {
                            loading.close()
                            this.showTicket(response.data.uuid)
                            this.fullscreenLoading = false
                            this.resetForm('ruleForm')
                        });
                    } else {
                        return false;
                    }
                });
            },
            showTicket(uuid) {
                window.location.href = `registration/${uuid}`;
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            isMobile() {
                if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    return true
                } else {
                    return false
                }
            }
        }
    }
</script>

<style scoped>

</style>
