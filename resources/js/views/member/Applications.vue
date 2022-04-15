<template>
    <div class="row" v-if="member">
        <div class="col-md-3">
            <member-show-sidebar :member="member"></member-show-sidebar>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>DPS Applications</h5>
                    </div>
                    <div class="box-action">
                        <div class="search" :class="is_open_search ? 'open-search' : ''">
                            <div class="search-form animate__animated animate__fadeIn animate__fast">
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
                            <th>Acc. No</th>
                            <th>Deposit</th>
                            <th>Year</th>
                            <th>Total Deposit</th>
                            <th>Total Receive</th>
                            <th>Balance</th>
                            <th>Created at</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterDpsApplications" v-for="(application, i) in filterDpsApplications" :key="application.id">
                            <td>{{ i+1 }}</td>
                            <td>{{ application.member_account_no }}</td>
                            <td>{{ application.dps_amount }} <br> ({{ ucFirst(application.dps_type) }})</td>
                            <td>{{ application.year }}</td>
                            <td>{{ application.total_amount }}</td>
                            <td>{{ application.receiving }}</td>
                            <td>{{ application.balance }}</td>
                            <td>{{ userFormattedDate(application.created_at) }}</td>
                            <td>
                                <div class="action">
                                    <router-link :to="{ name: 'EditDPSApplication', params:{application_id: application.id}}" class="btn btn-outline-warning btn-sm"><i class="bx bx-edit"></i></router-link>
                                    <a href="#" class="btn btn-outline-danger btn-sm" @click.prevent="deleteDpsConfirm(application.id)"><i class="bx bx-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr v-else>
                            <td colspan="9">No application found</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <!-- pagination -->
                    <div class="pagination" v-if="filterDpsApplications && filterDpsApplications.length > per_page">
                        <p class="pagination-data">
                            Page no {{ page }} Show {{ page === pages.length ? (filterDpsApplications ? filterDpsApplications.length : 0) : page*(filterDpsApplications ? filterDpsApplications.length : 0) }} of {{ filterDpsApplications ? filterDpsApplications.length : 0 }} Data
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

            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>Loan Applications</h5>
                    </div>
                    <div class="box-action">
                        <div class="search" :class="is_loan_open_search ? 'open-search' : ''">
                            <div class="search-form animate__animated animate__fadeIn animate__fast">
                                <div class="search-group">
                                    <Datepicker v-model="search_loan_date" format="yyyy-MM-dd" :enableTimePicker="false" autoApply placeholder="Search date"/>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm focus:shadow-none" @click="openLoanSearch()">
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
                            <th>Loan Amont</th>
                            <th>Service</th>
                            <th>Total Amount</th>
                            <th>Installment</th>
                            <th>Paid</th>
                            <th>Created at</th>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterLoanApplications" v-for="(application, i) in filterLoanApplications" :key="i">
                            <td>{{ i+1 }}</td>
                            <td>{{ application.loan_amount }}</td>
                            <td>{{ application.service_amount }} ({{ application.service }}%)</td>
                            <td>{{ application.total_amount }}</td>
                            <td>{{ application.installment_amount }} X {{ application.installment }} <br>({{ ucFirst(application.dps_type) }})</td>
                            <td>0</td>
                            <td>{{ userFormattedDate(application.created_at) }}</td>
                            <td>
                                <div class="action">
                                    <router-link :to="{ name: 'EditLoanApplication', params:{application_id: application.id}}" class="btn btn-outline-warning btn-sm"><i class="bx bx-edit"></i></router-link>
                                    <a href="#" class="btn btn-outline-danger btn-sm" @click.prevent="deleteLoanConfirm(application.id)"><i class="bx bx-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr v-else>
                            <td colspan="9">No application found</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <!-- pagination -->
                    <div class="pagination" v-if="filterLoanApplications && filterLoanApplications.length > per_page">
                        <p class="pagination-data">
                            Page no {{ page }} Show {{ page === pages.length ? (filterLoanApplications ? filterLoanApplications.length : 0) : page*(filterLoanApplications ? filterLoanApplications.length : 0) }} of {{ filterLoanApplications ? filterLoanApplications.length : 0 }} Data
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
    </div>
</template>

<script>
import { mapGetters, mapActions} from 'vuex'
import MemberShowSidebar from '../../components/MemberShowSidebar'
import {helpers} from "../../mixin";

export default({
    name: 'Applications',
    components: {
        MemberShowSidebar
    },
    mixins: [helpers],

    data() {
        return {
            member_id: this.$route.params.member_id
        }
    },

    computed: {
        ...mapGetters ({
            members: 'member/members',
            dpsApplications: 'dps/applications',
            loanApplications: 'loan/applications',
        }),

        member() {
            if (this.members && this.member_id) {
                return this.members.find(member => member.id == this.member_id)
            }
        },

        filterDpsApplications() {
            if (this.dpsApplications) {
                const member_dps_applications = this.dpsApplications.filter((item) => {
                    return item.member_id == this.member_id
                });

                if (this.search_date ) {
                    return this.paginate(member_dps_applications.filter(
                        application =>
                            this.datePickerFormat(application.created_at) === this.datePickerFormat(this.search_date)
                    ));
                } else {
                    return this.paginate(member_dps_applications);
                }
            }

            return null;
        },

        filterLoanApplications() {
            if (this.loanApplications) {
                const member_loan_applications = this.loanApplications.filter((item) => {
                    return item.member_id == this.member_id
                });

                if (this.search_loan_date ) {
                    return this.paginate(member_loan_applications.filter(
                        application =>
                            this.datePickerFormat(application.created_at) === this.datePickerFormat(this.search_date)
                    ));
                } else {
                    return this.paginate(member_loan_applications);
                }
            }

            return null;
        }
    },

    methods: {
        ...mapActions({
            getMembers: 'member/getMembers',
            getDpsApplications: 'dps/getApplications',
            getLoanApplications: 'loan/getApplications',
            deleteDpsApplication: 'dps/deleteApplication',
            deleteLoanApplication: 'loan/deleteApplication'
        }),

        deleteDpsConfirm(application_id) {
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
                        this.deleteDpsApplication(application_id).then(() => {
                            if (!this.error_message) {
                                this.$swal({
                                    icon: 'success',
                                    title: 'Congratulation!',
                                    text: 'Dps application has been deleted successfully'
                                })
                            }else {
                                this.error = this.error_message
                            }
                        })
                    }
                });
            } else {
                this.message403();
            }
        },

        deleteLoanConfirm(application_id) {
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
                        this.deleteLoanApplication(application_id).then(() => {
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
                this.message403();
            }
        },

        // pagination set pages
        setDpsPages() {
            let numberOfPages = Math.ceil(this.dpsApplications ? this.dpsApplications.length / this.per_page : 0);
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },

        // pagination set pages
        setLoanPages() {
            let numberOfPages = Math.ceil(this.loanApplications ? this.loanApplications.length / this.per_page : 0);
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },
    },

    mounted() {
        if (!this.members) {
            this.getMembers();
        }

        this.getDpsApplications();

        if (!this.dpsApplications) {
            this.getDpsApplications().then(() => {
                this.setDpsPages();
            });
            this.setDpsPages();
        }

        this.getLoanApplications();

        if (!this.loanApplications) {
            this.getLoanApplications().then(() => {
                this.setLoanPages();
            });
            this.setLoanPages();
        }
    }


})
</script>
