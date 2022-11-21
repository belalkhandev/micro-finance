<template>
    <div class="row">
        <div class="col-md-4">
            <div class="widget widget-primary mb-4">
                <div class="widget-header">
                    <h5 class="title">Total transaction amount</h5>
                    <span>
                        <i class='bx bx-dollar-circle'></i>
                    </span>
                </div>
                <div class="widget-body" v-if="filterTransactions">
                    <router-link to="#">
                        <h3>{{ numberFormat(filterTransactions.total_loan_amount) }}</h3>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget widget-success mb-4">
                <div class="widget-header">
                    <h5 class="title">Total paid transaction amount</h5>
                    <span>
                        <i class='bx bx-dollar-circle'></i>
                    </span>
                </div>
                <div class="widget-body" v-if="filterTransactions">
                    <router-link to="#">
                        <h3>{{ numberFormat(filterTransactions.total_loan_amount) }}</h3>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget widget-warning mb-4">
                <div class="widget-header">
                    <h5 class="title">Total unpaid transaction amount</h5>
                    <span>
                        <i class='bx bx-dollar-circle'></i>
                    </span>
                </div>
                <div class="widget-body" v-if="filterTransactions">
                    <router-link to="#">
                        <h3>{{ numberFormat(filterTransactions.total_loan_amount) }}</h3>
                    </router-link>
                </div>
            </div>
        </div>
    </div>

    <div class="widget widget-secondary mb-4" v-if="openFilter">
        <div class="widget-header">
            <h5 class="title">Report Filter</h5>
            <span>
                <i class='bx bx-filter-alt'></i>
            </span>
        </div>
        <div class="widget-body">
            <form @submit.prevent="filterSubmit">
                <div class="row">
                    <div class="col-md-5">
                        <div class="member-select" :class="{open: isOpen}">
                            <div class="member-input" @click.prevent="showMemberList">
                                <input type="text" v-model="member_input_text" class="form-control" placeholder="Choose Member" readonly>
                                <span class="select-icon">
                                                <i class="bx bx-chevron-down"></i>
                                            </span>
                            </div>
                            <div class="member-list">
                                <div class="member-search">
                                    <input type="text" v-model="search_key" placeholder="Search by account no, name, phone" class="form-control">
                                    <span class="list-close" @click="closeMemberList">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                </div>
                                <div class="members">
                                    <div class="member text-left" v-for="(member, i) in filterMembers" :key="member.id" @click.prevent="chooseMember(member)">
                                        <p>{{ member.account_no }} - {{ member.name }} - {{ member.phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <Datepicker v-model="from_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select From Date"/>
                    </div>
                    <div class="col-md-3">
                        <Datepicker v-model="to_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select From Date"/>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-sm btn-success">Filter</button>
                        <button v-if="is_filter_pagination" type="button" @click.prevent="clearFilterForm" class="btn btn-sm btn-danger ml-2">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Loan Transaction Report</h4>
                    </div>
                    <div class="box-action">
                        <button type="button" class="btn btn-sm btn-secondary" @click="openFilter = !openFilter">Filter</button>
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
import $ from "jquery";

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
            is_filter_pagination: false,
            form: {
                from_date: '',
                to_date: '',
                member_id: ''
            },
            from_date: '',
            to_date: '',
            member_input_text: "",
            search_key: "",
            isOpen: false,
            openFilter: false
        }
    },

    computed: {
        ...mapGetters({
            transactions: 'report/loan_transactions',
            members: 'member/searchData',
        }),

        filterTransactions() {
            return this.transactions;
        },

        filterMembers()
        {
            if (this.members && this.members.length)
            {
                if (this.search_key.length > 1) {
                    return this.members.filter((member) => {
                        return member.account_no.toLowerCase().includes(this.search_key.toLowerCase())
                            || member.name.toLowerCase().includes(this.search_key.toLowerCase())
                            || member.phone.toLowerCase().includes(this.search_key.toLowerCase())
                    });
                }
            }

            return this.members;
        }
    },

    methods: {
        ...mapActions({
            getLoanTransactions: 'report/getLoanTransactions',
            filterLoanTransactions: 'report/filterLoanTransactions'
        }),

        downloadReport() {
            let filter_query = "?member_id="+this.form.member_id+"&from_date="+this.form.from_date+"&to_date="+this.form.from_date;
            if (this.form.member_id || this.form.from_date && this.form.to_date) {
                window.open(window.location.origin+'/download/loan/transactions'+filter_query)
            } else {
                window.open(window.location.origin+'/download/loan/transactions')
            }

        },

        showLoanTransactionModal(data)
        {
            this.loan_transaction_data = data
            const LoanTransactionModal = new bootstrap.Modal(document.getElementById('loanTransactionPayment'));
            LoanTransactionModal.show();
        },

        getResults(page = 1) {
            if (!this.is_filter_pagination) {
                this.getLoanTransactions(page);
            } else {
                let formData = this.form;
                formData.page = page
                this.filterLoanTransactions(formData)
            }
        },

        showMemberList() {
            this.isOpen = !this.isOpen
            $('.member-input .form-control').focus();
        },

        closeMemberList() {
            this.isOpen = !this.isOpen
        },

        chooseMember(member) {
            this.form.member_id = member.id;
            this.member_input_text = member.account_no + '-' + member.name;
            this.search_key = "";
            this.isOpen = !this.isOpen;
        },

        filterSubmit() {
            this.is_filter_pagination = true;
            this.filterLoanTransactions(this.form)
        },

        clearFilterForm() {
            this.is_filter_pagination = false;
            this.getResults(1);
            this.form.member_id = '';
            this.member_input_text = '';
            this.from_date='';
            this.to_date='';
            this.form.from_date = '';
            this.form.to_date = '';
        }
    },

    mounted() {
        this.getResults(1);

        if (!this.members) {
            this.getMembers();
        }
    },

    watch: {
        from_date: function () {
            this.form.from_date = this.datePickerFormat(this.from_date);
        },

        to_date: function () {
            this.form.to_date = this.datePickerFormat(this.to_date);
        }
    }


})
</script>

<style lang="css">
.member-select .member-list {
    z-index: 999;
}
.widget .widget-body p {
     color: #000;
 }
</style>
