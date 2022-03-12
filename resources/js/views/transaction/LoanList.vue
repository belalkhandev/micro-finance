<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Loan Transaction List</h4>
                    </div>
                    <div class="box-action">
                        <router-link :to="{ name:'GenerateTransaction' }" class="btn btn-sm btn-primary">Generate Transaction</router-link>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tr. Date</th>
                            <th>Member</th>
                            <th>Acc. No</th>
                            <th>Loan Type</th>
                            <th>Deposit Amount.</th>
                            <th>Balance.</th>
                            <th>Tr. Day</th>
                            <th>Due Date</th>
                            <th>Issue Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterTransactions" v-for="(transaction, i) in filterTransactions" :key="transaction.id">
                            <td>{{ i+1 }}</td>
                            <td>{{ transaction.transaction_date }}</td>
                            <td>{{ transaction.member_name }}</td>
                            <td>{{ transaction.member_account_no }}</td>
                            <td>{{ transaction.transaction_type }}</td>
                            <td>{{ transaction.amount }}</td>
                            <td>{{ transaction.balance }}</td>
                            <td>{{ transaction.due_date }}</td>
                            <td>{{ transaction.balance }}</td>
                            <td>{{ transaction.created_at }}</td>
                            <td></td>
                        </tr>
                        <tr v-else>
                            <td colspan="10">No Transaction found</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    <p>Pagination here</p>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default ({
    name: "Index",
    components: {},

    data () {
        return {

        }
    },

    computed: {
        ...mapGetters({
            transactions: 'transaction/loan_transactions'
        }),

        filterTransactions() {
            return this.transactions;
        }
    },

    methods: {
        ...mapActions({
            getLoanTransactions: 'transaction/getLoanTransactions'
        }),

        deleteConfirm(user_id) {
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
        },
    },

    mounted() {
        this.getLoanTransactions();
    }


})
</script>
