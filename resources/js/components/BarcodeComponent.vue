<template>
    <div class="text-center">
        <canvas id="barcode"></canvas>
        <small class="text-description d-block">Registration Reference</small>
        <h3 class="d-block">{{ uuid }}</h3>
    </div>
</template>

<script>
export default {
    props: {
        uuid: {
            required: true,
            type: String
        },
    },
    mounted() {
        JsBarcode("#barcode", this.uuid, {
            displayValue: false,
            fontSize: 18
        });
    }
}
</script>

<style scoped>
.text-description {
    position: relative;
    top: -15px;
}

h3 {
    position: relative;
    top: -17px;
}
</style>