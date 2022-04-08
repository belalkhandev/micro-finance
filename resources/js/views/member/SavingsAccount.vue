<template>
    <div class="row" v-if="member">
        <div class="col-md-3">
            <member-show-sidebar :member="member"></member-show-sidebar>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>Savings Applications</h5>
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
                    <div class="row mb-4" v-if="member">
                        <div class="col-md-4">
                            <div class="widget widget-primary animate__animated animate__pulse">
                                <div class="widget-header">
                                    <h5 class="title">Savings Deposit</h5>
                                    <span>
                                        <i class='bx bx-dollar-circle'></i>
                                    </span>
                                </div>
                                <div class="widget-body">
                                    <router-link to="/expenses/list">
                                        <h3>{{ numberFormat(member.savings_deposit) }}</h3>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="widget widget-warning animate__animated animate__pulse">
                                <div class="widget-header">
                                    <h5 class="title">Savings Withdraw</h5>
                                    <span>
                                        <i class='bx bx-dollar-circle'></i>
                                    </span>
                                </div>
                                <div class="widget-body">
                                    <router-link to="/expenses/list">
                                        <h3>{{ numberFormat(member.savings_withdraw) }}</h3>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="widget widget-success animate__animated animate__pulse">
                                <div class="widget-header">
                                    <h5 class="title">Savings Balance</h5>
                                    <span>
                                        <i class='bx bx-dollar-circle'></i>
                                    </span>
                                </div>
                                <div class="widget-body">
                                    <router-link to="/expenses/list">
                                        <h3>{{ numberFormat(member.savings_deposit - member.savings_withdraw) }}</h3>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Savings Type</th>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-if="filterSavingsAccounts" v-for="(savings, i) in filterSavingsAccounts" :key="i">
                                <td>{{ i+1 }}</td>
                                <td>{{ userFormattedDate(savings.savings_date) }}</td>
                                <td>{{ numberFormat(savings.amount) }}</td>
                                <td>{{ ucFirst(savings.savings_type) }}</td>
                                <td>
                                    <div class="action">
                                        <a href="#" class="btn btn-outline-danger btn-sm" @click.prevent="deleteConfirm(savings.id)"><i class="bx bx-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr v-else>
                                <td colspan="5">No Savings found</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <!-- pagination -->
                    <div class="pagination" v-if="filterSavingsAccounts && filterSavingsAccounts.length > per_page">
                        <p class="pagination-data">
                            Page no {{ page }} Show {{ page === pages.length ? (filterSavingsAccounts ? filterSavingsAccounts.length : 0) : page*(filterSavingsAccounts ? filterSavingsAccounts.length : 0) }} of {{ filterSavingsAccounts ? filterSavingsAccounts.length : 0 }} Data
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
            savings: 'savings/savings'
        }),

        member() {
            if (this.members && this.member_id) {
                return this.members.find(member => member.id == this.member_id)
            }
        },

        filterSavingsAccounts() {
            if (this.savings) {
               return this.paginate(this.savings)
            }

            return null;
        }
    },

    methods: {
        ...mapActions({
            getMembers: 'member/getMembers',
            getSavings: 'savings/getSavings',
            deleteSavings: 'savings/deleteSaving',
        }),

        deleteConfirm(savings_id) {
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
                    this.deleteSavings(savings_id).then(() => {
                        if (!this.error_message) {
                            this.$swal({
                                icon: 'success',
                                title: 'Congratulation!',
                                text: 'Savings has been deleted successfully'
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
            let numberOfPages = Math.ceil(this.savings ? this.savings.length / this.per_page : 0);
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },
    },

    mounted() {
        if (!this.members) {
            this.getMembers();
        }

        if (!this.savings) {
            this.getSavings(this.member_id).then(() => {
                this.setPages();
            });
        }

        this.setPages();
    }


})
</script>
