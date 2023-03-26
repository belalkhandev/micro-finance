<template>
    <div class="row" v-if="application && !isLoading">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>DPS Close Form</h5>
                    </div>
                    <div class="box-action">
                        <router-link :to="{ name: 'showDPSApplication', params:{application_id: application.id}}" class="btn btn-outline-primary btn-sm">Back</router-link>
                    </div>
                </div>
                <div class="box-body">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>DPS Information</h5>
                    </div>
                    <div class="box-action">
                        <router-link :to="{ name: 'showDPSApplication', params:{application_id: application.id}}" class="btn btn-outline-primary btn-sm">Back</router-link>
                    </div>
                </div>
                <div class="box-body">
                    <div class="dps-application-member mb-4" v-if="application.member">
                        <img v-if="application.member.photo" :src="application.member.photo" alt="Member photo" class="w-16">
                        <router-link :to="{name: 'MemberShow', params: { member_id: application.member_id }}" class="text-primary">
                            {{ application.member.name }}
                        </router-link>
                        <h5>Account: {{ application.member.account_no }}</h5>
                    </div>
                    <div class="application-info">
                        <table class="table table-borderless table-striped">
                            <tbody>
                            <tr>
                                <td>DPS Status</td>
                                <td  class="text-right" v-html="getStatusFormat(application.status)"></td>
                            </tr>
                            <tr>
                                <td>Deposit Duration</td>
                                <td class="text-right">{{ application.year }} years</td>
                            </tr>
                            <tr>
                                <td>{{ ucFirst(application.dps_type) }} Deposit</td>
                                <td class="text-right">{{ numberFormat(application.dps_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Depositable Amount</td>
                                <td class="text-right">{{ numberFormat(application.total_amount) }}</td>
                            </tr>
                            <tr>
                                <td>Receivable Amount</td>
                                <td class="text-right">{{ numberFormat(application.receiving) }}</td>
                            </tr>
                            <tr>
                                <td>Profitable Amount</td>
                                <td class="text-right">{{ numberFormat(application.profit) }}</td>
                            </tr>
                            <tr>
                                <td>Total transactions</td>
                                <td class="text-right">{{ application.transactions.length }}</td>
                            </tr>
                            <tr>
                                <td>DPS Balance</td>
                                <td class="text-right">{{ numberFormat(application.balance) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default({
    name: 'ShowDpsApplication',
    data() {
        return {
            application_id: this.$route.params.application_id,
            isLoading: false
        }
    },

    computed: {
        ...mapGetters ({
            application: 'dps/application',
        }),
    },

    methods: {
        ...mapActions({
            getApplicationById: 'dps/getApplicationById',
        }),


    },

    mounted() {
        this.isLoading = true
        this.getApplicationById(this.application_id).then(() => {
            this.isLoading = false;
            if (!this.application) {
                this.$router.push({ name: 'PageNotFound'})
            }
        })
    }

})
</script>
