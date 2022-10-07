<template>
<div class="row">
    <div class="col-md-7">
        <el-card shadow="never">
            <div class="row">
                <div class="col-md-3 text-center" v-for="(slot, index) in slots" :key="index">
                    <el-progress type="dashboard" :percentage="parseFloat(slot.percentage)" :color="colors"></el-progress>
                    <p class="font-monospace m-0">{{ slot.event_date }}</p>
                    <small class="text-muted">{{ slot.taken }} out of {{ slot.seat_count }} is taken</small><br />
                    <small>{{ slot.available }} remaining</small>
                </div>
            </div>
         </el-card>
    </div>
    <div class="col-md-5">
        <el-card shadow="never" class="p-0">
            <table style="width: 100%; font-size: 12px;">
                <thead>
                    <th class="p-2 text-center">Local Church</th>
                    <template v-for="(slot, index) in slots">
                        <th class="p-2 text-center" :key="index">{{ slot.event_date }}</th>
                    </template>
                </thead>
                <tbody>
                    <tr v-for="(lc, index) in localChurches" :key="index">
                        <td class="p-2 text-center">{{ lc }}</td>
                        <template v-for="(slot, index) in slots">
                            <td :key="index" class="p-2 text-center">{{ slot.booked_per_church[lc] || 0 }}</td>
                        </template>
                    </tr>
                </tbody>
            </table>
        </el-card>
    </div>
</div>
</template>

<script>
export default {
    props: {
        slots: {
            required: true,
            type: Array
        }
    },
    data() {
        return {
            colors: [
                {color: '#f56c6c', percentage: 20},
                {color: '#e6a23c', percentage: 40},
                {color: '#5cb87a', percentage: 60},
                {color: '#1989fa', percentage: 80},
                {color: '#6f7ad3', percentage: 100}
            ],
            localChurches: [
                'Binan',
                'Canlubang',
                'Dasmarinas',
                'Cruz',
                'Granada',
                'Isabela',
                'Muntinlupa',
                'Pateros',
                'Tarlac',
                'Valenzuela'
            ]
        }
    },
    mounted() {
        console.log(this.slots)
    }
}
</script>

<style>

</style>