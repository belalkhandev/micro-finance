<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Expense list</h4>
                    </div>
                    <div class="box-action">
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createExpenseModal">Add new</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th class="text-left">E. Date</th>
                            <th class="text-left">Head</th>
                            <th class="text-left">Category</th>
                            <th class="text-left">Type</th>
                            <th class="text-left">Amount</th>
                            <th class="text-left"></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(expense, i) in fetchExpenses" :key="village.id">
                            <td>{{ i+1 }}</td>
                            <td>{{ expense.title }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    <p>Pagination here</p>
                </div>
            </div>
        </div>
    </div>

    <!--  expense update modal  -->
    <create></create>
    <!--  village update modal  -->
    <edit :expense="edit_expense_data"></edit>
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
            edit_expense_data: null,
        }
    },

    computed: {
        ...mapGetters({
            expenses: 'expense/expenses',
        }),

        fetchExpenses() {
            return this.expenses
        }
    },

    methods: {
        ...mapActions({
            getExpenses: 'expense/getExpenses',
            deleteExpense: 'expense/deleteExpense',
        }),

        showEditModal(data) {
            this.edit_expense_data = data
            var editModal = new bootstrap.Modal(document.getElementById('editExpenseModal'));
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
        this.getExpenses();
    }


})
</script>
