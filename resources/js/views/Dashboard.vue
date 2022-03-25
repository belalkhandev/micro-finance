<template>
    <div>
        <div class="row" v-if="dashboard">
            <div class="col-md-3">
                <div class="widget widget-primary animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Search Members</h5>
                        <span>
                            <i class='bx bx-search-alt'></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <div class="search-container">
                            <button type="button" class="btn btn-search w-100" data-bs-toggle="modal" data-bs-target="#searchModal">
                                Click to Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-primary animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Members</h5>
                        <span>
                        <i class="bx bx-group"></i>
                    </span>
                    </div>
                    <div class="widget-body">
                        <h3>{{ dashboard.members }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-warning animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">DPS Transactions</h5>
                        <span>
                        <i class="bx bx-group"></i>
                    </span>
                    </div>
                    <div class="widget-body">
                        <h3>{{ numberFormat(dashboard.transactions_dps) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-danger animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Loan Transaction</h5>
                        <span>
                        <i class="bx bx-group"></i>
                    </span>
                    </div>
                    <div class="widget-body">
                        <h3>{{ numberFormat(dashboard.transactions_loan) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4" v-if="dashboard">
            <div class="col-md-3">
                <div class="widget widget-success animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Total Collections</h5>
                        <span>
                            <i class="bx bx-group"></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <h3>{{ numberFormat(dashboard.total_collection) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-warning animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Total Dues</h5>
                        <span>
                            <i class="bx bx-group"></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <h3>{{ numberFormat(dashboard.total_dues) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-primary animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Expenses</h5>
                        <span>
                            <i class="bx bx-group"></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <h3>{{ numberFormat(dashboard.total_expense) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget widget-success animate__animated animate__pulse">
                    <div class="widget-header">
                        <h5 class="title">Fund amount</h5>
                        <span>
                            <i class="bx bx-group"></i>
                        </span>
                    </div>
                    <div class="widget-body">
                        <h3>{{ numberFormat(dashboard.fund_amount) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            <h5>Recent Transaction</h5>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Member</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="box-footer"></div>
                </div>
            </div>
        </div>
        <SearchMember/>
    </div>

</template>

<script>
import Navigation from "../components/Navigation";
import SearchMember from "../components/Search"
import {mapGetters, mapActions} from "vuex";
import {helpers} from "../mixin";

export default {
    name: 'Dashboard',
    components: {
        Navigation, SearchMember
    },

    mixins: [helpers],

    computed: {
        ...mapGetters({
            dashboard: 'dashboard/dashboard_data'
        }),
    },

    methods: {
        ...mapActions({
            getDashboardData: 'dashboard/getDashboardData'
        })
    },

    mounted() {
        this.getDashboardData();
    }

}
</script>
