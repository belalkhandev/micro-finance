<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Loan Transaction Report</h4>
                    </div>
                    <div class="box-action">
                        <button class="btn btn-sm btn-primary" @click="downloadReport()">Download</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tr. no</th>
                            <th>Member/Acc. no</th>
                            <th>Loan Type/Amount</th>
                            <th>Balance.</th>
                            <th>Tr. Day</th>
                            <th>Due Date</th>
                            <th>Issue Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterTransactions && filterTransactions.data" v-for="(transaction, i) in filterTransactions.data" :key="transaction.id">
                            <td>{{ per_page*(page-1)+(i+1) }}</td>
                            <td>{{ transaction.transaction_no }}</td>
                            <td>
                                <router-link :to="{name: 'MemberShow', params: {
                                    member_id: transaction.member_id
                                }}" class="text-primary">
                                    {{ transaction.member.name }} <br>
                                    {{ transaction.member.account_no }}
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
                        </tr>
                        <tr v-else>
                            <td colspan="10">No Transaction found</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    <!-- pagination -->
                    <div class="pagination" v-if="filterTransactions">
                        <p class="pagination-data">
                            Page {{ filterTransactions.current_page }} Showing  {{ filterTransactions.from }} to {{ filterTransactions.to }} of {{ filterTransactions.total }} Data
                        </p>
                        <Pagination :data="filterTransactions" @pagination-change-page="getResults" :limit="6"/>
                    </div>
                    <!-- end pagination -->
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
        <loan-transaction-payment :transaction="loan_transaction_data"></loan-transaction-payment>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import LoanTransactionPayment from '../transaction/LoanTransactionPayment'
import bootstrap from 'bootstrap/dist/js/bootstrap'
import {helpers} from "../../mixin";
import LaravelVuePagination from "laravel-vue-pagination";

export default ({
    name: "LoanReport",
    components: {
        LoanTransactionPayment,
        'Pagination': LaravelVuePagination
    },

    mixins: [helpers],

    data () {
        return {
            loan_transaction_data: null,
        }
    },

    computed: {
        ...mapGetters({
            transactions: 'report/loan_transactions'
        }),

        filterTransactions() {
            return this.transactions;
        }
    },

    methods: {
        ...mapActions({
            getLoanTransactions: 'report/getLoanTransactions'
        }),

        downloadReport() {
            window.open(window.location.origin+'/download/loan')
        },

        showLoanTransactionModal(data)
        {
            this.loan_transaction_data = data
            var LoanTransactionModal = new bootstrap.Modal(document.getElementById('loanTransactionPayment'));
            LoanTransactionModal.show();
        },

        getResults(page = 1) {
            this.getLoanTransactions(page);
        }
    },

    mounted() {
        this.getResults(1);
    },


})
</script>

<style lang="css">

</style>
