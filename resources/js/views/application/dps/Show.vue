<template>
    <div class="row" v-if="application">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>Application details</h5>
                    </div>
                </div>
                <div class="box-body">
                    <div class="member mb-4" v-if="application.member">
                        <img v-if="application.member.photo" :src="application.member.photo" alt="Member photo" class="w-24">
                        <h5>{{ application.member.name }}</h5>
                        <h5>Account: {{ application.member.account_no }}</h5>
                    </div>
                    <div class="application-info">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>Account Depositable Amount</th>
                                    <td class="text-right">{{ numberFormat(application.total_amount) }}</td>
                                </tr>
                                <tr>
                                    <th>Total Receivable Amount</th>
                                    <td class="text-right">{{ numberFormat(application.receiving) }}</td>
                                </tr>
                                <tr>
                                    <th>Total Profitable Amount</th>
                                    <td class="text-right">{{ numberFormat(application.profit) }}</td>
                                </tr>
                                <tr>
                                    <th>Current Deposit Balance</th>
                                    <td class="text-right">{{ numberFormat(application.profit) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box" v-if="application.created_user">
                <div class="box-header">
                    <h5>Application Manage by</h5>
                </div>
                <div class="box-body">
                    <p>Created By: <strong>{{ application.created_user.name }}</strong></p>
                    <p>Created at: {{ userFormattedDate(application.created_at) }}</p>
                </div>
            </div>

            <div class="box">
                <div class="box-header">
                    <h5>Operations</h5>
                </div>
                <div class="box-body">
                    <ul>
                        <li>
                            <router-link :to="{
                                name: 'EditDPSApplication',
                                params: {
                                    application_id: application_id
                                }
                            }" class="btn btn-outline-primary mb-2 w-100">Edit DPS</router-link>
                        </li>
                        <li>
                            <a href="" class="btn btn-outline-warning mb-2 w-100">Close DPS</a>
                        </li>
                        <li>
                            <a href="" class="btn btn-outline-danger mb-2 w-100">Delete DPS</a>
                        </li>
                    </ul>
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
            application_id: this.$route.params.application_id
        }
    },

    computed: {
        ...mapGetters ({
            applications: 'dps/applications',
            applicationItem: 'dps/application'
        }),

        application() {
            if (this.applications && this.application_id) {
                return this.applications.data.find(application => application.id == this.application_id)
            } else {
                return this.getApplicationById(this.application_id).then(() => {
                    return this.applicationItem
                });
            }
        }
    },

    methods: {
        ...mapActions({
            getApplications: 'dps/getApplications',
            getApplicationById: 'dps/getApplicationById'
        })
    },

    mounted() {
        if (!this.applications) {
            this.getApplications();
        }
    }

})
</script>
