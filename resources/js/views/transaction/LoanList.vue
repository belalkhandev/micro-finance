<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Loan Transaction List</h4>
                    </div>
                    <div class="box-action">
                        <router-link :to="{ name:'GenerateTransaction' }" class="btn btn-sm btn-primary">Generate Transaction</router-link>
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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterTransactions" v-for="(transaction, i) in filterTransactions" :key="transaction.id">
                            <td>{{ i+1 }}</td>
                            <td>{{ transaction.transaction_no }}</td>
                            <td>
                                <router-link :to="{name: 'MemberShow', params: {
                                    member_id: transaction.member_id
                                }}" class="text-primary">
                                    {{ transaction.member_name }} <br>
                                    {{ transaction.member_account_no }}
                                </router-link>
                            </td>
                            <td>{{ transaction.application.dps_type }} <br>{{ transaction.amount }}</td>
                            <td>{{ transaction.balance }}</td>
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
                                        Pay now
                                    </a>
                                </span>
                                <span v-else class="text-danger">
                                    <span class="btn btn-success btn-sm py-1">Paid</span>
                                </span>
                            </td>
                        </tr>
                        <tr v-else>
                            <td colspan="10">No Transaction found</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    <p>Pagination here</p>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
        <loan-transaction-payment :transaction="loan_transaction_data"></loan-transaction-payment>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import moment from "moment";
import LoanTransactionPayment from './LoanTransactionPayment'
import bootstrap from 'bootstrap/dist/js/bootstrap'

export default ({
    name: "Index",
    components: {
        LoanTransactionPayment
    },

    data () {
        return {
            loan_transaction_data: null
        }
    },

    computed: {
        ...mapGetters({
            transactions: 'transaction/loan_transactions'
        }),

        filterTransactions() {
            return this.transactions;
        }
    },

    methods: {
        ...mapActions({
            getLoanTransactions: 'transaction/getLoanTransactions'
        }),

        userFormattedDate(date) {
            return moment(date).format("LL");
        },

        dayNameFormat(date) {
            return moment(date).format("dddd");
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
    },

    mounted() {
        this.getLoanTransactions();
    }


})
</script>
