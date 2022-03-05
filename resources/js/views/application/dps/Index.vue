<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>DPS application list</h4>
                    </div>
                    <div class="box-action">
                        <router-link :to="{ name:'CreateDPS' }" class="btn btn-sm btn-primary">New DPS Application</router-link>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Member</th>
                            <th>Acc. No</th>
                            <th>Deposit</th>
                            <th>Year</th>
                            <th>Total Deposit</th>
                            <th>Total Receive</th>
                            <th>Profit</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-if="filterApplications">
                                <td></td>
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
            applications: 'dps/applications'
        }),

        filterApplications() {
            return this.applications;
        }
    },

    methods: {
        ...mapActions({
            getApplications: 'dps/getApplications'
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
