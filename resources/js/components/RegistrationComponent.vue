<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img width="100%" class="mb-3 rounded shadow" src="/images/registration_banner.jpg">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <banner-component />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <component ref="myChild" v-bind:is="currentTabComponent" v-bind:data="currentTabData" :slots="slots" @change-step="changeStep" :closeRegForMember="false" @reset="reset" @submit="submit"/>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <el-button v-if="currentStep > 1" plain @click="$refs.myChild.submitForm('back')">Back</el-button>
                <el-button v-bind:type="(currentStep === 3 || (currentStep === 2 && data.step_1.registrationType === 'Guest')) ? 'primary' : ''" v-bind:plain="currentStep < 3" @click="$refs.myChild.submitForm('next')">{{ (currentStep === 3 || (currentStep === 2 && data.step_1.registrationType === 'Guest')) ? 'Submit' : 'Next' }}</el-button>
            </div>
            <div class="col-md-3">
                <el-progress :stroke-width="6" define-back-color="#595353" class="mt-lg-2" :color="customColorMethod" :percentage="(100 * currentStep) / 3" :format="format"></el-progress>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</template>

<script>
    import Step1 from "../components/Registration/Step1.vue";
    import Step2 from "../components/Registration/Step2.vue";
    import Step3 from "../components/Registration/Step3.vue";

    export default {
        components: {
            Step1,
            Step2,
            Step3
        },
        props: {
            slots: {
                required: false,
                type: Array
            },
        },
        data() {
            return {
                currentStep: 1,
                currentTabComponent: null,
                currentTabData: null,
                countries: this.$allCountries,
                data: {
                    step_1: {},
                    step_2: {},
                    step_3: {}
                }
            }
        },
        created() {
            this.setTabComponents()
        },
        methods: {
            customColorMethod(percentage) {
                if (percentage == 100) {
                    return '#67c23a';
                } else {
                    return '#409eff';
                }
            },
            setTabComponents() {
                if (this.currentStep === 1)
                    this.currentTabComponent = Step1;
                else if (this.currentStep === 2)
                    this.currentTabComponent = Step2;
                else if (this.currentStep === 3)
                    this.currentTabComponent = Step3;

                this.currentTabData = this.data
            },
            format() {
                return `Page ${this.currentStep} of 3`;
            },
            async changeStep({destination, current, data}) {
                if (destination === 'step_1') this.currentStep = 1
                if (destination === 'step_2') this.currentStep = 2
                if (destination === 'step_3') this.currentStep = 3

                if (current === 'step_1') this.data.step_1 = data;
                if (current === 'step_2') this.data.step_2 = data;
                if (current === 'step_3') this.data.step_3 = data;

                this.setTabComponents();
            },
            reset() {
                this.data.step_2 = {};
                this.data.step_3 = {};
            },
            submit(data) {
                this.data.step_3 = data

                if (this.data.step_1.registrationType === 'Guest') {
                    this.data.step_2 = data;
                    this.data.step_3 = {};
                }

                const loading = this.$loading({
                    lock: true,
                    text: 'Loading',
                    background: 'rgba(0, 0, 0, 0.7)'
                });

                setTimeout(async () => {
                    await axios.post("/registration", this.data)
                    .then(async (response) => {
                        console.log(response.data)
                        loading.close()
                        
                        this.showTicket(response.data.toString())

                        this.$refs[formName].resetFields();
                    });
                }, 1000);
            },
            showTicket(uuid) {
                window.location.href = `registration/ticket?id=${uuid}`;
            },
        }
    }
</script>
