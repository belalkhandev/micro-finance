<template>
    <div class="box">
        <div class="box-header">
            <div class="box-title">
                <h4>Member list</h4>
            </div>
            <div class="box-action">
                <router-link :to="{name: 'CreateMember'}" class="btn btn-sm btn-primary">New member</router-link>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Account no</th>
                        <th>Name</th>
                        <th>Father/Spouse Name</th>
                        <th>Mother Name</th>
                        <th>Member Type</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(member, i) in fetchMembers" :key="i">
                        <td>{{ i+1 }}</td>
                        <td>{{ member.account_no }}</td>
                        <td>{{ member.name }}</td>
                        <td>{{ member.father_name }}</td>
                        <td>{{ member.mother_name }}</td>
                        <td v-if="member.member_type === 'deposit_weekly'" class="text-indigo-600">Weekly</td>
                        <td v-else-if="member.member_type === 'deposit_monthly'" class="text-green-600">Monthly</td>
                        <td v-else="member.member_type === 'loan'" class="text-indigo-600">Loan</td>
                        <td v-if="member.is_active" class="text-success">Active</td>
                        <td v-else class="text-danger">Inactive</td>
                        <td>
                            <div class="action">
                                <a href="#" class="btn btn-outline-primary btn-sm mr-1"><i class='bx bx-transfer-alt'></i></a>
                                <router-link :to="{ name:'MemberShow', params: { member_id: member.id }}" class="btn btn-outline-success btn-sm"><i class="bx bx-show"></i></router-link>
                                <router-link :to="{ name: 'EditMember', params:{member_id: member.id}}" class="btn btn-outline-danger btn-sm"><i class="bx bx-edit"></i></router-link>
                                <a href="#" class="btn btn-outline-warning btn-sm" @click.prevent="deleteConfirm(member.id)"><i class="bx bx-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer"></div>
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
            members: 'member/members'
        }),

        fetchMembers() {
            return this.members
        }
    },

    methods: {
        ...mapActions({
            getMembers: 'member/getMembers'
        }),

        showEditModal(data) {

        },

        deleteConfirm(user_id) {
            this.$swal({
                title:"Really want to delete!",
                text: "Are you sure? You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
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
        this.getMembers()
    }


})
</script>
