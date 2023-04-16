<template>
    <div class="widget widget-secondary mb-4" v-if="openFilter">
        <div class="widget-header">
            <h5 class="title">Filtering</h5>
            <span>
                <i class='bx bx-filter-alt'></i>
            </span>
        </div>
        <div class="widget-body">
            <form @submit.prevent="filterSubmit">
                <div class="row">
                    <div class="col-md-3" v-if="fetchCategories">
                        <select v-model="form.category_id" class="form-control">
                            <option value="">Select expense category</option>
                            <option v-for="(category, i) in fetchCategories" :value="category.id">{{ category.name }}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <Datepicker v-model="from_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select From Date"/>
                    </div>
                    <div class="col-md-3">
                        <Datepicker v-model="to_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select To Date"/>
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-sm btn-success">Filter</button>
                        <button v-if="is_filter_pagination" type="button" @click.prevent="clearFilterForm" class="btn btn-sm btn-danger ml-2">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h4>Expenses reports</h4>
                    </div>
                    <div class="box-action">
                        <button type="button" class="btn btn-sm btn-secondary" @click="openFilter = !openFilter">Filter</button>
                        <button class="btn btn-sm btn-primary" @click="downloadSavingsApplicationsReport">Download</button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th class="text-left">Expense Date</th>
                            <th class="text-left">Title</th>
                            <th class="text-left">Category</th>
                            <th class="text-left">Type</th>
                            <th class="text-left">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="filterExpenses && filterExpenses.data" v-for="(expense, i) in filterExpenses.data" :key="i">
                            <td>{{ filterExpenses.from+i }}</td>
                            <td>{{ userFormattedDate(expense.expense_date) }}</td>
                            <td>{{ expense.title }}</td>
                            <td>{{ expense.category_name }}</td>
                            <td>{{ expense.expense_type }}</td>
                            <td>{{ numberFormat(expense.amount) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    <!-- pagination -->
                    <div class="pagination" v-if="filterExpenses">
                        <p class="pagination-data">
                            Page {{ filterExpenses.current_page }} Showing  {{ filterExpenses.from }} to {{ filterExpenses.to }} of {{ filterExpenses.total }} Data
                        </p>
                        <Pagination :data="filterExpenses" @pagination-change-page="getResults" :limit="6"/>
                    </div>
                    <!-- end pagination -->
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import LaravelVuePagination from 'laravel-vue-pagination';

export default ({
    name: "SavingsTransactionsReport",

    components: {
        'Pagination': LaravelVuePagination
    },

    data() {
        return {
            is_filter_pagination: false,
            form: {
                from_date: '',
                to_date: '',
                category_id: '',
                status: ''
            },
            from_date: '',
            to_date: '',
            member_input_text: "",
            search_key: "",
            isOpen: false,
            openFilter: false
        }
    },

    computed: {
        ...mapGetters({
            expenses: 'expense/expenses',
            categories: 'expenseCategory/expense_categories',
        }),

        filterExpenses() {
            return this.expenses;
        },


        fetchCategories() {
            return this.categories;
        }
    },

    methods: {
        ...mapActions({
            getExpenses: 'expense/getExpenses',
            getExpenseCategories: 'expenseCategory/getExpenseCategories',
            getFilteredExpenses: 'expense/filterExpenses'
        }),

        getResults(page = 1) {
            if (!this.is_filter_pagination) {
                this.getExpenses(page);
            } else {
                let formData = this.form;
                formData.page = page
                this.getFilteredExpenses(formData)
            }
        },


        filterSubmit() {
            this.is_filter_pagination = true;
            this.getFilteredExpenses(this.form)
        },

        clearFilterForm() {
            this.is_filter_pagination = false;
            this.getResults(1);
            this.form.category_id = '';
            this.form.from_date = '';
            this.form.to_date = '';
            this.form.status = '';
            this.member_input_text = '';
            this.from_date='';
            this.to_date='';
        },

        downloadSavingsApplicationsReport() {
            let filterQuery = '';

            if (this.form.category_id) {
                filterQuery += `?category_id=${this.form.category_id}`;
            }

            if (this.form.from_date) {
                filterQuery += `${filterQuery ? '&' : '?'}from_date=${this.form.from_date}`;
            }

            if (this.form.to_date) {
                filterQuery += `${filterQuery ? '&' : '?'}to_date=${this.form.to_date}`;
            }

            window.open(`${window.location.origin}/download/expenses${filterQuery}`);
        },
    },

    mounted() {
        this.getResults(1);
        this.getExpenseCategories();
    },

    watch: {
        from_date: function () {
            let fromDate = this.datePickerFormat(this.from_date);
            this.form.from_date = fromDate != 'Invalid date' ? fromDate : '';
        },

        to_date: function () {
            let toDate = this.datePickerFormat(this.to_date);
            this.form.to_date = toDate != 'Invalid date' ? toDate : '';
        }
    }


})
</script>
<style>
.btn.btn-sm.btn-outline-info.btn-text {
    line-height: 1;
}
.member-select .member-list {
    z-index: 999;
}

.widget .widget-body p {
    color: #000;
}
</style>

