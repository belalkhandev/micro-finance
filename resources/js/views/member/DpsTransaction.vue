<template>
    <div class="row" v-if="member">
        <div class="col-md-3">
            <member-show-sidebar :member="member"></member-show-sidebar>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>Dps Transaction History</h5>
                    </div>
                    <div class="box-action">
                        <div class="search" :class="is_open_search ? 'open-search' : ''">
                            <div class="search-form">
                                <div class="search-group">
                                    <Datepicker v-model="search_date" format="yyyy-MM-dd" :enableTimePicker="false" autoApply placeholder="Search date"/>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm focus:shadow-none" @click="openSearch()">
                                <i class="bx bx-search-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tr. no</th>
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
                        <tr v-if="filterTransactions" v-for="(transaction, i) in filterTransactions" :key="transaction.id">
                            <td>{{ per_page*(page-1)+(i+1) }}</td>
                            <td>{{ transaction.transaction_no }}</td>
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
        <dps-transaction-payment :transaction="dps_transaction_data"></dps-transaction-payment>
    </div>
</template>

<script>
import { mapGetters, mapActions} from 'vuex'
import MemberShowSidebar from '../../components/MemberShowSidebar'
import DpsTransactionPayment from '../transaction/DpsTransactionPayment'
import bootstrap from 'bootstrap/dist/js/bootstrap'
import {helpers} from "../../mixin";
import transaction from "../../store/modules/transaction";

export default({
    name: 'DpsTransactionHistory',
    components: {
        MemberShowSidebar,
        DpsTransactionPayment
    },
    data() {
        return {
            member_id: this.$route.params.member_id,
            dps_transaction_data: null
        }
    },

    mixins:[helpers],

    computed: {
        ...mapGetters ({
            transactions: 'member/dps_transactions',
            member: 'member/member'
        }),

        filterTransactions () {
            if (this.transactions) {
                if (this.search_date) {
                    return this.paginate(this.transactions.filter(
                        transaction =>
                            this.datePickerFormat(transaction.transaction_date) === this.datePickerFormat(this.search_date)
                    ));
                } else {
                    return this.paginate(this.transactions)
                }
            }

            return null;
        },
    },

    methods: {
        ...mapActions({
            getMember: 'member/getMemberByMemberId',
            getTransactions: 'member/getDpsTransactions'
        }),

        showDpsTransactionModal(data)
        {
            this.dps_transaction_data = data
            var DpsTransactionModal = new bootstrap.Modal(document.getElementById('dpsTransactionPayment'));
            DpsTransactionModal.show();
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
        this.getMember(this.member_id);

        if (!this.transactions) {
            this.getTransactions(this.member_id).then(() => {
                this.setPages();
            });
            this.setPages();
        }
    },
    watch: {
        '$route.params.member_id'(newId, oldId) {
            this.member_id = newId
            this.getMember(this.member_id);
        }
    }


})
</script>
