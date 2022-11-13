<template>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-4">
                <div class="row" v-if="dps_total">
                    <div class="col-md-4">
                        <div class="widget widget-primary animate__animated animate__fadeIn">
                            <div class="widget-header">
                                <h5 class="title">Total DPS</h5>
                                <span>
                                    <i class="bx bx-group"></i>
                                </span>
                            </div>
                            <div class="widget-body">
                                <router-link to="/members">
                                    <h3>{{ numberFormat(dps_total.total_amounts, 2) }}</h3>
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
                                    <h3>{{ numberFormat(dps_total.collections, 2) }}</h3>
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
                                    <h3>{{ numberFormat(dps_total.dues, 2) }}</h3>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>DPS application list</h4>
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
                        <router-link :to="{ name:'CreateDPS' }" class="btn btn-sm btn-primary">New DPS Application</router-link>
                    </div>
                </div>
                <div class="box-body">
                    <!-- pagination -->
                    <div class="pagination" v-if="filterApplications">
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
                            <th>Deposit</th>
                            <th>Year</th>
                            <th>Total Deposit</th>
                            <th>Total Getting</th>
                            <th>Profit</th>
                            <th>Created at</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-if="filterApplications && filterApplications.data" v-for="(application, i) in filterApplications.data" :key="application.id">
                                <td>{{ filterApplications.from+i }}</td>
                                <td>{{ application.member.account_no }}</td>
                                <td>
                                    <router-link :to="{name: 'MemberShow', params: { member_id: application.member_id }}" class="text-primary">
                                        {{ application.member.name }}
                                    </router-link>
                                </td>
                                <td>
                                    <img :src="application.member ? application.member.photo : ''" alt="" class="w-8 rounded">
                                </td>
                                <td>{{ numberFormat(application.dps_amount, 2) }} <br> ({{ ucFirst(application.dps_type) }})</td>
                                <td>{{ application.year }}</td>
                                <td>{{ numberFormat(application.total_amount, 2) }}</td>
                                <td>{{ numberFormat(application.receiving, 2) }}</td>
                                <td>{{ numberFormat(application.profit, 2) }}</td>
                                <td>{{ userFormattedDate(application.created_at) }}</td>
                                <td>
                                    <div class="action">
                                        <a href="#" class="btn btn-sm btn-outline-info btn-text" @click.prevent="withdrawApplication">Withdraw</a>
                                        <router-link :to="{ name: 'EditDPSApplication', params:{application_id: application.id}}" class="btn btn-outline-warning btn-sm"><i class="bx bx-edit"></i></router-link>
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
                        <Pagination :data="filterApplications" @pagination-change-page="getResults" :limit="6"/>
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
import LaravelVuePagination from 'laravel-vue-pagination';

export default ({
    name: "Index",

    components: {
        'Pagination': LaravelVuePagination
    },

    mixins: [helpers],

    computed: {
        ...mapGetters({
            applications: 'dps/applications',
            dps_total: 'dps/statistics'
        }),

        filterApplications() {
            return this.applications;
        }
    },

    methods: {
        ...mapActions({
            getApplications: 'dps/getApplications',
            getTotalDps: 'dps/getDpsStatistics',
            deleteApplication: 'dps/deleteApplication'
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
                                    text: 'User has been deleted successfully'
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


        withdrawApplication() {
            this.$swal({
                icon: 'warning',
                title: 'Coming Soon!',
                text: 'Withdrawal feature is under-construction, it will release in shortly'
            })
        },

        getResults(page = 1) {
            this.getApplications(page);
        }
    },

    mounted() {
        this.getResults(1);

        this.getTotalDps();
    }


})
</script>
<style>
.btn.btn-sm.btn-outline-info.btn-text {
    line-height: 1;
}
</style>
