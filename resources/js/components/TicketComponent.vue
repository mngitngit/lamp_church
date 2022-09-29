<template>
    <el-card class="box-card ticket-header">
        <div slot="header" class="clearfix">
            <span>LAMP WORLDWIDE AWTA 2022</span>
        </div>
        <div>
            <div class="row">
                <div class="col-md-6">
                    <barcode-component :uuid="registration.uuid" />
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <small>Name</small>
                            <span class="text-lg font-bold d-block text-uppercase">{{ registration.firstname }} {{ registration.lastname }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <small>Facebook Name</small>
                            <span class="text-lg font-bold d-block text-uppercase">{{ registration.facebook_name || '--' }}</span>
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
                <div class="col-md-3 mb-3">
                    <small>Rate</small> <small>({{registration.attending_option}})</small>
                    <span class="text-md font-bold d-block">{{ $func.formatAmount(registration.rate) }}</span>
                </div>
                <div class="col-md-3 mb-3">
                    <small>Local Church</small>
                    <span class="text-md font-bold d-block">{{ registration.local_church }}</span>
                </div>
                <div class="col-md-3 mb-3">
                    <small>Country</small>
                    <span class="text-md font-bold d-block">{{ registration.country }}</span>
                </div>
            </div>

            <div v-if="registration.attending_option === 'Hybrid'" class="row mb-3">
                <div class="col-md-12">
                    <small>Booked Dates</small>
                    <span class="text-md font-bold d-block" v-if="booked_dates.length > 0" v-html="booked_dates.join([separator = ',  '])"></span>
                    <span class="d-block font-bold text-black-50 text-md" v-else>Not yet booked. Please reach out to your local coordinator to book your schedule.</span>
                </div>
            </div>

            <div v-if="registration.attending_option === 'Hybrid'" class="row">
                <div class="col-md-12">
                    <small>*** Please screenshot this ticket. This will be your gate pass to the event place.</small>
                </div>
            </div>
        </div>
    </el-card>
</template>

<script>
export default {
    props: {
        registration: {
            required: true,
            type: Object
        },
        booked_dates: {
            required: false,
            type: Array
        }
    },
    methods: {
        capitalizeString(str) { 
            return str.toLowerCase().split(' ').map(function(word) {
               return word.replace(word[0], word[0].toUpperCase());
           }).join(' ');
        },
        goToRegistration() {
            window.location.href = `/registration`;
        },
        transformDates(dates) {
          var arr = typeof dates === 'object' ? dates : dates.split(", ")
          var html = "";

          arr.forEach(element => {
            html += "<div>"+element+"</div>";
          });

          return html;
        }
    }   
}
</script>