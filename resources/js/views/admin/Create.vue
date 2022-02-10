<template>
    <div class="modal fade" id="createUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Admin</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <form @submit.prevent="storeUser">
                    <div class="modal-body">
                        <p v-if="error" class="text-center"><span class="text-danger" >{{ error }}</span></p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Name *</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" v-model="form.name" placeholder="Name" class="form-control">
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.name ? errors.name[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Email *</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="email" v-model="form.email" placeholder="john@gmail.com" class="form-control">
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.email ? errors.email[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Phone</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" v-model="form.phone" placeholder="Phone" class="form-control">
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.phone ? errors.phone[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Password *</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="password" v-model="form.password" placeholder="Passwrod" class="form-control">
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.password ? errors.password[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Confirm Password *</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="password" v-model="form.password_confirmation" placeholder="Confirm Password" class="form-control">
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.password_confirmation ? errors.password_confirmation[0] : '' }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Role *</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" v-model="form.role_id">
                                        <option value="">Select</option>
                                        <option v-for="(role, i) in filterRoles" :value="role.id">{{ role.name }}</option>
                                    </select>
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.role_id ? 'Role is required' : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Photo</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="file" ref="photo" id="photo" @change="handlePhoto()" class="form-control">
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.photo ? errors.photo[0] : '' }}</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">{{ $t('close') }}</button>
                            <button type="submit" class="ml-2 btn btn-primary" id="storeUser">
                                <span>{{ $t('save') }}</span>
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";
import $ from 'jquery'

export default ({
    name: "Create",

    data() {
        return {
            form: {
                name: "",
                email: "",
                phone: "",
                password: "",
                password_confirmation: "",
                role_id: "",
                photo: null
            },
            errors: null,
            error: null,
        }
    },

    computed: {
        ...mapGetters({
            roles: 'user/roles',
            validation_errors: 'validation_errors',
            error_message: 'error_message',
        }),

        filterRoles(){
            return this.roles
        },
    },

    methods: {
        ...mapActions({
            getRoles: 'user/getRoles',
            createUser: 'user/createUser',
        }),

        handlePhoto(){
            this.form.photo = this.$refs.photo.files[0];
        },

        storeUser() {
            $('#storeUser').prop('disabled', true).addClass('submitted')

            let formData = new FormData();
            let inputData = this.form

            Object.keys(inputData).forEach(fieldName => {
                formData.append(fieldName, inputData[fieldName]);
            })

            this.createUser(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    Object.assign(this.$data, this.$options.data.apply(this))

                    this.$swal({
                        icon: "success",
                        title: "Success!",
                        text: "Admin has been stored successfully",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#storeUser').prop('disabled', false).removeClass('submitted')
            })

        }
    },

    mounted() {
        this.getRoles();
    },
})
</script>

