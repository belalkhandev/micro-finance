<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Village list</h4>
                    </div>
                    <div class="box-action">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createVillageModal">Add new</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Name (Bangla)</th>
                            <th class="text-left">Union</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(village, i) in fetchVillages" :key="village.id">
                            <td>{{ ++i }}</td>
                            <td>{{ village.name }}</td>
                            <td>{{ village.bn_name }}</td>
                            <td>{{ village.union_name }}</td>
                            <td>
                                <div class="action">
                                    <a href="#" class="text-orange-400" @click.prevent="showEditModal(village)"><i class="bx bx-edit"></i></a>
                                    <a href="#" class="text-red-400" @click.prevent="deleteConfirm(village.id)"><i class="bx bx-trash"></i></a>
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
    <edit :village="edit_village_data"></edit>
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
            edit_village_data: null,
        }
    },

    computed: {
        ...mapGetters({
            villages: 'location/villages',
        }),

        fetchVillages() {
            return this.villages
        }
    },

    methods: {
        ...mapActions({
            getVillages: 'location/getVillages',
            deleteVillage: 'location/deleteVillage',
        }),

        showEditModal(data) {
            this.edit_village_data = data
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
