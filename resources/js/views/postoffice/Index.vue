<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>PostOffice list</h4>
                    </div>
                    <div class="box-action">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createPostOfficeModal">Add new</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Name (Bangla)</th>
                            <th class="text-left">Code</th>
                            <th class="text-left">Upazila</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(post_office, i) in fetchPostOffices">
                            <td>{{ ++i }}</td>
                            <td>{{ post_office.name }}</td>
                            <td>{{ post_office.bn_name }}</td>
                            <td>{{ post_office.code }}</td>
                            <td>{{ post_office.upazilla_name }}</td>
                            <td>
                                <div class="action">
                                    <a href="#" class="text-orange-400" @click.prevent="showEditModal(post_office)"><i class="bx bx-edit"></i></a>
                                    <a href="#" class="text-red-400" @click.prevent="deleteConfirm(post_office.id)"><i class="bx bx-trash"></i></a>
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

    <!--  post_office update modal  -->
    <create></create>
    <!--  post_office update modal  -->
    <edit :post_office="edit_post_office_data"></edit>
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
            edit_post_office_data: null,
        }
    },

    computed: {
        ...mapGetters({
            post_offices: 'location/post_offices',
        }),

        fetchPostOffices() {
            return this.post_offices
        }
    },

    methods: {
        ...mapActions({
            getPostOffices: 'location/getPostOffice',
            deletePostOffice: 'location/deletePostOffice',
        }),

        showEditModal(data) {
            this.edit_post_office_data = data
            var editModal = new bootstrap.Modal(document.getElementById('editPostOfficeModal'));
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
                    this.deletePostOffice(item_id).then(() => {
                        if (!this.error_message) {
                            this.$swal({
                                icon: 'success',
                                title: 'Congratulation!',
                                text: 'Post office has been deleted successfully'
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
        this.getPostOffices();
    }


})
</script>
