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
                        <Datepicker v-model="to_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select From Date"/>
                    </div>
                    <div class="col-md-2">
                        <select v-model="form.status" class="form-control">
                            <option value="">Status</option>
                            <option value="active">Active</option>
                            <option value="closed">Closed</option>
                            <option value="inactive">Inactive</option>
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
                        <h4>Loan applications list</h4>
                    </div>
                    <div class="box-action">
                        <button type="button" class="btn btn-sm btn-secondary" @click="openFilter = !openFilter">Filter</button>
                        <button class="btn btn-sm btn-primary" @click="downloadApplicationReport">Download</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Member</th>
                            <th>Loan</th>
                            <th>Service/Installment</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Download</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterApplications && filterApplications.data" v-for="(application, i) in filterApplications.data" :key="i">
                            <td>{{ filterApplications.from+i }}</td>
                            <td>
                                <div class="application-member">
                                    <img :src="application.member ? application.member.photo : ''" alt="" class="w-8 rounded">
                                    <div>
                                        <router-link :to="{name: 'MemberShow', params: { member_id: application.member_id }}" class="text-primary">
                                            {{ application.member.name }}
                                        </router-link>

                                        <p>Acc. no: {{ application.member.account_no }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p>Total: {{ numberFormat(application.loan_amount) }}</p>
                                <p>With Service: {{ numberFormat(application.total_amount) }}</p>
                            </td>
                            <td>
                                <p>Service: {{ numberFormat(application.service_amount) }} ({{ application.service }}%)</p>
                                <p>{{ ucFirst(application.dps_type) }}: {{ numberFormat(application.installment_amount) }}</p>
                            </td>
                            <td>{{ numberFormat(application.balance) }}</td>
                            <td v-html="getStatusFormat(application.status)"></td>
                            <td>
                                <p v-if="application.created_user">{{ application.created_user.name }}</p>
                                {{ userFormattedDate(application.created_at) }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" @click="downloadApplicationTransactionReport(application.id)"><i class="bx bx-download"></i> Transactions</button>
                            </td>
                        </tr>
                        <tr v-else>
                            <td colspan="9">No application found</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    <!-- pagination -->
                    <div class="pagination" v-if="filterApplications">
                        <p class="pagination-data">
                            Page {{ filterApplications.current_page }} Showing  {{ filterApplications.from }} to {{ filterApplications.to }} of {{ filterApplications.total }} Data
                        </p>
                        <Pagination :data="filterApplications" @pagination-change-page="getResults" :limit="6"/>
                    </div>
                    <!-- end pagination -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import LaravelVuePagination from 'laravel-vue-pagination';
import $ from "jquery";

export default ({
    name: "Index",
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
            applications: 'loan/applications',
            members: 'member/searchData'
        }),

        filterApplications() {
            return this.applications;
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
            getApplications: 'loan/getApplications',
            deleteApplication: 'loan/deleteApplication',
            filterDpsApplications: 'loan/filterApplications'
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
                                    text: 'Loan application has been deleted successfully'
                                })
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

        getResults(page = 1) {
            if (!this.is_filter_pagination) {
                this.getApplications(page);
            } else {
                let formData = this.form;
                formData.page = page
                this.filterDpsApplications(formData)
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
            this.filterDpsApplications(this.form)
        },

        clearFilterForm() {
            this.is_filter_pagination = false;
            this.getResults(1);
            this.form.member_id = '';
            this.form.from_date = '';
            this.form.status = '';
            this.form.to_date = '';
            this.member_input_text = '';
            this.from_date='';
            this.to_date='';
        },

        downloadApplicationReport() {
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

            window.open(`${window.location.origin}/download/loan/applications${filterQuery}`);
        },

        downloadApplicationTransactionReport(application_id) {
            window.open(`${window.location.origin}/download/loan/application/transactions/${application_id}`);
        },
    },

    mounted() {
        this.getResults(1);
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
