<template>
    <div class="row">
        <div class="col-md-4">
            <div class="widget widget-primary mb-4">
                <div class="widget-header">
                    <h5 class="title">Total DPS Amount</h5>
                    <span>
                        <i class='bx bx-dollar-circle'></i>
                    </span>
                </div>
                <div class="widget-body" v-if="filterTransactions">
                    <router-link to="#">
                        <h3>{{ numberFormat(filterTransactions.total_dps_amount) }}</h3>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget widget-success mb-4">
                <div class="widget-header">
                    <h5 class="title">Total Paid Amount</h5>
                    <span>
                        <i class='bx bx-dollar-circle'></i>
                    </span>
                </div>
                <div class="widget-body" v-if="filterTransactions">
                    <router-link to="#">
                        <h3>{{ numberFormat(filterTransactions.total_paid_dps_amount) }}</h3>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget widget-warning mb-4">
                <div class="widget-header">
                    <h5 class="title">Total Unpaid Amount</h5>
                    <span>
                        <i class='bx bx-dollar-circle'></i>
                    </span>
                </div>
                <div class="widget-body" v-if="filterTransactions">
                    <router-link to="#">
                        <h3>{{ numberFormat(filterTransactions.total_unpaid_dps_amount) }}</h3>
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
                        <Datepicker v-model="to_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select To Date"/>
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
                        <h4>DPS Transaction Report</h4>
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
                            <th>Tr. no</th>
                            <th>Member/Acc. no</th>
                            <th>DPS/Amount</th>
                            <th>Beginning BAL.</th>
                            <th>Ending BAL.</th>
                            <th>Tr. Date</th>
                            <th>Paid Date</th>
                            <th>Issue Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterTransactions && filterTransactions.data" v-for="(transaction, i) in filterTransactions.data" :key="transaction.id">
                            <td>{{ transaction.transaction_no }}</td>
                            <td>
                                <router-link :to="{name: 'MemberShow', params: {
                                    member_id: transaction.member_id
                                }}" class="text-primary">
                                    {{ transaction.member.name }} <br>
                                    {{ transaction.member.account_no }}
                                </router-link>
                            </td>
                            <td>{{ transaction.application.dps_type }} <br> {{ numberFormat(transaction.amount) }}</td>
                            <td>{{ numberFormat(transaction.beginning_balance, 2) }}</td>
                            <td>{{ numberFormat(transaction.ending_balance, 2) }}</td>
                            <td>{{ dayNameFormat(transaction.transaction_date) }}, <br> {{ userFormattedDate(transaction.transaction_date) }}</td>
                            <td>{{ userFormattedDate(transaction.paid_at) }}</td>
                            <td>{{ userFormattedDate(transaction.created_at) }}</td>
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
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import bootstrap from 'bootstrap/dist/js/bootstrap'
import {helpers} from "../../mixin";
import LaravelVuePagination from "laravel-vue-pagination";
import $ from "jquery";

export default ({
    name: "DpsReport",
    components: {
        'Pagination': LaravelVuePagination
    },
    mixins: [helpers],

    data () {
        return {
            dps_transaction_data: null,
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
            transactions: 'report/dps_transactions',
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
            getDpsTransactions: 'report/getDpsTransactions',
            filterDpsTransactions: 'report/filterDpsTransactions'
        }),

        showDpsTransactionModal(data)
        {
            this.dps_transaction_data = data
            const DpsTransactionModal = new bootstrap.Modal(document.getElementById('dpsTransactionPayment'));
            DpsTransactionModal.show();
        },

        downloadReport() {
            let filterQuery = '';

            if (this.form.member_id && this.form.member_id !== this.lastMemberId) {
                filterQuery += `?member_id=${this.form.member_id}`;
                this.lastMemberId = this.form.member_id;
            }

            if (this.form.from_date) {
                filterQuery += `${filterQuery ? '&' : '?'}from_date=${this.form.from_date}`;
            }

            if (this.form.to_date) {
                filterQuery += `${filterQuery ? '&' : '?'}to_date=${this.form.to_date}`;
            }

            if (this.form.status) {
                filterQuery += `${filterQuery ? '&' : '?'}status=${this.form.status}`;
            }

            window.open(`${window.location.origin}/download/dps/transactions${filterQuery}`);
        },

        getResults(page = 1) {
            if (!this.is_filter_pagination) {
                this.getDpsTransactions(page);
            } else {
                let formData = this.form;
                formData.page = page
                this.filterDpsTransactions(formData)
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
            this.filterDpsTransactions(this.form)
        },

        clearFilterForm() {
            this.is_filter_pagination = false;
            this.getResults(1);
            this.form.member_id = '';
            this.form.from_date = '';
            this.form.to_date = '';
            this.member_input_text = '';
            this.from_date='';
            this.to_date='';
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
            let fromDate = this.datePickerFormat(this.from_date);
            this.form.from_date = fromDate != 'Invalid date' ? fromDate : '';
        },

        to_date: function () {
            let toDate = this.datePickerFormat(this.to_date);
            this.form.to_date = toDate != 'Invalid date' ? toDate : '';
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
