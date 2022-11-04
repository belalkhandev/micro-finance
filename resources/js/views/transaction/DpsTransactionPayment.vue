<template>
    <div class="modal fade" id="dpsTransactionPayment" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dps Collection</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <form @submit.prevent="updateDpsTransaction">
                    <div class="modal-body" v-if="transaction">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Transaction No</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.transaction_no" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Member</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.member" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Account No</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.account_no" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Amount</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.amount" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Balance</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.balance" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Transaction Date</label>
                                </div>
                                <div class="col-md-8">
                                    <Datepicker v-model="transaction_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select Date"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Transaction Status</label>
                                </div>
                                <div class="col-md-8">
                                    <select v-model="form.payment_status" class="form-control">
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unapaid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-right">
                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">{{ $t('close') }}</button>
                            <button type="submit" class="ml-2 btn btn-primary btn-sm" id="updateDpsTransaction">
                                <span>{{ $t('collect') }}</span>
                                <div class="spinner-border" role="status">
                                    <span class="visuaNlly-hidden">Loading...</span>
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
import {helpers} from "../../mixin";

export default ({
    name: "DpsTransactionPayment",
    props: {
        transaction: Object
    },
    data() {
        return {
            form: {
                transaction_id: "",
                transaction_no: "",
                member: "",
                account_no: "",
                transaction_date: "",
                transaction_status: "",
                amount: "",
                balance: "",
                payment_status: "paid",
            },
            transaction_date: this.datePickerFormat(new Date())
        }
    },

    mixins: [helpers],

    computed: {
        ...mapGetters({
            validation_errors: 'validation_errors',
            error_message: 'error_message',
        }),
    },

    methods: {
        ...mapActions({
            createDpsCollection: "transaction/collectDpsTransaction"
        }),

        updateDpsTransaction() {
            $('#updateDpsTransaction').prop('disabled', true).addClass('submitted')

            let formData = this.form;

            this.createDpsCollection(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    this.$swal({
                        icon: "success",
                        title: "Updated!",
                        text: "Dps transaction collection has been success",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#updateDpsTransaction').prop('disabled', false).removeClass('submitted')
            })

        }
    },

    watch: {
        transaction() {
            if (this.transaction) {
                this.form.transaction_id = this.transaction.id
                this.form.transaction_no = this.transaction.transaction_no
                this.form.member = this.transaction.member_name
                this.form.account_no = this.transaction.member_account_no
                this.form.transaction_date = this.transaction.transaction_date
                this.form.amount = this.transaction.amount
                this.form.balance = this.transaction.balance
                this.transaction_date = this.datePickerFormat(new Date())
            }
        },

        transaction_date: function () {
            this.form.transaction_date = this.datePickerFormat(this.transaction_date)
        }
    }
})
</script>
