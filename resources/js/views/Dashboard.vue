<template>
    <div>
        <div class="row" v-if="dashboard">
            <div class="col-md-3">
                <div class="widget widget-success animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Members</h5>
                        <span>
                        <i class="bx bx-group"></i>
                    </span>
                    </div>
                    <div class="widget-body">
                        <router-link to="/members">
                            <h3>{{ dashboard.members }}</h3>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-warning animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Admins</h5>
                        <span>
                        <i class="bx bx-group"></i>
                    </span>
                    </div>
                    <div class="widget-body">
                        <router-link to="/admins">
                            <h3>{{ dashboard.admins }}</h3>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-primary animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">DPS Transactions</h5>
                        <span>
                        <i class='bx bx-dollar-circle'></i>
                    </span>
                    </div>
                    <div class="widget-body">
                        <h3>{{ numberFormat(dashboard.transactions_dps) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-warning animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Loan Transaction</h5>
                        <span>
                        <i class='bx bx-dollar-circle'></i>
                    </span>
                    </div>
                    <div class="widget-body">
                        <h3>{{ numberFormat(dashboard.transactions_loan) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4" v-if="dashboard">
            <div class="col-md-3">
                <div class="widget widget-primary animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Total Collections</h5>
                        <span>
                            <i class='bx bx-dollar-circle'></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <h3>{{ numberFormat(dashboard.total_collection) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-danger animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Total Dues</h5>
                        <span>
                            <i class='bx bx-dollar-circle'></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <h3>{{ numberFormat(dashboard.total_dues) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-warning animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Expenses</h5>
                        <span>
                            <i class='bx bx-dollar-circle'></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <router-link to="/expenses/list">
                            <h3>{{ numberFormat(dashboard.total_expense) }}</h3>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-success animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Fund amount</h5>
                        <span>
                            <i class='bx bx-dollar-circle'></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <h3>{{ numberFormat(dashboard.fund_amount) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <h5>Recent DPS Transaction</h5>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Tr. no</th>
                                <th>Member/Acc. no</th>
                                <th>DPS Type/Amount</th>
                                <th>Balance.</th>
                                <th>Tr. Day</th>
                                <th>Due Date</th>
                                <th>Issue Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="fetchLatestDpsTransactions" v-for="(transaction, i) in fetchLatestDpsTransactions" :key="transaction.id">
                                <td>{{ transaction.transaction_no }}</td>
                                <td>
                                    <router-link :to="{name: 'MemberShow', params: {
                                    member_id: transaction.member_id
                                }}" class="text-primary">
                                        {{ transaction.member_name }} <br>
                                        {{ transaction.member_account_no }}
                                    </router-link>
                                </td>
                                <td>{{ transaction.application.dps_type }} <br> {{ numberFormat(transaction.amount) }}</td>
                                <td>{{ numberFormat(transaction.balance) }}</td>
                                <td>{{ dayNameFormat(transaction.transaction_date) }}, <br> {{ userFormattedDate(transaction.transaction_date) }}</td>
                                <td>{{ userFormattedDate(transaction.due_date) }}</td>
                                <td>{{ userFormattedDate(transaction.created_at) }}</td>
                                <td>
                                    <span v-if="transaction.is_paid" class="text-success">Paid</span>
                                    <span v-else class="text-danger">Unpaid</span>
                                </td>
                                <td>
                                <span v-if="!transaction.is_paid">
                                    <a href="#" class="btn btn-primary btn-sm py-1" @click.prevent="showDpsTransactionModal(transaction)">
                                        Collect now
                                    </a>
                                </span>
                                    <span v-else class="text-danger">
                                    <span class="btn btn-success btn-sm py-1">Collected</span>
                                </span>
                                </td>
                            </tr>
                            <tr v-else>
                                <td colspan="10">No Transaction found</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer"></div>
                </div>

                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <h5>Recent Loan Transaction</h5>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Tr. no</th>
                                <th>Member/Acc. no</th>
                                <th>Loan Type/Amount</th>
                                <th>Balance.</th>
                                <th>Tr. Day</th>
                                <th>Due Date</th>
                                <th>Issue Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="fetchLatestLoanTransactions" v-for="(transaction, i) in fetchLatestLoanTransactions" :key="transaction.id">
                                <td>{{ transaction.transaction_no }}</td>
                                <td>
                                    <router-link :to="{name: 'MemberShow', params: {
                                    member_id: transaction.member_id
                                }}" class="text-primary">
                                        {{ transaction.member_name }} <br>
                                        {{ transaction.member_account_no }}
                                    </router-link>
                                </td>
                                <td>{{ transaction.application.dps_type }} <br>{{ numberFormat(transaction.amount) }}</td>
                                <td>{{ numberFormat(transaction.balance) }}</td>
                                <td>{{ dayNameFormat(transaction.transaction_date) }}, <br> {{ userFormattedDate(transaction.transaction_date) }}</td>
                                <td>{{ userFormattedDate(transaction.due_date) }}</td>
                                <td>{{ userFormattedDate(transaction.created_at) }}</td>
                                <td>
                                    <span v-if="transaction.is_paid" class="text-success">Paid</span>
                                    <span v-else class="text-danger">Unpaid</span>
                                </td>
                                <td>
                                <span v-if="!transaction.is_paid">
                                    <a href="#" class="btn btn-primary btn-sm py-1" @click.prevent="showLoanTransactionModal(transaction)">
                                        Collect now
                                    </a>
                                </span>
                                    <span v-else class="text-danger">
                                    <span class="btn btn-success btn-sm py-1">Collected</span>
                                </span>
                                </td>
                            </tr>
                            <tr v-else>
                                <td colspan="10">No Transaction found</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer"></div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import SearchMember from "../components/Search"
import {mapGetters, mapActions} from "vuex";
import {helpers} from "../mixin";

export default {
    name: 'Dashboard',

    mixins: [helpers],

    computed: {
        ...mapGetters({
            dashboard: 'dashboard/dashboard_data',
            loan_transactions: 'transaction/loan_transactions',
            dps_transactions: 'transaction/dps_transactions'
        }),

        fetchLatestLoanTransactions() {
            if (!this.loan_transactions) {
                this.getLoanTransaction().then(() => {
                    return this.loan_transactions.slice(0, 9);
                })
            } else {
                return this.loan_transactions.slice(0, 9);
            }
        },

        fetchLatestDpsTransactions() {
            if (!this.dps_transactions) {
                this.getDpsTransactions().then(() => {
                    return this.dps_transactions.slice(0, 9);
                })
            } else {
                return this.dps_transactions.slice(0, 9);
            }
        }
    },

    methods: {
        ...mapActions({
            getDashboardData: 'dashboard/getDashboardData',
            getLoanTransaction: 'transaction/getLoanTransactions',
            getDpsTransactions: 'transaction/getDpsTransactions'
        })
    },

    mounted() {
        this.getDashboardData();
    }

}
</script>

<style>
.widget .widget-header span i.bx {
    transform: translate(5%, 10%);
}
</style>
