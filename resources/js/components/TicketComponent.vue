<template>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <el-card class="box-card">
                <div slot="header" class="clearfix">
                    <span>LAMP WORLDWIDE AWTA 2022</span>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-5">
                            <barcode-component :uuid="registration.uuid" />
                        </div>
                        <div class="col-md-7">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <small>Name</small>
                                    <span class="text-lg font-bold d-block text-uppercase">{{ registration.firstname }} {{ registration.lastname }}</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <small>Facebook Name</small>
                                    <span class="text-lg font-bold d-block text-uppercase">{{ registration.facebook_name }}</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <small>Email Address</small>
                                    <span class="text-md font-bold d-block">{{ registration.email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3 mb-3">
                            <small>Registration Type</small>
                            <span class="text-md font-bold d-block">{{ registration.registration_type }}</span>
                        </div>
                        <div class="col-md-2 mb-3">
                            <small>Rate</small> <small>({{registration.attending_option}})</small>
                            <span class="text-md font-bold d-block">{{ $func.formatAmount(registration.rate) }}</span>
                        </div>
                        <div class="col-md-2 mb-3">
                            <small>Seat</small>
                            <span class="text-md font-bold d-block"><u>None</u></span>
                        </div>
                        <div class="col-md-2 mb-3">
                            <small>Local Church</small>
                            <span class="text-md font-bold d-block">{{ registration.local_church }}</span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <small>Country</small>
                            <span class="text-md font-bold d-block">{{ registration.country }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <small>*** Please screenshot this ticket. This will be your gate pass to the event place.</small>
                        </div>
                    </div>
                </div>
            </el-card>

            <el-row class="my-4">
                <el-col :span="24">
                    <el-link type="primary" class="float-end" @click="goToRegistration()">Register Another Delegate</el-link>
                </el-col>
            </el-row>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        registration: {
            required: true,
            type: Object
        },
    },
    methods: {
        capitalizeString(str) { 
            return str.toLowerCase().split(' ').map(function(word) {
               return word.replace(word[0], word[0].toUpperCase());
           }).join(' ');
        },
        goToRegistration() {
            window.location.href = `/registration`;
        }
    }
}
</script>