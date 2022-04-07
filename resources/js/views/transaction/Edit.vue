<template>
    <div class="modal fade" id="editPostOfficeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Loan Transaction</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <form @submit.prevent="updatePostOffice">
                    <div class="modal-body">
                        <span class="text-danger" v-if="error">{{ error }}</span>

                    </div>
                    <div class="modal-footer">
                        <div class="text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">{{ $t('close') }}</button>
                            <button type="submit" class="ml-2 btn btn-primary" id="updatePostOffice">
                                <span>{{ $t('save_change') }}</span>
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
    name: "Edit",
    props: {
        transaction: Object
    },
    data() {
        return {
            form: {

            },
        }
    },

    computed: {
        ...mapGetters({
            transactions: 'transaction/loan_transactions',
            validation_errors: 'validation_errors',
            error_message: 'error_message',
        }),
    },

    methods: {
        ...mapActions({

        }),

        updatePostOffice() {
            $('#updatePostOffice').prop('disabled', true).addClass('submitted')

            let formData = this.form;

            this.editPostOffice(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;

                    this.$swal({
                        icon: "success",
                        title: "Updated!",
                        text: "PostOffice has been updated successfully",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#updatePostOffice').prop('disabled', false).removeClass('submitted')
            })

        }
    },

    mounted() {

    },

    watch: {
        transaction() {
            if (this.transaction) {
                //console.log(this.transaction)
            }
        },
    }
})
</script>

