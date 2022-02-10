<template>
    <div class="row">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header bg-indigo-400">
                    <div class="box-title">
                        <h5 class="text-white">Profile</h5>
                    </div>
                </div>
                <div class="box-body">
                    <div class="profile" v-if="user">
                        <div class="user-box">
                            <img v-if="user.profile && user.profile.photo" :src="user.profile.photo" alt="User photo">
                            <img src="../../assets/images/user.png" alt="">
                            <div class="mb-3 mt-3">
                                <h3>{{ user.name }}</h3>
                                <h5 class="text-indigo-600">{{user.role_name }}</h5>
                            </div>
                            <button type="button" class="btn btn-sm btn-warning">Edit Profile</button>
                            <button type="button" class="btn btn-sm btn-danger">Deactive Account</button>
                        </div>
                        <div class="user-info">
                            <table class="table table-borderless">
                                <tbody>

                                <tr>
                                    <th>Name</th>
                                    <td class="py-2">:</td>
                                    <td>{{ user.name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td class="py-2">:</td>
                                    <td>{{ user.email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td class="py-2">:</td>
                                    <td>{{ user.phone }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td class="py-2">:</td>
                                    <td>{{ user.profile ? user.profile.gender : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td class="py-2">:</td>
                                    <td>{{ user.profile ? user.profile.address : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Birthdate</th>
                                    <td class="py-2">:</td>
                                    <td>{{ user.profile ? user.profile.birthdate : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Account Status</th>
                                    <td class="py-2">:</td>
                                    <td>
                                        <strong v-if="user.is_active" class="text-green-600">
                                            Active
                                        </strong>
                                        <strong v-else="user.is_active" class="text-red-600">Deactivate</strong>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions} from 'vuex'

export default({
    name: 'AdminProfile',
    data() {
        return {
            user_id: this.$route.params.admin_id
        }
    },

    computed: {
        ...mapGetters ({
            users: 'user/users'
        }),

        user() {
            if (this.users && this.user_id) {
                return this.users.find(user => user.id == this.user_id)
            }
        }
    },

    methods: {
        ...mapActions({
            getUsers: 'user/getUsers'
        })
    },

    mounted() {
        if (!this.users) {
            this.getUsers();
        }
    }


})
</script>
