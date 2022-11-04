<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Expense Category</h4>
                    </div>
                    <div class="box-action">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">Add new</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Description</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(category, i) in fetchCategories" :key="category.id">
                            <td>{{ ++i }}</td>
                            <td>{{ category.name }}</td>
                            <td>{{ category.description }}</td>
                            <td>
                                <div class="action">
                                    <a href="#" class="text-orange-400" @click.prevent="showEditModal(category)"><i class="bx bx-edit"></i></a>
                                    <a href="#" class="text-red-400" @click.prevent="deleteConfirm(category.id)"><i class="bx bx-trash"></i></a>
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

    <!--  category create modal  -->
    <create></create>
    <!--  category update modal  -->
    <edit :category="category_data"></edit>
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
            category_data: null,
        }
    },

    computed: {
        ...mapGetters({
            categories: 'expenseCategory/expense_categories',
        }),

        fetchCategories() {
            return this.categories
        }
    },

    methods: {
        ...mapActions({
            getCategories: 'expenseCategory/getExpenseCategories',
            deleteCategories: 'expenseCategory/deleteExpenseCategory',
        }),

        showEditModal(data) {
            this.category_data = data
            var editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
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
                    this.deleteCategories(item_id).then(() => {
                        if (!this.error_message) {
                            this.$swal({
                                icon: 'success',
                                title: 'Congratulation!',
                                text: 'Expense category has been deleted successfully'
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
        this.getCategories();
    }


})
</script>
