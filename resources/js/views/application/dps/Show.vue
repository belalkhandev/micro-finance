<template>
    <div class="row" v-if="application && !isLoading">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>Application details</h5>
                    </div>
                </div>
                <div class="box-body">
                    <div class="dps-application-member mb-4" v-if="application.member">
                        <img v-if="application.member.photo" :src="application.member.photo" alt="Member photo" class="w-24">
                        <router-link :to="{name: 'MemberShow', params: { member_id: application.member_id }}" class="text-primary">
                            {{ application.member.name }}
                        </router-link>
                        <h5>Account: {{ application.member.account_no }}</h5>
                    </div>
                    <div class="application-info">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>Deposit Duration</th>
                                <td class="text-right">{{ application.year }} years</td>
                            </tr>
                            <tr>
                                <th>{{ ucFirst(application.dps_type) }} Deposit Amount</th>
                                <td class="text-right">{{ numberFormat(application.dps_amount, 2) }}</td>
                            </tr>
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
                                <td class="text-right">{{ numberFormat(application.balance) }}</td>
                            </tr>
                            <tr>
                                <th>Total transactions</th>
                                <td class="text-right">{{ application.transactions.length }}</td>
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
                            <a href="" class="btn btn-outline-danger mb-2 w-100" @click.prevent="deleteConfirm(application.id)">Delete DPS</a>
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
            deleteApplication: 'dps/deleteApplication',
        }),

        deleteConfirm(application_id) {
            if (this.hasPermission('delete_application')) {
                this.$swal({
                    title:"Really want to delete!",
                    text: "Are you sure? You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#5430d6",
                    confirmButtonText: "Yes, Delete it!",
                    cancelButtonColor: '#c82333',
                }).then((res) => {
                    if (res.isConfirmed) {
                        this.deleteApplication(application_id).then(() => {
                            if (!this.error_message) {
                                this.$swal({
                                    icon: 'success',
                                    title: 'Congratulation!',
                                    text: 'User has been deleted successfully'
                                })

                                this.$router.push({ name: 'ApplicationDPS' })
                            }else {
                                this.error = this.error_message
                            }
                        })
                    }
                });
            } else {
                this.message403()
            }
        },
    },

    mounted() {
        this.isLoading = true
        this.getApplicationById(this.application_id).then(() => {
            console.log(this.application)
            this.isLoading = false;
            if (!this.application) {
                this.$router.push({ name: 'PageNotFound'})
            }
        })
    }

})
</script>
