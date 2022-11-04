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
                        <div class="row">
                            <div class="col-md-5">
                                <div class="user-box mb-4">
                                    <img v-if="user.profile && user.profile.photo" :src="user.profile.photo" alt="User photo">
                                    <img src="../../assets/images/user.png" alt="">
                                    <div class="mb-3 mt-3">
                                        <h3>{{ user.name }}</h3>
                                        <h5 class="text-indigo-600">{{ user.role_name }}</h5>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-warning">Edit Profile</button>
                                    <button type="button" class="btn btn-sm btn-danger">Deactive Account</button>
                                </div>
                            </div>
                            <div class="col-md-7">
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
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header bg-zinc-400">
                    <div class="box-title">
                        <h5 class="text-white">Password & Security</h5>
                    </div>
                </div>
                <form @submit.prevent="changePassword">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" v-model="form.current_password" placeholder="Current password" class="form-control">
                            <span class="text-danger text-sm" v-if="errors">{{ errors.current_password ? errors.current_password[0] : '' }}</span>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" v-model="form.password" placeholder="New password" class="form-control">
                            <span class="text-danger text-sm" v-if="errors">{{ errors.password ? errors.password[0] : '' }}</span>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" v-model="form.password_confirmation" placeholder="Confirm password" class="form-control">
                            <span class="text-danger text-sm" v-if="errors">{{ errors.password_confirmation ? errors.password_confirmation[0] : '' }}</span>
                        </div>
                    </div>
                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-sm btn-primary" id="updatePassword">
                            <span>Update Password</span>
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions} from 'vuex'
import $ from "jquery";


export default({
    name: 'Profile',
    data() {
        return {
            form: {
                current_password: "",
                password:"",
                password_confirmation:"",
            },
            errors: null,
            error: null,
        }
    },
    computed: {
        ...mapGetters ({
            user: 'auth/user',
            validation_errors: 'validation_errors',
            error_message: 'error_message',
        })
    },

    methods: {
        ...mapActions({
            updatePassword: 'auth/changePassword'
        }),

        changePassword() {
            $('#updatePassword').prop('disabled', true).addClass('submitted')
            let formData = new FormData();
            let inputData = this.form

            Object.keys(inputData).forEach(fieldName => {
                formData.append(fieldName, inputData[fieldName]);
            });

            this.updatePassword(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    Object.assign(this.$data, this.$options.data.apply(this))

                    this.$swal({
                        icon: "success",
                        title: "Updated!",
                        text: "Password has been updated successfully",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#updatePassword').prop('disabled', false).removeClass('submitted')
            })
        }
    }

})
</script>
