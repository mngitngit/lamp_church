<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="160px">
                <el-card shadow="always" class="mb-4">
                    <div class="row">
                        <div v-if="data.step_1.withAwtaCard === 'none'" class="col-md-12">
                            <el-form-item label="Email Address" prop="email">
                                <el-input v-model="ruleForm.email"></el-input>
                            </el-form-item>
                        </div>
                        <div v-if="data.step_1.withAwtaCard === 'none'" class="col-md-6">
                            <el-form-item class="check-name" label="First Name" prop="firstName" required>
                                <el-input v-model="ruleForm.firstName"></el-input>
                            </el-form-item>
                        </div>
                        <div v-if="data.step_1.withAwtaCard === 'none' || data.step_1.withAwtaCard === 'lost'" class="col-md-6">
                            <el-form-item class="check-name" label="Last Name" prop="lastName" required>
                                <el-input v-model="ruleForm.lastName"></el-input>
                            </el-form-item>
                        </div>
                        <div v-if="data.step_1.withAwtaCard === 'none'" class="col-md-12">
                            <el-form-item label="Facebook Name" prop="facebookName">
                                <el-input v-model="ruleForm.facebookName" placeholder="If none, kindly type in the Facebook name of your event companion"></el-input>
                            </el-form-item>
                        </div>

                        <div v-if="data.step_1.withAwtaCard === 'none' || data.step_1.withAwtaCard === 'lost'" class="col-md-6">
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
                        <div v-if="data.step_1.withAwtaCard === 'none'" class="col-md-6">
                            <el-form-item label="Country" prop="country" required>
                                <el-select v-model="ruleForm.country" placeholder="Choose">
                                    <el-option v-for="country in countries" v-bind:key="country" :label="country" :value="country"></el-option>
                                </el-select>
                            </el-form-item>
                        </div>
                        <div v-if="data.step_1.withAwtaCard === 'lost' && ruleForm.lookUp.length > 0">
                            <el-form-item label="Please choose your name" prop="selected" required>
                                <el-radio v-for="data in ruleForm.lookUp" :key="data.id" v-model="ruleForm.selected" :label="data.lamp_card_number" border>
                                    <span>{{ data.firstname }} {{ data.lastname }}</span>
                                </el-radio>
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
            data: {
                required: true,
                type: Object
            }
        },
        data() {
            var checkLastname = async (rule, value, callback) => {
                if (this.data.step_1.withAwtaCard === 'lost' && this.ruleForm.lastName != '' && this.ruleForm.localChurch != '') {
                    this.isLoading = true
                    this.tableData = []

                    if (!value) {
                        this.isLoading = false
                        return callback(new Error('Please input your Last Name'));
                    }

                    await axios.get(`/lookup`, {
                        params: {
                            'lastname': this.ruleForm.lastName,
                            'localChurch': this.ruleForm.localChurch
                        }
                    })
                    .then(async (response) => {
                        this.ruleForm.lookUp = response.data
                        this.isLoading = false
                    }).catch((error) => {
                        this.isLoading = false
                        callback(new Error(error.response.data.error))
                    });
                }
            };
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
                    localChurch: '',
                    country: 'Philippines',
                    category: 'Adult',
                    lookUp: [],
                    selected: ''
                },
                rules: {
                    firstName: [
                        { validator: checkName, trigger: ['submit'] },
                        { required: true, message: 'Please input First Name', trigger: ['blur', 'change']}
                    ],
                    lastName: [
                        { required: true, message: 'Please input Last Name', trigger: ['blur', 'change']},
                        { validator: checkLastname, trigger: ['blur'] },
                    ],
                    localChurch: [
                        { required: true, message: 'Please select Local Church', trigger: 'change'},
                        { validator: checkLastname, trigger: ['change'] },
                    ],
                    country: [
                        { required: true, message: 'Please select Country', trigger: 'change'}
                    ],
                    selected: [
                        { required: true, message: 'Please choose your Name', trigger: 'change'}
                    ]
                },
                countries: this.$allCountries
            }
        },
        mounted() {
            if (Object.keys(this.data.step_2).length != 0) {
                this.ruleForm = this.data.step_2;
            }
        },
        methods: {
            submitForm(action) {
                if (action == 'back') {
                    this.$emit('change-step', {destination: 'step_1', current: 'step_2', data: this.ruleForm});
                    return false;
                }

                this.$refs['ruleForm'].validate((valid) => {
                    if (valid) {
                        this.$emit('change-step', {destination: 'step_3', current: 'step_2', data: this.ruleForm});
                        this.$emit('next', this.ruleForm);
                    } else {
                       console.error('error submission on step 2!');
                       return false;
                    }
                });
            },
        }
   }
   </script>