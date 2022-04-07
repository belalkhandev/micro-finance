<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Loan applications list</h4>
                    </div>
                    <div class="box-action">
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
            applications: 'loan/applications'
        }),

        filterApplications() {
            if (this.applications) {
                return this.paginate(this.applications);
            }

            return this.applications;
        }
    },

    methods: {
        ...mapActions({
            getApplications: 'loan/getApplications',
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
        this.getApplications();

        if (!this.applications) {
            this.getApplications().then(() => {
                this.setPages();
            });
            this.setPages();
        }
    }


})
</script>
