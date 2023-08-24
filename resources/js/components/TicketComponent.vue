<template>
    <div class="row justify-content-center my-4">
        <div v-bind:class="{'col-md-12 mb-4' : isRebooking, 'col-md-4 mb-4' : !isRebooking}" v-for="(registration, i) in registrations" :key="i">
            <el-card class="box-card ticket-header">
                <div slot="header" class="clearfix">
                    <span>LAMP WORLDWIDE AWTA 2023</span>
                </div>
                <div>
                    <div class="row">
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
                            <div class="row">
                                <div class="col-md-12">
                                    <small>Registration Type</small>
                                    <span class="text-md font-bold d-block">{{ registration.registration_type }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <barcode-component :uuid="registration.uuid" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <small>Rate</small> <small>({{registration.attending_option}})</small>
                            <span class="text-md font-bold d-block">{{ $func.formatAmount(registration.rate) }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <small>Local Church</small>
                            <span class="text-md font-bold d-block">{{ registration.local_church }}</span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <small>Country</small>
                            <span class="text-md font-bold d-block">{{ registration.country }}</span>
                        </div>
                    </div>

                    <!-- <div v-if="registration.cluster_group != ''" class="row">
                        <div class="col-md-12 mb-3">
                            <small>Cluster Group</small>
                            <span class="text-md font-bold d-block">{{ registration.cluster_group }}</span>
                        </div>
                    </div> -->

                    <div v-if="registration.attending_option === 'Hybrid'" class="row mb-3">
                        <div class="col-md-12">
                            <small class="d-block">Booked Dates</small>
                            <span class="text-md font-bold" v-if="registration.booked_dates.length > 0" v-html="registration.booked_dates.join([separator = ',  '])"></span>
                            <span class="font-bold text-black-50 text-md" v-else>Not yet booked. Please reach out to your local coordinator to book your schedule.</span>
                            <span v-if="registration.booked_dates.length > 0"><el-tag size="mini" effect="dark" :type="registration.booking_status === 'Confirmed' ? 'success' : (registration.booking_status === 'Cancelled' ? 'danger' : 'warning')">{{ registration.booking_status }}</el-tag></span>
                        </div>
                    </div>

                    <div v-if="registration.attending_option === 'Hybrid'" class="row">
                        <div class="col-md-12">
                            <small>***Please screenshot this ticket. This will be your virtual LAMP ID number, in case you opted not to avail the physical card. To be use in future LAMP church events/activities.</small>
                        </div>
                    </div>
                </div>
            </el-card>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        registrations: {
            required: true,
            type: Array
        },
        isRebooking: {
            default: false,
            type: Boolean,
            required: false
        },
        congratulate: {
            default: false,
            type: Boolean,
            required: false
        }
    },
    mounted() {
        if (this.congratulate)
            this.open()
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
        open() {
            var msg = '<strong>Congratulations!</strong> Your registration has been accepted! ';

            if (this.registrations[0].registration_type === 'Member' && this.registrations[0].attending_option === 'Hybrid')
                msg += '<br /><br /><small>Please settle your balance or at least pay partially to confirm your booking. If your booking is left unsettled within 7 days, it will be cancelled automatically.<br /><br />If your booking is cancelled, please reach out to your local coordinator for assistance.</small>';
            
            if (this.registrations[0].attending_option === 'Online') 
                msg += '<br /><br /><small>To watch the live broadcast, join our FB Group <br/><a href="https://www.facebook.com/groups/446318280091482">https://www.facebook.com/groups/446318280091482</a></small>'
            
            if (this.registrations[0].registration_type === 'Member')
                msg += '<br /><br /><small>Note: <i>A new LAMP ID Number is issued for you.</i> If you wish to replace your old AWTA Card with the new LAMP ID, please contact your local coordinator and pay 35 pesos for the issuance.</small><br/><br/><img width="170" height="100" class="mb-3 rounded shadow" src="/images/new_id.jpg"><br/><small style="font-size: 8px;font-style: italic;color: gray;">sample ID only</small>';

            this.$confirm(msg, 'You did it!', {
                confirmButtonText: 'Close',
                showCancelButton: false,
                width: '50%',
                showClose: true,
                type: 'success',
                center: true,
                dangerouslyUseHTMLString: true
            })
        }
    }   
}
</script>