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
                        <tr v-for="(expense, i) in fetchExpenses" :key="expense.id">
                            <td>{{ per_page*(page-1)+(i+1) }}</td>
                            <td>{{ userFormattedDate(expense.expense_date) }}</td>
                            <td>{{ expense.title }}</td>
                            <td>{{ expense.category_name }}</td>
                            <td>{{ expense.expense_type }}</td>
                            <td>{{ numberFormat(expense.amount) }}</td>
                            <td>
                                <div class="action">
                                    <a href="#" class="btn btn-outline-primary btn-sm mr-1" @click.prevent="showEditModal(expense)"><i class="bx bx-edit"></i></a>
                                    <a href="#" class="btn btn-outline-danger btn-sm" @click.prevent="deleteConfirm(expense.id)"><i class="bx bx-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    <!-- pagination -->
                    <div class="pagination" v-if="expenses && expenses.length > per_page">
                        <p class="pagination-data">
                            Page no {{ page }} Show {{ page === pages.length ? (expenses ? expenses.length : 0) : page*(fetchExpenses ? fetchExpenses.length : 0) }} of {{ expenses ? expenses.length : 0 }} Data
                        </p>
                        <ul>
                            <li class="page-item">
                                <button class="page-link" @click="page = 1" data-toggle="tooltip" data-placement="bottom" title="First Page"><i class="bx bx-chevrons-left"></i></button>
                            </li>
                            <li class="page-item">
                                <button class="page-link" v-if="page !== 1" @click="page--" data-toggle="tooltip" data-placement="bottom" title=""><i class="bx bx-chevron-left"></i></button>
                            </li>
                            <li class="page-item">
                                <button type="button" class="page-link" v-for="pageNumber in pages.slice(page-1, page+10)" :class="page===pageNumber ? 'active': ''" :key="pageNumber" @click="page = pageNumber"> {{ pageNumber}} </button>
                            </li>
                            <li class="page-item">
                                <button type="button" @click="page++" v-if="page < pages.length" class="page-link"> <i class="bx bx-chevron-right"></i> </button>
                            </li>
                            <li class="page-item">
                                <button class="page-link"  @click="page = pages.length" data-toggle="tooltip" data-placement="bottom" title="Last Page"><i class="bx bx-chevrons-right"></i></button>
                            </li>
                        </ul>
                    </div>
                    <!-- end pagination -->
                </div>
            </div>
        </div>
    </div>

    <!--  expense update modal  -->
    <create></create>
    <!--  expense update modal  -->
    <edit :expense="edit_expense_data"></edit>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Create from "./Create";
import Edit from "./Edit";
import bootstrap from 'bootstrap/dist/js/bootstrap'
import {helpers} from "../../mixin";

export default ({
    name: "Index",
    components: {
        Create, Edit
    },

    mixins: [helpers],

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
            if (this.expenses) {
                return this.paginate(this.expenses);
            }
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
                    this.deleteExpense(item_id).then(() => {
                        if (!this.error_message) {
                            this.$swal({
                                icon: 'success',
                                title: 'Congratulation!',
                                text: 'Expense has been deleted successfully'
                            })
                        }else {
                            this.error = this.error_message
                        }
                    })
                }
            });
        },

        // pagination set pages
        setPages() {
            let numberOfPages = Math.ceil(this.expenses ? this.expenses.length / this.per_page : 0);
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },

    },

    mounted() {
        if (!this.expenses) {
            this.getExpenses().then(() => {
                this.setPages();
            })
        }
    }


})
</script>
