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
                        <th>Name</th>
                        <th>Account No</th>
                        <th>Member Type</th>
                        <th>Father Name</th>
                        <th>Village</th>
                        <th>Address</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(member, i) in fetchMembers" :key="i">
                        <td>{{ i+1 }}</td>
                        <td>{{ member.name }}</td>
                        <td>{{ member.account_no }}</td>
                        <td>{{ member.member_type }}</td>
                        <td>{{ member.father_name }}</td>
                        <td>{{ member.village_id }}</td>
                        <td>{{ member.address }}</td>
                        <td></td>
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
