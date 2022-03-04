<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Admin list</h4>
                    </div>
                    <div class="box-action">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">Add new</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Photo</th>
                            <th class="text-left">Phone</th>
                            <th class="text-left">Role</th>
                            <th class="text-left">Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(admin, i) in filterAdmins" :key="admin.id">
                            <td>{{ ++i }}</td>
                            <td>{{ admin.name }}</td>
                            <td>
                                <img v-if="admin.profile && admin.profile.photo" :src="admin.profile.photo" alt="" class="w-8">
                                <spa v-else>No photo</spa>
                            </td>
                            <td>{{ admin.phone && admin.phone != 'null' ? admin.phone : '' }}</td>
                            <td>{{ admin.role_name }}</td>
                            <td>{{ admin.is_active ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <div class="action">
                                    <router-link :to="{ name:'ShowAdmin', params: { admin_id: admin.id }}" class="btn btn-outline-success btn-sm">
                                        <i class="bx bx-show"></i>
                                    </router-link>
                                    <a href="#" class="btn btn-outline-danger btn-sm" @click.prevent="showEditModal(admin)"><i class="bx bx-edit"></i></a>
                                    <a href="#" class="btn btn-outline-warning btn-sm" @click.prevent="deleteConfirm(admin.id)"><i class="bx bx-trash"></i></a>
                                </div>
                            </td>
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

    <!--  village update modal  -->
    <create></create>
    <!--  village update modal  -->
    <edit :admin="edit_admin"></edit>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Create from "./Create";
import Edit from "./Edit";
import bootstrap from 'bootstrap/dist/js/bootstrap'

export default ({
    name: "Index",
    components: {
        Create, Edit
    },

    data () {
        return {
            edit_admin: null,
        }
    },

    computed: {
        ...mapGetters({
            admins: 'user/users',
        }),

        filterAdmins() {
            return this.admins
        }
    },

    methods: {
        ...mapActions({
            getUsers: 'user/getUsers',
            deleteUser: 'user/deleteUser'
        }),

        showEditModal(data) {
            this.edit_admin = data
            var editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            editModal.show();
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
        this.getUsers();
    }


})
</script>
