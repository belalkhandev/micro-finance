<template>
    <div class="modal fade" id="savingsCreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Savings Transaction Create</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <form @submit.prevent="submitSavingForm">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Savings Type</label>
                            <div class="col-md-8">
                                <select class="form-select form-control" v-model="form.savings_type" required>
                                    <option value="">Select Type</option>
                                    <option value="deposit">Deposit</option>
                                    <option v-if="pre_balance > 0" value="withdraw">Withdraw</option>
                                </select>
                                <span class="text-danger" v-if="errors && errors['savings_type']">{{ errors['savings_type'] }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Amount</label>
                            <div class="col-md-8">
                                <input type="number" v-model="form.amount" class="form-control" placeholder="0.00" @keyup="savingsAmount()" required :readonly="!form.savings_type">
                                <span class="text-danger" v-if="errors && errors['amount']">{{ errors['amount'] }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Savings Balance (Current)</label>
                            <div class="col-md-8">
                                <input type="text" placeholder="0.00" v-model="pre_balance" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Savings Balance (New)</label>
                            <div class="col-md-8">
                                <input type="text" placeholder="0.00" v-model="new_balance" class="form-control"  readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Remarks</label>
                            <div class="col-md-8">
                                <textarea name="" class="form-control" rows="3" placeholder="Write remarks"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right">
                        <button type="submit" class="ml-2 btn btn-primary" id="storeSavings">
                            <span>{{ $t('submit') }}</span>
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import $ from "jquery";

export default {
    name: "CreateSavings",
    props: {
        member: Object
    },

    data() {
        return {
            form: {
                member_id: this.member.id,
                amount: "",
                savings_type: "",
                remarks: ""
            },

            pre_balance: this.member.deposit_savings_sum_amount - this.member.withdraw_savings_sum_amount,
            new_balance: 0,

            errors: null,
            error: null
        }
    },

    computed: {
        ...mapGetters({
            validation_errors: 'validation_errors',
            error_message: 'error_message'
        })
    },

    methods: {
        ...mapActions({
            createSaving: 'savings/createSaving',
        }),

        //calculate saving
        savingsAmount() {
            if(this.form.savings_type && this.form.savings_type === 'deposit') {
                this.new_balance = this.pre_balance + this.form.amount;
            } else if (this.form.savings_type && this.form.savings_type === 'withdraw') {
                if (this.form.amount <= this.pre_balance) {
                    this.new_balance = this.pre_balance - this.form.amount;
                } else {
                    this.$swal({
                       icon: 'warning',
                       title: 'Withdraw amount is not correct',
                       timer: 3000
                    }).then(() => {
                        this.form.amount = 0;
                    });
                }
            } else {
                this.form.amount = 0;
                this.new_balance = 0;
            }
        },

        //submit saving form
        submitSavingForm(event) {
            $('#storeSavings').prop('disabled', true).addClass('submitted')

            this.createSaving(this.form).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    this.$swal({
                        icon: "success",
                        title: "Success!",
                        text: "Savings has been saved",
                        timer: 3000
                    }).then(() => {
                        this.form.savings_type = "";
                        this.form.amount = 0;
                        this.pre_balance = this.new_balance;
                        this.form.remarks = "";
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#storeSavings').prop('disabled', false).removeClass('submitted')
            });
        }
    },
}
</script>

<style scoped>

</style>
