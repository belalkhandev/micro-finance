<template>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="row" v-if="loan_total">
                    <div class="col-md-4">
                        <div class="widget widget-primary animate__animated animate__fadeIn">
                            <div class="widget-header">
                                <h5 class="title">Total Loan</h5>
                                <span>
                                    <i class="bx bx-group"></i>
                                </span>
                            </div>
                            <div class="widget-body">
                                <router-link to="/members">
                                    <h3>{{ numberFormat(loan_total.total_amounts, 2) }}</h3>
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget widget-success animate__animated animate__fadeIn">
                            <div class="widget-header">
                                <h5 class="title">Total Collection</h5>
                                <span>
                                    <i class="bx bx-group"></i>
                                </span>
                            </div>
                            <div class="widget-body">
                                <router-link to="/members">
                                    <h3>{{ numberFormat(loan_total.collections, 2) }}</h3>
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widget widget-danger animate__animated animate__fadeIn">
                            <div class="widget-header">
                                <h5 class="title">Due Amount</h5>
                                <span>
                                    <i class="bx bx-group"></i>
                                </span>
                            </div>
                            <div class="widget-body">
                                <router-link to="/members">
                                    <h3>{{ numberFormat(loan_total.dues, 2) }}</h3>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Loan applications list</h4>
                    </div>
                    <div class="box-action">
                        <div class="search" :class="is_open_search ? 'open-search' : ''">
                            <div class="search-form">
                                <div class="search-group">
                                    <input type="search" v-model="search_key" placeholder="Search keyword" class="form-control">
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm focus:shadow-none" @click="openSearch()">
                                <i class="bx bx-search-alt"></i>
                            </button>
                        </div>
                        <router-link :to="{ name:'CreateLoan' }" class="btn btn-sm btn-primary">New Loan Application</router-link>
                    </div>
                </div>
                <div class="box-body">
                    <!-- pagination -->
                    <div class="pagination mb-2" v-if="filterApplications">
                        <p class="pagination-data">
                            Page {{ filterApplications.current_page }} Showing  {{ filterApplications.from }} to {{ filterApplications.to }} of {{ filterApplications.total }} Data
                        </p>
                        <Pagination :data="filterApplications" @pagination-change-page="getResults" :limit="6"/>
                    </div>
                    <!-- end pagination -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Acc. No</th>
                            <th>Member</th>
                            <th>Photo</th>
                            <th><abbr title="Loan Amount">L.Amount</abbr></th>
                            <th>Service</th>
                            <th><abbr title="Total Amount">T.Amount</abbr></th>
                            <th><abbr title="Installment Amount">I.Amount</abbr></th>
                            <th><abbr title="Total Installment">T.Inst</abbr></th>
                            <th>Paid</th>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterApplications && filterApplications.data" v-for="(application, i) in filterApplications.data" :key="i">
                            <td>{{ i+1 }}</td>
                            <td>{{ application.member.account_no }}</td>
                            <td>
                                <router-link :to="{name: 'MemberShow', params: { member_id: application.member_id }}" class="text-primary">
                                    {{ application.member.name }}
                                </router-link>
                            </td>
                            <td>
                                <img :src="application.member.photo ? application.member.photo : ''" alt="" class="w-8 rounded">
                            </td>
                            <td>{{ numberFormat(application.loan_amount) }}</td>
                            <td>{{ numberFormat(application.service_amount) }} ({{ application.service }}%)</td>
                            <td>{{ numberFormat(application.total_amount) }}</td>
                            <td>{{ numberFormat(application.installment_amount) }}<br>({{ ucFirst(application.dps_type) }})</td>
                            <td>{{ application.balance/application.installment_amount }} of {{ application.installment }}</td>
                            <td>{{ numberFormat(application.balance) }}</td>
                            <td>
                                <div class="action">
                                    <router-link :to="{ name: 'EditLoanApplication', params:{application_id: application.id}}" class="btn btn-outline-warning btn-sm"><i class="bx bx-edit"></i></router-link>
                                    <a href="#" class="btn btn-outline-danger btn-sm" @click.prevent="deleteConfirm(application.id)"><i class="bx bx-trash"></i></a>
                                </div>
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
                        <Pagination :data="filterApplications" @pagination-change-page="getResults" :limit="20"/>
                    </div>
                    <!-- end pagination -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import {helpers} from "../../../mixin";
import LaravelVuePagination from 'laravel-vue-pagination';

export default ({
    name: "Index",
    components: {
        'Pagination': LaravelVuePagination
    },

    data () {
        return {

        }
    },

    mixins: [helpers],

    computed: {
        ...mapGetters({
            applications: 'loan/applications',
            loan_total: 'loan/statistics',
        }),

        filterApplications() {
            return this.applications;
        }
    },

    methods: {
        ...mapActions({
            getApplications: 'loan/getApplications',
            getLoanStatistics: 'loan/getLoanStatistics',
            deleteApplication: 'loan/deleteApplication'
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
            this.getApplications(page);
        }
    },

    mounted() {
        this.getLoanStatistics();
        this.getResults(1);
    }


})
</script>
