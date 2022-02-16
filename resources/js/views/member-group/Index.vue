<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Member Groups</h4>
                    </div>
                    <div class="box-action">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createGroupModal">Add new</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th class="text-left">Group Name</th>
                            <th class="text-left">Group No</th>
                            <th class="text-left">Day</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(group, i) in fetchGroups" :key="group.id">
                            <td>{{ ++i }}</td>
                            <td>{{ group.group_name }}</td>
                            <td>{{ group.group_no }}</td>
                            <td>{{ group.day }}</td>
                            <td>
                                <div class="action">
                                    <a href="#" class="text-orange-400" @click.prevent="showEditModal(group)"><i class="bx bx-edit"></i></a>
                                    <a href="#" class="text-red-400" @click.prevent="deleteConfirm(group.id)"><i class="bx bx-trash"></i></a>
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

    <!--  group update modal  -->
    <create></create>
    <!--  group update modal  -->
    <edit :group="group_data"></edit>
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
            group_data: null,
        }
    },

    computed: {
        ...mapGetters({
            groups: 'group/groups',
        }),

        fetchGroups() {
            return this.groups
        }
    },

    methods: {
        ...mapActions({
            getGroups: 'group/getGroups',
            deleteGroup: 'group/deleteGroup',
        }),

        showEditModal(data) {
            this.group_data = data
            var editModal = new bootstrap.Modal(document.getElementById('editGroupModal'));
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
                    this.deleteGroup(item_id).then(() => {
                        if (!this.error_message) {
                            this.$swal({
                                icon: 'success',
                                title: 'Congratulation!',
                                text: 'Group has been deleted successfully'
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
        this.getGroups();
    }


})
</script>
