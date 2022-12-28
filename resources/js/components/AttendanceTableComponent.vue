<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="border-0 m-4 card shadow">
                    <div class="card-body">
                        <table class="border text-center w-full" style="width: 100%">
                            <tr>
                                <td class="border px-2 py-1" colspan="4">Overall Unique Count</td>
                            </tr>
                            <tr>
                                <td class="border px-2 py-1"></td>
                                <td class="border px-2 py-1">Member</td>
                                <td class="border px-2 py-1">Guest</td>
                                <td class="border px-2 py-1">Total</td>
                            </tr>
                            <tr v-for="lc in overall">
                                <td class="border px-2 py-1">{{ lc.local_church }}</td>
                                <td class="border px-2 py-1">{{ lc.count.member.attended }} / {{ lc.count.member.total }}</td>
                                <td class="border px-2 py-1">{{ lc.count.guest.attended }} / {{ lc.count.guest.total }}</td>
                                <td class="border px-2 py-1">{{ lc.count.guest.attended + lc.count.member.attended }} / {{ lc.count.guest.total + lc.count.member.total }}</td>
                            </tr>
                            <tr>
                                <td class="border px-2 py-1">Total</td>
                                <td class="border px-2 py-1">{{ overall_total.member.attended }} / {{ overall_total.member.total }}</td>
                                <td class="border px-2 py-1">{{ overall_total.guest.attended }} / {{ overall_total.guest.total }}</td>
                                <td class="border px-2 py-1">{{ overall_total.guest.attended + overall_total.member.attended }} / {{ overall_total.guest.total + overall_total.member.total }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mb-0 text-black-50"></hr>
        <div class="row">
            <template v-for="(item, index) in count">
                <div class="col-md-6">
                    <div class="border-0 m-4 card shadow">
                        <div class="card-body">
                            <table class="border text-center w-full" style="width: 100%">
                                <tr>
                                    <td class="border px-2 py-1" colspan="4">{{ item.event_date }}</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1"></td>
                                    <td class="border px-2 py-1">Member</td>
                                    <td class="border px-2 py-1">Guest</td>
                                    <td class="border px-2 py-1">Total</td>
                                </tr>
                                <tr v-for="lc in item.count">
                                    <td class="border px-2 py-1">{{ lc.local_church }}</td>
                                    <td class="border px-2 py-1">{{ lc.count.member.attended }} / {{ lc.count.member.total }}</td>
                                    <td class="border px-2 py-1">{{ lc.count.guest.attended }} / {{ lc.count.guest.total }}</td>
                                    <td class="border px-2 py-1">{{ lc.count.guest.attended + lc.count.member.attended }} / {{ lc.count.guest.total + lc.count.member.total }}</td>
                                </tr>
                                <tr>
                                    <td class="border px-2 py-1">Total</td>
                                    <td class="border px-2 py-1">{{ item.overall.guest.attended }} / {{ item.overall.guest.total }}</td>
                                    <td class="border px-2 py-1">{{ item.overall.member.attended }} / {{ item.overall.member.total }}</td>
                                    <td class="border px-2 py-1">{{ item.overall.guest.attended + item.overall.member.attended }} / {{ item.overall.guest.total + item.overall.member.total }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        count: {
            required: true,
            type: Array
        },
        overall: {
            required: true,
            type: Array
        },
        overall_total: {
            required: true,
            type: Array
        }
    }
}
</script>