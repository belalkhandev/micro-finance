<template>
    <div class="modal fade" id="createCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <form @submit.prevent="storeCategory">
                    <div class="modal-body">
                        <span class="text-danger" v-if="error">{{ error }}</span>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Category name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.name" placeholder="Category name" class="form-control">
                                    <span class="text-danger" v-if="errors">{{ errors.name ? errors.name[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Category Description (Optional)</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea v-model="form.description" rows="3" class="form-control" placeholder="Write description"></textarea>
                                    <span class="text-danger" v-if="errors">{{ errors.description ? errors.description[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">{{ $t('close') }}</button>
                            <button type="submit" class="ml-2 btn btn-primary" id="storeCategory">
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

export default ({
    name: "Create",

    data() {
        return {
            form: {
                name: "",
                description: "",
            },
            errors: null,
            error: null,
        }
    },

    computed: {
        ...mapGetters({
            validation_errors: 'validation_errors',
            error_message: 'error_message',
        }),
    },

    methods: {
        ...mapActions({
            createCategory: 'expenseCategory/createExpenseCategory',
        }),

        storeCategory() {
            $('#storeCategory').prop('disabled', true).addClass('submitted')

            let formData = new FormData();
            let inputData = this.form

            Object.keys(inputData).forEach(fieldName => {
                formData.append(fieldName, inputData[fieldName]);
            })

            this.createCategory(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    Object.assign(this.$data, this.$options.data.apply(this))

                    this.$swal({
                        icon: "success",
                        title: "Success!",
                        text: "Category has been stored successfully",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#storeCategory').prop('disabled', false).removeClass('submitted')
            })

        }
    }
})
</script>

