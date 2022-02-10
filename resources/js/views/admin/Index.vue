<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Admin list</h4>
                    </div>
                    <div class="box-action">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createAdminModal">Add new</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Photo</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Phone</th>
                            <th class="text-left">Role</th>
                            <th class="text-left">Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(admin, i) in filterAdmins" :key="admin.id">
                            <td>{{ ++i }}</td>
                            <td>
                                <div class="action">
                                    <a href="#" class="text-orange-400" @click.prevent="showEditModal(admin)"><i class="bx bx-edit"></i></a>
                                    <a href="#" class="text-red-400" @click.prevent="deleteConfirm(admin.id)"><i class="bx bx-trash"></i></a>
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
            villages: 'location/villages',
        }),

        filterAdmins() {
            return this.villages
        }
    },

    methods: {
        ...mapActions({
            getVillages: 'location/getVillages',
            deleteVillage: 'location/deleteVillage',
        }),

        showEditModal(data) {
            this.edit_admin = data
            var editModal = new bootstrap.Modal(document.getElementById('editVillageModal'));
            editModal.show();
        },

        deleteConfirm(item_id) {
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
                    this.deleteVillage(item_id).then(() => {
                        if (!this.error_message) {
                            this.$swal({
                                icon: 'success',
                                title: 'Congratulation!',
                                text: 'Village has been deleted successfully'
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
        this.getVillages();
    }


})
</script>
