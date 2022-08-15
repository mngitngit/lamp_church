<template>
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="160px">
        <el-card shadow="hover" class="mb-4 pt-3">
            <div class="row">
                <div class="col-md-6">
                    <el-form-item label="Are you a guest or a member?" prop="registrationType" required>
                        <el-select v-model="ruleForm.registrationType" placeholder="Choose">
                            <el-option label="Member" value="Member"></el-option>
                            <el-option label="Guest" value="Guest"></el-option>
                        </el-select>
                    </el-form-item>
                </div>
                <div v-if="ruleForm.registrationType === 'Member'" class="col-md-6">
                    <el-form-item label="Please enter your AWTA Card Number" prop="awtaCardNumber" :required="ruleForm.registrationType === 'Member'">
                        <el-input v-model="ruleForm.awtaCardNumber"></el-input>
                    </el-form-item>
                </div>
            </div>
        </el-card>
        <div class="row">
            <div class="col-md-12">
                <el-button :loading="isLoading" type="primary" @click="getDelegateData('ruleForm')">Next</el-button>
            </div>
        </div>
    </el-form>
</template>

<script>
export default {
    data() {
        var checkAwtaCardNumber = (rule, value, callback) => {
            if (!value) {
                return callback(new Error('Please input your AWTA Card Number'));
            }

            this.isLoading = true

            setTimeout(async () => {
                await axios.get(`/lookup/${this.ruleForm.awtaCardNumber}`)
                    .then(async (response) => {
                        this.isLoading = false
                        this.$emit('next', response.data);
                        this.resetForm('ruleForm')

                        callback();
                    }).catch((error) => {
                        this.isLoading = false
                        callback(new Error(error.response.data.error))
                    });
            }, 1000);
        };
        return {
            ruleForm: {
                registrationType: '',
                awtaCardNumber: ''
            },
            rules: {
                registrationType: [
                    { required: true, message: 'Please select Registration Type', trigger: 'change'}
                ],
                awtaCardNumber: [
                    { validator: checkAwtaCardNumber, trigger: 'blur' }
                ],
            },
            isLoading: false
        }
    },
    methods: {
        getDelegateData(formName) {
            this.$refs[formName].validate(async (valid) => {
                if (valid) {    
                    if (this.ruleForm.registrationType === 'Guest')
                        this.$emit('next', null);              
                } else {
                    return false;
                }
            });
        },
        resetForm(formName) {
            this.$refs[formName].resetFields();
        }
    }
}
</script>