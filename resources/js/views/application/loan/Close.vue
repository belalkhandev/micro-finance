<template>
    <div class="row" v-if="application && !isLoading">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>Loan Application Close</h5>
                    </div>
                    <div class="box-action">
                        <router-link :to="{ name: 'ShowLoanApplication', params:{application_id: application.id}}" class="btn btn-outline-primary btn-sm">Back</router-link>
                    </div>
                </div>
                <div class="box-body">
                    <form @submit.prevent="closeLoanSubmit">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Loan amount</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" v-model="form.loan_amount" placeholder="0.00" class="form-control" readonly>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.loan_amount ? errors.loan_amount[0] : '' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Service amount in {{ application.service }}%</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" v-model="form.service_amount" placeholder="0.00" class="form-control" readonly>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.service_amount ? errors.service_amount[0] : '' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Payable loan amount</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" v-model="form.payable_loan_amount" placeholder="0.00" class="form-control" readonly>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.payable_loan_amount ? errors.payable_loan_amount[0] : '' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Early payment discount</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" v-model="form.early_payment_discount" placeholder="0.00" class="form-control" @keyup="handleEarlyPayment">
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.early_payment_discount ? errors.early_payment_discount[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Beginning Balance</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" v-model="form.beginning_balance" placeholder="0.00" class="form-control" readonly>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.beginning_balance ? errors.beginning_balance[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Payable amount</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" v-model="form.payable_amount" placeholder="0.00" class="form-control" readonly>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.payable_amount ? errors.payable_amount[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Payment</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" v-model="form.payment" placeholder="0.00" class="form-control">
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.payment ? errors.payment[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Payment method</label>
                                </div>
                                <div class="col-md-7">
                                    <div class="select-wrap">
                                        <select v-model="form.payment_method" class="form-control">
                                            <option value="">Select</option>
                                            <option value="cash">Cash</option>
                                            <option value="mobile_banking">Mobile banking</option>
                                            <option value="bank">Bank</option>
                                        </select>
                                    </div>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.payment_method ? errors.payment_method[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Payment channel</label>
                                </div>
                                <div class="col-md-7">
                                    <input v-model="form.payment_channel" placeholder="e.g: Bkash, Sonali  bank , Cash" class="form-control"/>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.payment_channel ? errors.payment_channel[0] : '' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" v-if="form.payment_method === 'mobile_banking'">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Transaction No</label>
                                </div>
                                <div class="col-md-7">
                                    <input v-model="form.transaction_no" placeholder="transaction no" class="form-control"/>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.transaction_no ? errors.transaction_no[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" v-if="form.payment_method === 'bank'">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Cheque No</label>
                                </div>
                                <div class="col-md-7">
                                    <input v-model="form.cheque_no" placeholder="cheque no" class="form-control"/>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.cheque_no ? errors.cheque_no[0] : '' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Note</label>
                                </div>
                                <div class="col-md-7">
                                    <textarea v-model="form.note" placeholder="Write note..." class="form-control"></textarea>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.note ? errors.note[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" id="closeApplication">
                                <span>Submit</span>
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>DPS Information</h5>
                    </div>
                </div>
                <div class="box-body">
                    <div class="dps-application-member mb-4" v-if="application.member">
                        <img v-if="application.member.photo" :src="application.member.photo" alt="Member photo" class="w-16">
                        <router-link :to="{name: 'MemberShow', params: { member_id: application.member_id }}" class="text-primary">
                            {{ application.member.name }}
                        </router-link>
                        <h5>Account: {{ application.member.account_no }}</h5>
                    </div>
                    <div class="application-info">
                        <table class="table table-borderless table-striped">
                            <tbody>
                            <tr>
                                <td>Loan Status</td>
                                <td  class="text-right" v-html="getStatusFormat(application.status)"></td>
                            </tr>
                            <tr>
                                <td>Loan</td>
                                <td class="text-right">{{ numberFormat(application.loan_amount) }}</td>
                            </tr>
                            <tr>
                                <td>Loan Service</td>
                                <td class="text-right">{{ application.service }}%</td>
                            </tr>
                            <tr>
                                <td>Service in amount</td>
                                <td class="text-right">{{ numberFormat(application.service_amount) }}</td>
                            </tr>
                            <tr>
                                <td>Loan + Service</td>
                                <td class="text-right">{{ numberFormat(application.total_amount) }}</td>
                            </tr>
                            <tr>
                                <td>Installment</td>
                                <td class="text-right">{{ application.installment }}</td>
                            </tr>
                            <tr>
                                <td>{{ ucFirst(application.dps_type) }} installment amount</td>
                                <td class="text-right">{{ numberFormat(application.installment_amount) }}</td>
                            </tr>
                            <tr v-if="application.prev_deposit">
                                <td>Previous  repayment</td>
                                <td class="text-right">{{ numberFormat(application.prev_deposit) }}</td>
                            </tr>
                            <tr>
                                <td>Total transactions</td>
                                <td class="text-right">{{ application.paid_transactions.length }}</td>
                            </tr>
                            <tr>
                                <td>Total repayment</td>
                                <td class="text-right">{{ numberFormat(application.balance) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
import $ from "jquery";

export default({
    name: 'ShowDpsApplication',
    data() {
        return {
            application_id: this.$route.params.application_id,
            isLoading: false,
            errors: null,
            error: null,
            form: {
                application_id: this.$route.params.application_id,
                loan_amount: 0,
                service: 0,
                service_amount: 0,
                payable_loan_amount: 0,
                early_payment_discount: null,
                beginning_balance: 0,
                payable_amount: null,
                payment: null,
                payment_method: 'cash',
                payment_channel: null,
                transaction_no: null,
                cheque_no: null,
                note: null,
            }
        }
    },

    computed: {
        ...mapGetters ({
            getApplication: 'loan/application',
            validation_errors: 'validation_errors',
            error_message: 'error_message',
        }),

        application() {
            const application = this.getApplication;
            if (application && this.form.application_id) {
                this.form.loan_amount = application.loan_amount;
                this.form.payable_loan_amount = application.total_amount;
                this.form.service = application.service;
                this.form.service_amount = application.service_amount;
                this.form.beginning_balance = application.balance;
                this.form.payable_amount = application.total_amount - application.balance - this.form.early_payment_discount;
            }

            return application;
        }
    },

    methods: {
        ...mapActions({
            getApplicationById: 'loan/getApplicationById',
            closeDpsApplication: 'loan/closeApplication'
        }),

        closeLoanSubmit() {
            $('#closeApplication').prop('disabled', true).addClass('submitted')

            let formData = this.form;

            this.closeDpsApplication(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;

                    this.$swal({
                        icon: "success",
                        title: "Loan application closed!",
                        text: "Loan application has been closed successfully",
                        timer: 3000
                    });
                    this.$router.push({ name: 'ShowLoanApplication', params: {application_id: this.application_id}})
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#closeApplication').prop('disabled', false).removeClass('submitted')
            })

        }

    },

    mounted() {
        this.isLoading = true
        this.getApplicationById(this.application_id).then(() => {
            this.isLoading = false;
        })
    }

})
</script>
