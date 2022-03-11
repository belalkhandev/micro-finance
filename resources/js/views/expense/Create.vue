<template>
    <div class="modal fade" id="createExpenseModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Expense</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <form @submit.prevent="storeExpense">
                    <div class="modal-body">
                        <p v-if="error" class="text-center"><span class="text-danger" >{{ error }}</span></p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Expense Category *</label>
                                </div>
                                <div class="col-md-7">
                                    <input list="categories" v-model="category" class="form-control" placeholder="Category">
                                    <datalist id="categories">
                                        <option value="Test one" />
                                        <option value="Test two" />
                                        <option value="Test three" />
                                        <option v-for="category in filterCategories" :key="category.id" :value="category.name"/>
                                    </datalist>
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.category ? 'Category is required' : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Expense Types</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" v-model="form.expense_type">
                                        <option value="regular">Regular</option>
                                        <option value="assets">Assets</option>
                                        <option value="liabilities">Liabilities</option>
                                    </select>
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.expense_type ? 'Expense type is required' : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Expense title (optional)</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" v-model="form.custom_title" placeholder="Expense title" class="form-control">
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.custom_title ? errors.custom_title[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Description</label>
                                </div>
                                <div class="col-md-7">
                                    <textarea v-model="form.description" rows="3" class="form-control" placeholder="Write description"></textarea>
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.description ? errors.description[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Expense Amount</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" v-model="form.amount" placeholder="0.00" class="form-control">
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.amount ? errors.amount[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="col-form-label">Expense Date</label>
                                </div>
                                <div class="col-md-7">
                                    <Datepicker v-model="expense_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select Date"/>
                                </div>
                                <span class="text-danger text-sm text-right" v-if="errors">{{ errors.expense_date ? errors.expense_date[0] : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">{{ $t('close') }}</button>
                            <button type="submit" class="ml-2 btn btn-primary" id="storeExpense">
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
import Datepicker from "vue3-date-time-picker";
import moment from 'moment'
import {ref} from "vue";

export default ({
    name: "Create",
    setup() {
        const date = ref(new Date());
        return {
            date
        }
    },

    components: {
        Datepicker
    },

    data() {
        return {
            form: {
                category: "",
                custom_title: "",
                description: "",
                amount: "",
                expense_date: "",
                expense_type: "regular",
            },
            expense_date: "",
            errors: null,
            error: null,
        }
    },

    computed: {
        ...mapGetters({
            categories: 'expenseCategory/expense_categories',
            validation_errors: 'validation_errors',
            error_message: 'error_message',
        }),

        filterCategories(){
            return this.categories
        },
    },

    methods: {
        ...mapActions({
            getCategories: 'expenseCategory/getExpenseCategories',
            createExpense: 'expense/createExpense',
        }),

        storeExpense() {
            $('#storeExpense').prop('disabled', true).addClass('submitted')

            let formData = new FormData();
            let inputData = this.form

            Object.keys(inputData).forEach(fieldName => {
                formData.append(fieldName, inputData[fieldName]);
            })

            this.createExpense(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    Object.assign(this.$data, this.$options.data.apply(this))

                    this.$swal({
                        icon: "success",
                        title: "Success!",
                        text: "Expense has been saved successfully",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#storeExpense').prop('disabled', false).removeClass('submitted')
            })

        }
    },

    mounted() {
        this.getCategories();
    },

    watch: {
        expense_date: function () {
            this.form.expense_date = moment(this.expense_date).format("L");
        }
    }
})
</script>

