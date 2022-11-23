<template>
    <div class="row mb-4" v-if="dps_total">
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
                    <div class="col-md-4">
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
                        <h4>DPS application list</h4>
                    </div>
                    <div class="box-action">
                        <button type="button" class="btn btn-sm btn-secondary" @click="openFilter = !openFilter">Filter</button>
                        <router-link :to="{ name:'CreateDPS' }" class="btn btn-sm btn-primary">New DPS Application</router-link>
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
import $ from "jquery";

export default ({
    name: "Index",

    components: {
        'Pagination': LaravelVuePagination
    },

    mixins: [helpers],

    data() {
        return {
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
            applications: 'dps/applications',
            dps_total: 'dps/statistics',
            members: 'member/searchData',
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
            getApplications: 'dps/getApplications',
            getTotalDps: 'dps/getDpsStatistics',
            deleteApplication: 'dps/deleteApplication',
            filterDpsApplications: 'dps/filterApplications'
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
                text: 'Withdrawal feature is unavailable right now'
            })
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
            this.form.to_date = '';
            this.member_input_text = '';
            this.from_date='';
            this.to_date='';
        }
    },

    mounted() {
        this.getResults(1);
        this.getTotalDps();
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
