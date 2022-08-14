<template>
    <el-row :gutter="12">
        <el-col :span="!isMobile() ? 12 : 24" :offset="!isMobile() ? 6 : 0">
            <el-card class="box-card">
                <div slot="header" class="clearfix">
                    <span>LAMP WORLDWIDE AWTA 2022</span>
                </div>
                <div>
                    <el-row :gutter="12">
                        <el-col :span="isMobile() ? 24 : 10">
                            <barcode-component :uuid="registration.uuid" />
                        </el-col>
                        <el-col :span="isMobile() ? 24 : 14">
                            <el-row class="mb-3">
                                <el-col :span="24">
                                    <small>Name</small>
                                    <span class="text-lg font-bold d-block text-uppercase">{{ registration.firstname }} {{ registration.lastname }}</span>
                                </el-col>
                            </el-row>
                            <el-row class="mb-3">
                                <el-col :span="24">
                                    <small>Facebook Name</small>
                                    <span class="text-lg font-bold d-block text-uppercase">{{ registration.facebook_name }}</span>
                                </el-col>
                            </el-row>
                            <el-row>
                                <el-col class="mb-3" :span="24">
                                    <small>Email Address</small>
                                    <span class="text-md font-bold d-block">{{ registration.email }}</span>
                                </el-col>
                            </el-row>
                        </el-col>
                    </el-row>

                    <el-row :gutter="12">
                        <el-col class="mb-3" :span="isMobile() ? 24 : 6">
                            <small>Registration Type</small>
                            <span class="text-md font-bold d-block">{{ registration.registration_type }}</span>
                        </el-col>
                        <el-col class="mb-3" :span="isMobile() ? 24 : 4">
                            <small>Seat</small>
                            <span class="text-md font-bold d-block"><u>None</u></span>
                        </el-col>
                        <el-col class="mb-3" :span="isMobile() ? 24 : 7">
                            <small>Local Church</small>
                            <span class="text-md font-bold d-block">{{ registration.local_church }}</span>
                        </el-col>
                        <el-col class="mb-3" :span="isMobile() ? 24 : 7">
                            <small>Country</small>
                            <span class="text-md font-bold d-block">{{ registration.country }}</span>
                        </el-col>
                    </el-row>

                    <el-row :gutter="12">
                        <el-col class="mb-3" :span="24">
                            <small>Note</small>
                            <span class="text-md font-bold d-block">**Please screenshot this ticket. This will be your gate pass to the event place.</span>
                        </el-col>
                    </el-row>

                </div>
            </el-card>

            <el-row class="my-4">
                <el-col :span="24">
                    <el-link type="primary" class="float-end" @click="goToRegistration()">Register Another Delegate</el-link>
                </el-col>
            </el-row>
        </el-col>
    </el-row>
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
        isMobile() {
            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                return true
            } else {
                return false
            }
        },
        goToRegistration() {
            window.location.href = `/registration`;
        }
    }
}
</script>