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
                        <table class="table table-borderless table-striped">
                            <tbody>
                            <tr>
                                <th>Loan Status</th>
                                <td  class="text-right" v-html="getStatusFormat(application.status)"></td>
                            </tr>
                            <tr>
                                <th>Loan</th>
                                <td class="text-right">{{ numberFormat(application.loan_amount) }}</td>
                            </tr>
                            <tr>
                                <th>Loan Service</th>
                                <td class="text-right">{{ application.service }}%</td>
                            </tr>
                            <tr>
                                <th>Service in amount</th>
                                <td class="text-right">{{ numberFormat(application.service_amount) }}</td>
                            </tr>
                            <tr>
                                <th>Loan + Service</th>
                                <td class="text-right">{{ numberFormat(application.total_amount) }}</td>
                            </tr>
                            <tr>
                                <th>Installment</th>
                                <td class="text-right">{{ application.installment }}</td>
                            </tr>
                            <tr>
                                <th>{{ ucFirst(application.dps_type) }} installment amount</th>
                                <td class="text-right">{{ numberFormat(application.installment_amount) }}</td>
                            </tr>
                            <tr v-if="application.prev_deposit">
                                <th>Previous  repayment</th>
                                <td class="text-right">{{ numberFormat(application.prev_deposit) }}</td>
                            </tr>
                            <tr>
                                <th>Total transactions</th>
                                <td class="text-right">{{ application.paid_transactions.length }}</td>
                            </tr>
                            <tr>
                                <th>Total repayment</th>
                                <td class="text-right">{{ numberFormat(application.balance) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="box" v-if="application.close_application">
                <div class="box-header">
                    <div class="box-title">
                        <h5>Application Closing Information</h5>
                    </div>
                </div>
                <div class="box-body">
                    <div class="application-info">
                        <table class="table table-borderless table-striped">
                            <tbody>
                            <tr>
                                <td>Deposit balance</td>
                                <td class="text-right">{{ numberFormat(application.close_application.deposit_balance) }}</td>
                            </tr>
                            <tr>
                                <td>Incentive amount</td>
                                <td class="text-right">{{ numberFormat(application.close_application.incentive_amount) }}</td>
                            </tr>
                            <tr>
                                <td>Payable amount</td>
                                <td class="text-right">{{ numberFormat(application.close_application.total_payable, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Payment</td>
                                <td class="text-right">{{ numberFormat(application.close_application.payment) }}</td>
                            </tr>
                            <tr>
                                <td>Payment method</td>
                                <td class="text-right">{{ ucFirst(application.close_application.payment_method) }}</td>
                            </tr>
                            <tr v-if="application.close_application.payment_channel">
                                <td>Payment channel</td>
                                <td class="text-right">{{ application.close_application.payment_channel }}</td>
                            </tr>
                            <tr v-if="application.close_application.transaction_no">
                                <td>Transaction no</td>
                                <td class="text-right">{{ application.close_application.transaction_no }}</td>
                            </tr>
                            <tr v-if="application.close_application.cheque_no">
                                <td>Cheque no</td>
                                <td class="text-right">{{ application.close_application.cheque_no }}</td>
                            </tr>
                            <tr v-if="application.close_application.note">
                                <td>Note</td>
                                <td class="text-right">{{ application.close_application.note }}</td>
                            </tr>

                            <tr>
                                <td>Closed by</td>
                                <td class="text-right">{{ application.close_application.user.name }}</td>
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
                    <div>
                        <p>Created By: <strong>{{ application.created_user.name }}</strong></p>
                        <p>Created at: {{ userFormattedDate(application.created_at) }}</p>
                    </div>
                </div>
            </div>

            <div class="box" v-if="application.status != 'closed'">
                <div class="box-header">
                    <h5>Operations</h5>
                </div>
                <div class="box-body">
                    <ul>
                        <li>
                            <router-link :to="{ name: 'EditLoanApplication', params: { application_id: application_id } }" class="btn btn-outline-primary mb-2 w-100">Edit Loan</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'CloseLoanApplication', params: { application_id: application_id } }" class="btn btn-outline-warning mb-2 w-100">Close Loan</router-link>
                        </li>
                        <li>
                            <a href="" class="btn btn-outline-danger mb-2 w-100" @click.prevent="deleteConfirm(application.id)">Delete Loan</a>
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
    name: 'ShowLoanApplication',
    data() {
        return {
            application_id: this.$route.params.application_id,
            isLoading: false
        }
    },

    computed: {
        ...mapGetters ({
            application: 'loan/application',
        }),
    },

    methods: {
        ...mapActions({
            getApplicationById: 'loan/getApplicationById',
            deleteApplication: 'loan/deleteApplication',
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
                                    text: 'Deleted successfully'
                                })

                                this.$router.push({ name: 'ApplicationLoan' })
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
                //this.$router.push({ name: 'PageNotFound'})
            }
        })
    }

})
</script>
