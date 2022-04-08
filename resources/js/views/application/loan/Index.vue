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
                                    <h3>{{ loan_total.total_amounts }}</h3>
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
                                    <h3>{{ loan_total.collections }}</h3>
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
                                    <h3>{{ loan_total.dues }}</h3>
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
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Acc. No</th>
                            <th>Member</th>
                            <th>Photo</th>
                            <th>Loan Amont</th>
                            <th>Service</th>
                            <th>Total Amount</th>
                            <th>Installment</th>
                            <th>Paid</th>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterApplications" v-for="(application, i) in filterApplications" :key="i">
                            <td>{{ i+1 }}</td>
                            <td>{{ application.member_account_no }}</td>
                            <td>
                                <router-link :to="{name: 'MemberShow', params: { member_id: application.member_id }}" class="text-primary">
                                    {{ application.member_name }}
                                </router-link>
                            </td>
                            <td>
                                <img :src="application.member ? application.member.photo : ''" alt="" class="w-8 rounded">
                            </td>
                            <td>{{ application.loan_amount }}</td>
                            <td>{{ application.service_amount }} ({{ application.service }}%)</td>
                            <td>{{ application.total_amount }}</td>
                            <td>{{ application.installment_amount }} X {{ application.installment }} <br>({{ ucFirst(application.dps_type) }})</td>
                            <td>0</td>
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
                    <div class="pagination" v-if="applications && applications.length > per_page">
                        <p class="pagination-data">
                            Page no {{ page }} Show {{ page === pages.length ? (applications ? applications.length : 0) : page*(filterApplications ? filterApplications.length : 0) }} of {{ applications ? applications.length : 0 }} Data
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
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import {helpers} from "../../../mixin";

export default ({
    name: "Index",
    components: {},

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
            if (this.applications) {
                if (this.search_key) {
                    return this.paginate(this.applications.filter(
                        appplication =>
                            appplication.member.account_no.toLowerCase().includes(this.search_key.toLowerCase()) ||
                            appplication.member.phone.toLowerCase().includes(this.search_key.toLowerCase())
                    ));
                } else {
                    return this.paginate(this.applications);
                }
            }


            return null;
        }
    },

    methods: {
        ...mapActions({
            getApplications: 'loan/getApplications',
            getLoanStatistics: 'loan/getLoanStatistics',
            deleteApplication: 'loan/deleteApplication'
        }),

        deleteConfirm(application_id) {
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
        },

        // pagination set pages
        setPages() {
            let numberOfPages = Math.ceil(this.applications ? this.applications.length / this.per_page : 0);
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },
    },

    mounted() {
        if (!this.applications) {
            this.getApplications().then(() => {
                this.setPages();
            });
        }

        this.setPages();

        this.getLoanStatistics();
    }


})
</script>
