<template>
    <div class="row" v-if="application && !isLoading">
        <div class="col-md-8">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>DPS Close Form</h5>
                    </div>
                    <div class="box-action">
                        <router-link :to="{ name: 'showDPSApplication', params:{application_id: application.id}}" class="btn btn-outline-primary btn-sm">Back</router-link>
                    </div>
                </div>
                <div class="box-body">
                    <form @submit.prevent="closeDpsSubmit">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Current Deposit Balance</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" v-model="form.deposit_balance" placeholder="Enter deposit amount" class="form-control" readonly>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.deposit_balance ? errors.deposit_balance[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Incentive</label>
                                </div>
                                <div class="col-md-7">
                                   <div class="d-flex gap-2">
                                       <div class="w-100">
                                           <input type="number" v-model="form.incentive" @keyup="handleIncentive" placeholder="0.00" class="form-control">
                                           <span class="text-danger text-sm" v-if="errors">{{ errors.incentive ? errors.incentive[0] : '' }}</span>
                                       </div>
                                       <div class="incentive-type d-flex align-items-center gap-2">
                                           <span class="btn btn-sm btn-outline-secondary" :class="form.incentive_type === 'flat' ? 'btn-primary' : ''" @click="handleIncentiveType('flat')">৳</span>
                                           <span class="btn btn-sm btn-outline-secondary" :class="form.incentive_type === 'percentage' ? 'btn-primary' : ''" @click="handleIncentiveType('percentage')">%</span>
                                       </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Incentive Amount</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" v-model="form.incentive_amount" placeholder="0.00" class="form-control" readonly>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.incentive_amount ? errors.incentive_amount[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5 text-left">
                                    <label class="col-form-label">Amount Payable</label>
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
                                    <label class="col-form-label">Amount Paid</label>
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
                                <span>Close DPS</span>
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
                                <td>DPS Status</td>
                                <td  class="text-right" v-html="getStatusFormat(application.status)"></td>
                            </tr>
                            <tr>
                                <td>Deposit Duration</td>
                                <td class="text-right">{{ application.year }} years</td>
                            </tr>
                            <tr>
                                <td>{{ ucFirst(application.dps_type) }} Deposit</td>
                                <td class="text-right">{{ numberFormat(application.dps_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Depositable Amount</td>
                                <td class="text-right">{{ numberFormat(application.total_amount) }}</td>
                            </tr>
                            <tr>
                                <td>Receivable Amount</td>
                                <td class="text-right">{{ numberFormat(application.receiving) }}</td>
                            </tr>
                            <tr>
                                <td>Profitable Amount</td>
                                <td class="text-right">{{ numberFormat(application.profit) }}</td>
                            </tr>
                            <tr>
                                <td>Total transactions</td>
                                <td class="text-right">{{ application.transactions.length }}</td>
                            </tr>
                            <tr>
                                <td>DPS Balance</td>
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
                deposit_balance: 0,
                incentive: null,
                incentive_type: "flat",
                incentive_amount: null,
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
            getApplication: 'dps/application',
            validation_errors: 'validation_errors',
            error_message: 'error_message',
        }),

        application() {
            const application = this.getApplication;
            if (application && this.form.application_id) {
                this.form.deposit_balance = application.balance;
                this.form.payable_amount = application.balance;
            }

            return application;
        }
    },

    methods: {
        ...mapActions({
            getApplicationById: 'dps/getApplicationById',
            closeDpsApplication: 'dps/closeApplication'
        }),

        handleIncentiveType(type) {
            this.form.incentive_type = type;
            this.handleIncentive();
        },

        handleIncentive() {
            if (this.form.incentive_type === 'flat') {
                this.form.incentive_amount = this.form.incentive || 0;
            } else if (this.form.incentive_type === 'percentage') {
                this.form.incentive_amount = parseFloat(this.form.deposit_balance * (this.form.incentive / 100));
            }

            this.form.payable_amount = parseFloat(this.form.deposit_balance) + parseFloat(this.form.incentive_amount);
        },

        closeDpsSubmit() {
            $('#closeApplication').prop('disabled', true).addClass('submitted')

            let formData = this.form;

            this.closeDpsApplication(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;

                    this.$swal({
                        icon: "success",
                        title: "DPS Closed!",
                        text: "Dps Application has been closed successfully",
                        timer: 3000
                    })
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
            if (!this.getApplication) {
                this.$router.push({ name: 'PageNotFound'})
            }
        })
    }

})
</script>
