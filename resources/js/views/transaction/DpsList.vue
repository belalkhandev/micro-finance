<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>DPS Transaction List</h4>
                    </div>
                    <div class="box-action">
                        <div class="search" :class="is_open_search ? 'open-search' : ''">
                            <div class="search-form">
                                <div class="search-group">
                                    <input type="search" v-model="search_key" placeholder="Search keyword" class="form-control">
                                </div>
                                <div class="search-group">
                                    <Datepicker v-model="search_date" format="yyyy-MM-dd" :enableTimePicker="false" autoApply placeholder="Search date"/>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm focus:shadow-none" @click="openSearch()">
                                <i class="bx bx-search-alt"></i>
                            </button>
                        </div>
                        <router-link :to="{ name:'GenerateTransaction' }" class="btn btn-sm btn-primary">Generate Transaction</router-link>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Tr. no</th>
                            <th>Member/Acc. no</th>
                            <th>DPS Type/Amount</th>
                            <th>Balance.</th>
                            <th>Tr. Day</th>
                            <th>Due Date</th>
                            <th>Issue Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterTransactions && filterTransactions.data" v-for="(transaction, i) in filterTransactions.data" :key="transaction.id">
                            <td>{{ transaction.transaction_no }}</td>
                            <td>
                                <router-link :to="{name: 'MemberShow', params: {
                                    member_id: transaction.member_id
                                }}" class="text-primary">
                                    {{ transaction.member.name }} <br>
                                    {{ transaction.member.account_no }}
                                </router-link>
                            </td>
                            <td>{{ transaction.application.dps_type }} <br> {{ numberFormat(transaction.amount) }}</td>
                            <td>{{ numberFormat(transaction.balance) }}</td>
                            <td>{{ dayNameFormat(transaction.transaction_date) }}, <br> {{ userFormattedDate(transaction.transaction_date) }}</td>
                            <td>{{ userFormattedDate(transaction.due_date) }}</td>
                            <td>{{ userFormattedDate(transaction.created_at) }}</td>
                            <td>
                                <span v-if="transaction.is_paid" class="text-success">Paid</span>
                                <span v-else class="text-danger">Unpaid</span>
                            </td>
                            <td>
                                <span v-if="!transaction.is_paid">
                                    <a href="#" class="btn btn-primary btn-sm py-1" @click.prevent="showDpsTransactionModal(transaction)">
                                        Collect now
                                    </a>
                                </span>
                                <span v-else class="text-danger">
                                    <span class="btn btn-success btn-sm py-1">Collected</span>
                                </span>
                            </td>
                        </tr>
                        <tr v-else>
                            <td colspan="10">No Transaction found</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    <!-- pagination -->
                    <div class="pagination" v-if="filterTransactions">
                        <p class="pagination-data">
                            Page {{ filterTransactions.current_page }} Showing  {{ filterTransactions.from }} to {{ filterTransactions.to }} of {{ filterTransactions.total }} Data
                        </p>
                        <Pagination :data="filterTransactions" @pagination-change-page="getResults" :limit="6"/>
                    </div>
                    <!-- end pagination -->
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
        <dps-transaction-payment :transaction="dps_transaction_data"></dps-transaction-payment>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import DpsTransactionPayment from './DpsTransactionPayment'
import bootstrap from 'bootstrap/dist/js/bootstrap'
import {helpers} from "../../mixin";
import LaravelVuePagination from "laravel-vue-pagination";

export default ({
    name: "Index",
    components: {
        DpsTransactionPayment,
        'Pagination': LaravelVuePagination
    },
    mixins: [helpers],

    data () {
        return {
            dps_transaction_data: null
        }
    },

    computed: {
        ...mapGetters({
            transactions: 'transaction/dps_transactions'
        }),

        filterTransactions() {
            return this.transactions;
        }
    },

    methods: {
        ...mapActions({
            getDpsTransactions: 'transaction/getDpsTransactions'
        }),

        showDpsTransactionModal(data)
        {
            this.dps_transaction_data = data
            var DpsTransactionModal = new bootstrap.Modal(document.getElementById('dpsTransactionPayment'));
            DpsTransactionModal.show();
        },

        deleteConfirm(user_id) {
            if (this.hasPermission('delete_transaction')) {
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
                        this.deleteUser(user_id).then(() => {
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
                this.message403();
            }
        },

        getResults(page = 1) {
            this.getDpsTransactions(page);
        }
    },

    mounted() {
        this.getResults(1);
    }


})
</script>
