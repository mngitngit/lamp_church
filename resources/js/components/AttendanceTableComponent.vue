<template>
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
                        </table>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        count: {
            required: true,
            type: Array
        }
    }
}
</script>