<template>
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="160px">
        <el-card shadow="hover" class="mb-3                                                                                                                               ">
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

        <el-card v-if="(ruleForm.withAwtaCard === 'yes' || ruleForm.withAwtaCard === 'lost') && ruleForm.registrationType === 'Member'" shadow="hover" class="mb-3                                                                                                                               ">
            <div class="row">
                <div v-if="ruleForm.registrationType == 'Member'" class="col-md-6">
                    <el-form-item label="How will you attend the AWTA?" prop="attendingOption" :required="(ruleForm.withAwtaCard === 'yes' || ruleForm.withAwtaCard === 'lost') && ruleForm.registrationType === 'Member'">
                        <el-select v-model="ruleForm.attendingOption" placeholder="Choose">
                            <el-option value="Hybrid" label="Hybrid"></el-option>
                            <el-option value="Online" label="Online"></el-option>
                        </el-select>
                    </el-form-item>
                </div>

                <div v-if="ruleForm.registrationType == 'Member' && ruleForm.attendingOption == 'Hybrid'" class="col-md-6">
                    <el-form-item label="What is your primary mode of transportation?" prop="modeOfTranspo" :required="(ruleForm.withAwtaCard === 'yes' || ruleForm.withAwtaCard === 'lost') && ruleForm.registrationType === 'Member' && ruleForm.attendingOption === 'Hybrid'">
                        <el-select v-model="ruleForm.modeOfTranspo" placeholder="Choose">
                            <el-option value="Private Vehicle" label="Private Vehicle"></el-option>
                            <el-option value="Carpool" label="Carpool"></el-option>
                            <el-option value="Public Transportation" label="Public Transportation"></el-option>
                        </el-select>
                    </el-form-item>
                </div>

                <div v-if="ruleForm.registrationType == 'Member' && ruleForm.attendingOption == 'Hybrid'" class="col-md-12">
                    <el-form-item label="Will you book a hotel or any accommodation nearby?" prop="withAccommodation" :required="(ruleForm.withAwtaCard === 'yes' || ruleForm.withAwtaCard === 'lost') && ruleForm.registrationType === 'Member' && ruleForm.attendingOption === 'Hybrid'">
                        <el-radio-group v-model="ruleForm.withAccommodation">
                            <el-radio label="yes">Yes</el-radio>
                            <el-radio label="none">No</el-radio>
                        </el-radio-group>
                    </el-form-item>
                </div>
            </div>
        </el-card>

        <el-card v-if="ruleForm.registrationType == 'Member' && ruleForm.attendingOption == 'Hybrid'" shadow="hover" class="mb-3                                                                                                                               ">
            <div class="col-md-12">
                <el-form-item label="In case optimization or scheduling is needed due to limited seating capacity, What day/s are you most likely to attend? (Choose all that apply)" prop="priorityDates" :required="(ruleForm.withAwtaCard === 'yes' || ruleForm.withAwtaCard === 'lost') && ruleForm.registrationType === 'Member' && ruleForm.attendingOption === 'Hybrid'">
                    <el-checkbox-group v-model="ruleForm.priorityDates">
                    <el-checkbox label="December 27" name="priorityDates"></el-checkbox>
                    <el-checkbox label="December 28" name="priorityDates"></el-checkbox>
                    <el-checkbox label="December 29" name="priorityDates"></el-checkbox>
                    <el-checkbox label="December 30" name="priorityDates"></el-checkbox>
                    </el-checkbox-group>
                </el-form-item>
            </div>
        </el-card>

        <el-card v-if="ruleForm.withAwtaCard === 'yes' && ruleForm.registrationType === 'Member'" shadow="hover" class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <el-form-item class="transform-uppercase" label="What is your AWTA card number?" prop="awtaCardNumber" :required="ruleForm.withAwtaCard === 'yes' && ruleForm.registrationType === 'Member'">
                        <el-input v-model="ruleForm.awtaCardNumber" :clearable="true"></el-input>
                    </el-form-item>
                </div>
            </div>
        </el-card>

        <el-card v-if="ruleForm.withAwtaCard === 'lost' && ruleForm.registrationType === 'Member'" shadow="hover" class="mb-3">
            <div class="row">
                <!-- Please enter your Last Name -->
                <div class="col-md-6">
                    <el-form-item label="What is your last name?" prop="lastname" :required="ruleForm.withAwtaCard === 'lost' && ruleForm.registrationType === 'Member'">
                        <el-input v-model="ruleForm.lastname" :clearable="true"></el-input>
                    </el-form-item>
                </div>

                <!-- Local Church -->
                <div class="col-md-6">
                    <el-form-item label="From which local church are you?" prop="localChurch" :required="ruleForm.withAwtaCard === 'lost' && ruleForm.registrationType === 'Member'">
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
        </el-card>

        <el-card shadow="hover" v-if="tableData.length > 0 && ruleForm.registrationType === 'Member' " class="mb-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="el-form-item is-success is-required mb-0">
                        <label for="lastname" class="el-form-item__label" style="width: 160px;">Select your name below</label>
                    </div>
                    <el-table
                    :data="tableData"
                    border
                    @row-click="handleRowClick"
                    style="width: 100%">
                        <el-table-column
                            prop="lastname"
                            label="Name">
                            <template slot-scope="scope">
                                {{ scope.row.firstname }} {{ scope.row.lastname }}
                            </template>
                        </el-table-column>
                        <el-table-column
                            prop="local_church"
                            label="Local Church"
                            width="120">
                        </el-table-column>
                    </el-table>
                </div>
            </div>
        </el-card>
        <div class="row">
            <div class="col-md-12">
                <el-button :loading="isLoading" type="warning" @click="getDelegateData('ruleForm')">Next</el-button>
            </div>
        </div>
    </el-form>
</template>

<script>
export default {
    data() {
        var checkAwtaCardNumber = async (rule, value, callback) => {
            if (!value && this.ruleForm.withAwtaCard === 'yes') {
                return callback(new Error('Please input your AWTA Card Number'));
            }

            this.resetData()
            this.isLoading = true

            await axios.get(`/lookup/${this.ruleForm.awtaCardNumber}`)
                .then(async (response) => {
                    this.data.email = response.data.email
                    this.data.firstName = response.data.firstname
                    this.data.lastName = response.data.lastname
                    this.data.facebookName = response.data.facebook_name
                    this.data.registrationType = response.data.registration_type
                    this.data.localChurch = response.data.local_church
                    this.data.country = response.data.country
                    this.data.awtaCardNumber = response.data.awta_card_number
                    this.data.category = response.data.category
                    this.data.attendingOption = this.ruleForm.attendingOption
                    this.data.withAccommodation = this.ruleForm.withAccommodation
                    this.data.modeOfTranspo = this.ruleForm.modeOfTranspo
                    this.data.priorityDates = this.ruleForm.priorityDates
                    this.data.withAwtaCard = 'yes'
                    this.isLoading = false
                    callback();
                }).catch((error) => {
                    this.isLoading = false
                    callback(new Error(error.response.data.error))
                });
        };
        var checkLastname = async (rule, value, callback) => {
            this.isLoading = true
            this.tableData = []

            if (!value) {
                this.isLoading = false
                return callback(new Error('Please input your Last Name'));
            }

            await axios.get(`/lookup`, {
                params: this.ruleForm
            })
            .then(async (response) => {
                this.tableData = response.data
                this.isLoading = false
            }).catch((error) => {
                this.isLoading = false
                callback(new Error(error.response.data.error))
            });
        };
        return {
            tableData: [],
            ruleForm: {
                registrationType: 'Member',
                withAwtaCard: '',
                lastname: '',
                localChurch: '',
                attendingOption: '',
                withAccommodation: '',
                modeOfTranspo: '',
                priorityDates: []
            },
            rules: {
                registrationType: [
                    { required: true, message: 'Please select Registration Type', trigger: ['blur', 'change']}
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
                withAwtaCard: [
                    { required: true, message: 'Please select an answer', trigger: ['blur', 'change']}
                ],
                lastname: [
                    { validator: checkLastname, trigger: ['submit'] },
                    { required: true, message: 'Please input your Last Name', trigger: ['blur', 'change']}
                ],
                localChurch: [
                    { required: true, message: 'Please select your Local Church', trigger: ['blur', 'change']}
                ],
                attendingOption: [
                    { required: true, message: 'Please select your attending option', trigger: ['blur', 'change']},
                ],
                awtaCardNumber: [
                    { validator: checkAwtaCardNumber, trigger: ['submit'] },
                    { required: true, message: 'Please input your AWTA Card Number', trigger: ['blur', 'change']}
                ]
            },
            data: {
                email: '',
                firstName: '',
                lastName: '',
                facebookName: '',
                registrationType: '',
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
            isLoading: false
        }
    },
    watch: {
        ruleForm: {
            handler: function(newValue) {
                this.rules.lastname[0].required = this.ruleForm.withAwtaCard === 'lost'
                this.rules.localChurch[0].required = this.ruleForm.withAwtaCard === 'lost'
                this.tableData = []

                if (this.ruleForm.withAwtaCard === 'yes') {
                    setTimeout(() => {
                        document.getElementsByClassName('transform-uppercase')[0].getElementsByClassName('el-form-item__content')[0].getElementsByClassName('el-input')[0].getElementsByTagName('input')[0].style = 'text-transform: uppercase !important'
                    }, 500);
                }
            },
            deep: true
        },
        'ruleForm.attendingOption'(data) {
            this.ruleForm.withAccommodation = this.ruleForm.attendingOption === 'Online' ? 'none' : ''
            this.ruleForm.modeOfTranspo = ''
            this.ruleForm.priorityDates = []
        },
        'ruleForm.withAwtaCard'(data) {
            this.ruleForm.lastname =''
            this.ruleForm.localChurch =''
            this.ruleForm.attendingOption =''
            this.ruleForm.withAccommodation =''
            this.ruleForm.modeOfTranspo =''
            this.ruleForm.priorityDates =[]
        }
    },
    mounted() {},
    methods: {
        getDelegateData(formName) {
            this.$refs[formName].validate(async (valid) => {
                if (valid) { 
                    if (this.ruleForm.registrationType === 'Member' && this.ruleForm.withAwtaCard === 'yes') {
                        this.$confirm(`Please click continue if you are ${this.data.firstName} ${this.data.lastName}.`, 'Warning', {
                            confirmButtonText: 'Continue',
                            cancelButtonText: 'Cancel',
                            type: 'warning'
                        }).then(() => {
                            this.submitForm()
                        })
                    }
                    else if (this.ruleForm.registrationType === 'Member' && this.ruleForm.withAwtaCard === 'lost') {}
                    else if (this.ruleForm.registrationType === 'Member' && this.ruleForm.withAwtaCard === 'none') {
                        this.data.withAwtaCard = 'none'
                        this.data.registrationType = 'Member'
                        this.data.category = 'Adult'
                        this.data.attendingOption = this.ruleForm.attendingOption
                        this.data.withAccommodation = 'none'
                        this.data.modeOfTranspo = this.ruleForm.modeOfTranspo
                        this.data.priorityDates = this.ruleForm.priorityDates

                        this.$emit('next', this.data);  
                    }
                    else if (this.ruleForm.registrationType === 'Guest') {
                        this.data.registrationType = 'Guest'
                        this.data.category = 'Free'
                        this.data.attendingOption = 'Online'
                        this.data.withAccommodation = 'none'
                        this.data.withAwtaCard = 'none'

                        this.$emit('next', this.data);  
                    }            
                } else {
                    return false;
                }
            });
        },
        resetForm(formName) {
            this.$refs[formName].resetFields();
        },
        resetData() {
            this.data.email = ''
            this.data.firstName = ''
            this.data.lastName = ''
            this.data.facebookName = ''
            this.data.registrationType = 'Member'
            this.data.localChurch = ''
            this.data.country = 'Philippines'
            this.data.awtaCardNumber = ''
            this.data.category = 'Adult'
            this.data.attendingOption = ''
            this.data.withAwtaCard = ''
            this.data.withAccommodation = 'none'
            this.data.modeOfTranspo = ''
            this.data.priorityDates = []
        },
        async handleRowClick(val) {
            if (!val.is_registered) {
                this.$confirm(`Are you sure you are ${val.firstname} ${val.lastname}?`, 'Warning', {
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {
                    this.data.email = val.email
                    this.data.firstName = val.firstname
                    this.data.lastName = val.lastname
                    this.data.facebookName = val.facebook_name
                    this.data.registrationType = val.registration_type
                    this.data.localChurch = val.local_church
                    this.data.country = val.country
                    this.data.awtaCardNumber = val.awta_card_number
                    this.data.category = val.category
                    this.data.attendingOption = this.ruleForm.attendingOption
                    this.data.withAwtaCard = 'lost'
                    this.data.withAccommodation = this.ruleForm.withAccommodation
                    this.data.modeOfTranspo = this.ruleForm.modeOfTranspo
                    this.data.priorityDates = this.ruleForm.priorityDates
                    
                    this.submitForm()
                })
            } else {
                this.$message.error(`Oops, ${val.firstname} ${val.lastname} is already registered.`);
            }
        },
        submitForm() {
            console.log(this.data)
            const loading = this.$loading({
                lock: true,
                text: 'Loading',
                background: 'rgba(0, 0, 0, 0.7)'
            });

            axios.post("/registration", this.data)
            .then(async (response) => {
                loading.close()
                
                this.showTicket(response.data.uuid)

                this.$refs['ruleForm'].resetFields();
            });
        },
        showTicket(uuid) {
            window.location.href = `registration/${uuid}`;
        },
    }
}
</script>

<style scoped>
.el-table tr {
    cursor: pointer;
}

.el-input--suffix .el-input__inner{
    text-transform: uppercase !important;
}
</style>