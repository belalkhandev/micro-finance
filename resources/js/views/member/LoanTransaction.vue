<template>
    <div class="row" v-if="member">
        <div class="col-md-3">
            <member-show-sidebar :member="member"></member-show-sidebar>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>Loan Transaction History</h5>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tr. no</th>
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
                            <td>{{ per_page*(page-1)+(i+1) }}</td>
                            <td>{{ transaction.transaction_no }}</td>
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
                <div class="box-footer">
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
        <loan-transaction-payment :transaction="loan_transaction_data"></loan-transaction-payment>
    </div>
</template>

<script>
import { mapGetters, mapActions} from 'vuex'
import MemberShowSidebar from '../../components/MemberShowSidebar'
import LoanTransactionPayment from '../transaction/LoanTransactionPayment'
import bootstrap from 'bootstrap/dist/js/bootstrap'
import {helpers} from "../../mixin";

export default({
    name: 'LoanTransactionHistory',
    components: {
        MemberShowSidebar,
        LoanTransactionPayment
    },

    data() {
        return {
            member_id: this.$route.params.member_id,
            loan_transaction_data: null
        }
    },

    mixins: [helpers],

    computed: {
        ...mapGetters ({
            members: 'member/members',
            transactions: 'member/loan_transactions'
        }),

        filterTransactions () {
            if (this.transactions) {
                return this.paginate(this.transactions);
            }

            return this.transactions;
        },

        member() {
            if (this.members && this.member_id) {
                return this.members.find(member => member.id == this.member_id)
            }
        }
    },

    methods: {
        ...mapActions({
            getMembers: 'member/getMembers',
            getTransactions: 'member/getLoanTransactions'
        }),

        showLoanTransactionModal(data)
        {
            this.loan_transaction_data = data
            var LoanTransactionModal = new bootstrap.Modal(document.getElementById('loanTransactionPayment'));
            LoanTransactionModal.show();
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
        if (!this.members) {
            this.getMembers();
        }

        if (!this.transactions) {
            this.getTransactions(this.member_id).then(() => {
                this.setPages()
            });
        }else {
            this.setPages()
        }
    },


})
</script>
