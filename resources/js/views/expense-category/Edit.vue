<template>
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Category</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <form @submit.prevent="updateCategory">
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
                            <button type="submit" class="ml-2 btn btn-primary" id="updateCategory">
                                <span>{{ $t('update') }}</span>
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

    props: {
        category: Object
    },

    data() {
        return {
            form: {
                category_id: "",
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
            editCategory: 'expenseCategory/editExpenseCategory',
        }),

        updateCategory() {
            $('#updateCategory').prop('disabled', true).addClass('submitted')

            let formData = this.form

            this.editCategory(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;

                    this.$swal({
                        icon: "success",
                        title: "Updated!",
                        text: "Category has been updated successfully",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#updateCategory').prop('disabled', false).removeClass('submitted')
            })

        }
    },

    watch: {
        category() {
            if (this.category) {
                this.form.category_id = this.category.id;
                this.form.name = this.category.name;
                this.form.description = this.category.description;
            }
        }
    }
})
</script>

