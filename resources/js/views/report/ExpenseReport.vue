<template>
    <div class="widget widget-secondary mb-4" v-if="openFilter">
        <div class="widget-header">
            <h5 class="title">Filtering</h5>
            <span>
                <i class='bx bx-filter-alt'></i>
            </span>
        </div>
        <div class="widget-body">
            <form @submit.prevent="filterSubmit">
                <div class="row">
                    <div class="col-md-3">
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
                    <div class="col-md-2">
                        <select v-model="form.status" class="form-control">
                            <option value="">Savings Status</option>
                            <option value="deposit">Deposit</option>
                            <option value="withdraw">Withdraw</option>
                        </select>
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
                        <h4>Expenses reports</h4>
                    </div>
                    <div class="box-action">
                        <button type="button" class="btn btn-sm btn-secondary" @click="openFilter = !openFilter">Filter</button>
                        <button class="btn btn-sm btn-primary" @click="downloadSavingsApplicationsReport">Download</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Member</th>
                            <th>Deposit Amt.</th>
                            <th>Withdraw Amt.</th>
                            <th>Beginning Balance</th>
                            <th>Ending Balance</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterSavings && filterSavings.data" v-for="(savings, i) in filterSavings.data" :key="savings.id">
                            <td>{{ filterSavings.from+i }}</td>
                            <td>
                                <div class="application-member">
                                    <img :src="savings.member ? savings.member.photo : ''" alt="" class="w-8 rounded">
                                    <div>
                                        <router-link :to="{name: 'MemberShow', params: { member_id: savings.member_id }}" class="text-primary">
                                            {{ savings.member.name }}
                                        </router-link>

                                        <p>Acc. no: {{ savings.member.account_no }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span v-if="savings.savings_type=='deposit'">{{ numberFormat(savings.amount, 2) }}</span>
                                <span v-else>-</span>
                            </td>
                            <td>
                                <span v-if="savings.savings_type=='withdraw'">{{ numberFormat(savings.amount, 2) }}</span>
                                <span v-else>-</span>
                            </td>
                            <td>
                                {{ numberFormat(savings.beginning_balance, 2) }}
                            </td>
                            <td>
                                {{ numberFormat(savings.ending_balance, 2) }}
                            </td>
                            <td v-html="getStatusFormat(savings.savings_type)"></td>
                            <td>{{ userFormattedDate(savings.created_at) }}</td>
                        </tr>
                        <tr v-else>
                            <td colspan="9">No data found</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    <!-- pagination -->
                    <div class="pagination" v-if="filterSavings">
                        <p class="pagination-data">
                            Page {{ filterSavings.current_page }} Showing  {{ filterSavings.from }} to {{ filterSavings.to }} of {{ filterSavings.total }} Data
                        </p>
                        <Pagination :data="filterSavings" @pagination-change-page="getResults" :limit="6"/>
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
import LaravelVuePagination from 'laravel-vue-pagination';
import $ from "jquery";

export default ({
    name: "SavingsTransactionsReport",

    components: {
        'Pagination': LaravelVuePagination
    },

    data() {
        return {
            is_filter_pagination: false,
            form: {
                from_date: '',
                to_date: '',
                member_id: '',
                status: ''
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
            savings: 'savings/savings_transactions',
            members: 'member/searchData',
        }),

        filterSavings() {
            return this.savings;
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
            getSavingsTransactions: 'savings/getSavingsTransactions',
            filterSavingsTransactions: 'savings/filterSavingsTransactions'
        }),

        getResults(page = 1) {
            if (!this.is_filter_pagination) {
                this.getSavingsTransactions(page);
            } else {
                let formData = this.form;
                formData.page = page
                this.filterSavingsTransactions(formData)
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
            this.filterSavingsTransactions(this.form)
        },

        clearFilterForm() {
            this.is_filter_pagination = false;
            this.getResults(1);
            this.form.member_id = '';
            this.form.from_date = '';
            this.form.to_date = '';
            this.form.status = '';
            this.member_input_text = '';
            this.from_date='';
            this.to_date='';
        },

        downloadSavingsApplicationsReport() {
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

            window.open(`${window.location.origin}/download/savings/transactions${filterQuery}`);
        },
    },

    mounted() {
        this.getResults(1);
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
<style>
.btn.btn-sm.btn-outline-info.btn-text {
    line-height: 1;
}
.member-select .member-list {
    z-index: 999;
}

.widget .widget-body p {
    color: #000;
}
</style>

