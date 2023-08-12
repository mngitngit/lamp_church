<template>
 <div class="row justify-content-center">
    <div class="col-md-12">
        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="120px" class="demo-ruleForm">
            <el-card shadow="always" class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <el-form-item label="Are you a guest or a member?" prop="registrationType" required>
                            <el-select v-model="ruleForm.registrationType" placeholder="Choose">
                                <el-option label="Member" value="Member" :disabled="closeRegForMember"></el-option>
                                <el-option label="Guest" value="Guest"></el-option>
                            </el-select>
                        </el-form-item>
                    </div>
                    <div v-if="ruleForm.registrationType === 'Member'" class="col-md-6">
                        <el-form-item label="Do you have an awta card?" prop="withAwtaCard" required>
                            <el-select v-model="ruleForm.withAwtaCard" placeholder="Choose">
                                <el-option label="None, I’m a new member." value="none"></el-option>
                                <el-option label="Yes, but I lost it." value="lost"></el-option>
                                <el-option label="Yes, and I still have it." value="yes"></el-option>
                            </el-select>
                        </el-form-item>
                    </div>
                </div>
            </el-card>

            <el-card v-if="ruleForm.registrationType != ''" shadow="always" class="mb-3">
                <div class="px-2 row">
                    <el-alert
                        title="All registration after November 30, 2023 is considered online. For further inquiries, please reach out to your Local Church's Coordinators."
                        type="warning"
                        show-icon>
                    </el-alert>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <el-form-item label="How will you attend the AWTA?" prop="attendingOption" required>
                            <el-select v-model="ruleForm.attendingOption" placeholder="Choose">
                                <el-option value="Hybrid" label="Hybrid"></el-option>
                                <el-option value="Online" label="Online"></el-option>
                            </el-select>
                        </el-form-item>
                    </div>
                </div>
            </el-card>

            <el-card v-if="ruleForm.registrationType === 'Member' && ruleForm.withAwtaCard === 'yes'" shadow="always" class="mb-3">    
                <div class="row">
                    <div class="col-md-6" v-if="ruleForm.withAwtaCard === 'yes'">
                        <el-form-item class="transform-uppercase" label="What is your AWTA card number?" prop="awtaCardNumber" :required="ruleForm.withAwtaCard === 'yes'">
                            <el-input v-model="ruleForm.awtaCardNumber" :clearable="true"></el-input>
                        </el-form-item>
                    </div>
                </div>
            </el-card>
        </el-form>
    </div>
</div>
</template>

<script>
export default {
    props: {
        closeRegForMember: {
            required: true,
            type: Boolean
        },
        data: {
            required: true,
            type: Object
        }
    },
    data() {
        var checkAwtaCardNumber = async (rule, value, callback) => {
            if (!value && this.ruleForm.withAwtaCard === 'yes') {
                return callback(new Error('Please input your AWTA Card Number'));
            }

            this.resetData('all');
            this.isLoading = true

            await axios.get(`/lookup/${this.ruleForm.awtaCardNumber}`)
                .then(async (response) => {
                        this.ruleForm.found.email = response.data.email
                        this.ruleForm.found.firstName = response.data.firstname
                        this.ruleForm.found.lastName = response.data.lastname
                        this.ruleForm.found.facebookName = response.data.facebook_name
                        this.ruleForm.found.registrationType = response.data.registration_type
                        this.ruleForm.found.country = response.data.country
                        this.ruleForm.found.awtaCardNumber = response.data.lamp_card_number
                        this.ruleForm.found.category = response.data.category
                        this.ruleForm.found.attendingOption = this.ruleForm.attendingOption
                        this.ruleForm.found.withAwtaCard = 'yes'
                        this.ruleForm.found.localChurch = response.data.local_church
                        this.isLoading = false
                        callback();
                }).catch((error) => {
                    this.isLoading = false
                    callback(new Error(error.response.data.error))
                });
        };
        return {
            ruleForm: {
                registrationType: '',
                withAwtaCard: '',
                attendingOption: '',
                awtaCardNumber: '',
                found: {}
            },
            rules: {
                registrationType: [
                    { required: true, message: 'Please select Registration Type', trigger: ['blur', 'change']}
                ],
                withAwtaCard: [
                    { required: true, message: 'Please select an answer', trigger: ['blur', 'change']}
                ],
                attendingOption: [
                    { required: true, message: 'Please select your attending option', trigger: ['blur', 'change']},
                ],
                awtaCardNumber: [
                    { validator: checkAwtaCardNumber, trigger: ['submit'] },
                    { required: true, message: 'Please input your AWTA Card Number', trigger: ['blur', 'change']}
                ],
            }
        }
    },
    watch: {
        'ruleForm.registrationType'(data, old) {
            if (old) this.resetData('reg-type')
        },
        'ruleForm.withAwtaCard'(data, old) {
            if (old) this.resetData('with-awta-card')
        },
        'ruleForm.attendingOption'(data, old) {
            if (old) this.resetData('all')
        }
    },
    mounted() {
        if (Object.keys(this.data.step_1).length != 0) {
            this.ruleForm = this.data.step_1;
        }
    },
    methods: {
        submitForm(action) {
            this.$refs['ruleForm'].validate((valid) => {
                if (valid) {
                    if (this.ruleForm.withAwtaCard === 'yes') {
                        this.$confirm(`Are you sure you are ${this.ruleForm.found.firstName} ${this.ruleForm.found.lastName}?`, 'Warning', {
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                            type: 'warning'
                        }).then(async () => {
                            this.$emit('change-step', {destination: 'step_3', current: 'step_1', data: this.ruleForm});
                        }).catch(() => {
                            return callback(new Error('Please input your correct AWTA Card Number'));
                        });
                    } else {
                        this.$emit('change-step', {destination: 'step_2', current: 'step_1', data: this.ruleForm});
                    }
                } else {
                    console.error('error submission on step 1!');
                    return false;
                }
            });
        },
        resetData(scope) {
            if (scope === 'all') {
                this.$emit('reset');
                this.ruleForm.found = {}
            } else if (scope === 'reg-type') {
                this.ruleForm.withAwtaCard = ''
                this.ruleForm.attendingOption = ''
                this.ruleForm.awtaCardNumber = ''
                this.ruleForm.found = {}
                this.$emit('reset');
            } else if (scope === 'with-awta-card') {
                this.ruleForm.awtaCardNumber = ''
                this.ruleForm.found = {}
                this.$emit('reset');
            }
        },
    }
}
</script>

<style scoped>
.el-input--suffix .el-input__inner{
    text-transform: uppercase !important;
}
</style>