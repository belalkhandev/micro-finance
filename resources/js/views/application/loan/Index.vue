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
                            <th>Member</th>
                            <th>Acc. No</th>
                            <th>Loan Amont</th>
                            <th>Service</th>
                            <th>Total Amount</th>
                            <th>DPS Type</th>
                            <th>Installment</th>
                            <th>Installment Amount</th>
                            <th>Balance</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterApplications" v-for="(application, i) in filterApplications" :key="i">
                            <td>{{ i+1 }}</td>
                            <td>{{ application.member_name }}</td>
                            <td>{{ application.member_account_no }}</td>
                            <td>{{ application.loan_amount }}</td>
                            <td>{{ application.service_amount }} ({{ application.service }}%)</td>
                            <td>{{ application.total_amount }}</td>
                            <td>{{ application.dps_type }}</td>
                            <td>{{ application.installment }}</td>
                            <td>{{ application.installment_amount }}</td>
                            <td>{{ application.balance }}</td>
                        </tr>
                        <tr v-else>
                            <td colspan="9">No application found</td>
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
            applications: 'loan/applications'
        }),

        filterApplications() {
            return this.applications;
        }
    },

    methods: {
        ...mapActions({
            getApplications: 'loan/getApplications'
        }),

        showEditModal(data) {

        },

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
        this.getApplications();
    }


})
</script>
