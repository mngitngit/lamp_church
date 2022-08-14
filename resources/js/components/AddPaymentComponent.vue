<template>
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="160px">
        <div class="row">
            <div class="col-md-4 mb-3">
                <el-form-item label="Payment Date" prop="date" required>
                    <el-date-picker v-model="ruleForm.date" type="date" placeholder="Pick a day" :picker-options="pickerOptions"></el-date-picker>
                </el-form-item>
            </div>
            <div class="col-md-4 mb-3">
                <el-form-item label="Amount Paid" prop="amount" required>
                    <el-input v-model="ruleForm.amount"></el-input>
                </el-form-item>
            </div>
            <div class="col-md-4 mb-3">
                <el-form-item label="Local Coordinator" prop="user">
                    <el-input v-model="user.name" readonly></el-input>
                </el-form-item>
            </div>
        </div>
    </el-form>
</template>

<script>
export default {
    props: {
        uuid: {
            required: true,
            type: String
        },
        user: {
            required: false,
            type: Object
        },
        balance: {
            required: true,
            type: Number
        }
    },
    data() {
        var checkAmount = (rule, value, callback) => {
            if (!value) {
                return callback(new Error('Please input the amount'));
            }

            if (isNaN(parseFloat(value))) {
                callback(new Error('Please input digits'));
            }

            if (parseFloat(value) <= 0) {
                callback(new Error('The amount is invalid'));
            }

            if (value > this.balance) {
                callback(new Error('The amount is greater than the balance.'));
            }

            setTimeout(() => {
                callback();
            }, 1000);
        };
        return {
            pickerOptions: {
                disabledDate(time) {
                    return time.getTime() > Date.now();
                },
                shortcuts: [{
                    text: 'Today',
                    onClick(picker) {
                    picker.$emit('pick', new Date());
                    }
                }, {
                    text: 'Yesterday',
                    onClick(picker) {
                    const date = new Date();
                    date.setTime(date.getTime() - 3600 * 1000 * 24);
                    picker.$emit('pick', date);
                    }
                }, {
                    text: 'A week ago',
                    onClick(picker) {
                    const date = new Date();
                    date.setTime(date.getTime() - 3600 * 1000 * 24 * 7);
                    picker.$emit('pick', date);
                    }
                }]
            },
            ruleForm: {
                date: '',
                amount: null
            },
            rules: {
                date: [
                    { required: true, message: 'Please input payment date', trigger: 'blur'}
                ],
                amount: [
                    { validator: checkAmount, trigger: 'blur' }
                ],
            }
        }
    },
    methods: {
        formSubmit(){
            this.$refs['ruleForm'].validate(async (valid) => {
                const loading = this.$loading({
                        lock: true,
                        text: 'Loading',
                        background: 'rgba(0, 0, 0, 0.7)'
                    });

                if (valid) {
                    setTimeout(async () => {
                        await axios.post(`/payments/${this.uuid}`, this.ruleForm)
                        .then(async (response) => {
                            console.log(response.data.is_paid)
                            loading.close()
                            
                            this.$refs['ruleForm'].resetFields();

                            this.$alert('', 'Payment Successfully Added!', {
                                confirmButtonText: 'OK',
                                showCancelButton: false,
                                closeOnPressEscape: false,
                                closeOnClickModal: false,
                                showClose: false,
                                center: true,
                                type: 'success',
                                callback: action => {
                                    if (response.data.is_paid)
                                        window.location.href = `/payments/${this.uuid}`;
                                    else
                                        window.location.reload();
                                }
                            });
                        });
                    }, 1000);
                } else 
                    loading.close()
            })
        }
    }
}
</script>

<style scoped>
.el-date-editor.el-input, .el-date-editor.el-input__inner {
    width: 100% !important;
}
</style>