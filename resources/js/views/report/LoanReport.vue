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
                        <tr v-if="filterTransactions" v-for="(transaction, i) in filterTransactions" :key="transaction.id">
                            <td>{{ per_page*(page-1)+(i+1) }}</td>
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
                        </tr>
                        <tr v-else>
                            <td colspan="10">No Transaction found</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    <!-- pagination -->
                    <div class="pagination" v-if="transactions && transactions.length > per_page">
                        <p class="pagination-data">
                            Page no {{ page }} Show {{ page === pages.length ? (transactions ? transactions.length : 0) : page*(filterTransactions ? filterTransactions.length : 0) }} of {{ transactions ? transactions.length : 0 }} Data
                        </p>
                        <ul>
                            <li class="page-item">
                                <button class="page-link" @click="page = 1" data-toggle="tooltip" data-placement="bottom" title="First Page"><i class="bx bx-chevrons-left"></i></button>
                            </li>
                            <li class="page-item">
                                <button class="page-link" v-if="page !== 1" @click="page--" data-toggle="tooltip" data-placement="bottom" title=""><i class="bx bx-chevron-left"></i></button>
                            </li>
                            <li class="page-item">
                                <button type="button" class="page-link" v-for="pageNumber in pages.slice(page-1, page+10)" :class="page===pageNumber ? 'active': ''" :key="pageNumber" @click="page = pageNumber"> {{ pageNumber}} </button>
                            </li>
                            <li class="page-item">
                                <button type="button" @click="page++" v-if="page < pages.length" class="page-link"> <i class="bx bx-chevron-right"></i> </button>
                            </li>
                            <li class="page-item">
                                <button class="page-link"  @click="page = pages.length" data-toggle="tooltip" data-placement="bottom" title="Last Page"><i class="bx bx-chevrons-right"></i></button>
                            </li>
                        </ul>
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

export default ({
    name: "LoanReport",
    components: {
        LoanTransactionPayment
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
            if (this.transactions) {
                return this.paginate(this.transactions);
            }

            return this.transactions;
        }
    },

    methods: {
        ...mapActions({
            getLoanTransactions: 'report/getLoanTransactions'
        }),

        downloadReport() {
            window.open('http://127.0.0.1:8000/download/loan')
        },

        showLoanTransactionModal(data)
        {
            this.loan_transaction_data = data
            var LoanTransactionModal = new bootstrap.Modal(document.getElementById('loanTransactionPayment'));
            LoanTransactionModal.show();
        },

        deleteConfirm(user_id) {
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
                    this.deleteUser(user_id).then(() => {
                        if (!this.error_message) {
                            this.$swal({
                                icon: 'success',
                                title: 'Congratulation!',
                                text: 'User has been deleted successfully'
                            })
                        }else {
                            this.error = this.error_message
                        }
                    })
                }
            });
        },

        // pagination set pages
        setPages() {
            let numberOfPages = Math.ceil(this.transactions ? this.transactions.length / this.per_page : 0);
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },
    },

    mounted() {
        if (!this.transactions) {
            this.getLoanTransactions().then(() => {
                this.setPages();
            })
        }else {
            this.setPages();
        }
    },


})
</script>

<style lang="css">

</style>
