<template>
    <div class="box">
        <div class="box-header">
            <div class="box-title">
                <h5>Generate DPS/Loan Transaction</h5>
            </div>
            <div class="box-action">
                <router-link :to="{name: 'ApplicationDPS'}" class="btn btn-primary btn-sm">DPS Transactions</router-link>
                <router-link :to="{name: 'ApplicationLoan'}" class="btn btn-warning btn-sm ml-2">Loan Transactions</router-link>
            </div>
        </div>
        <div class="box-body">
            <form @submit.prevent="transactionGenerate">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label class="col-form-label">Transaction Type</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="mt-2">
                                        <label class="mr-4">
                                            <input type="radio" name="transaction_type" value="deposit" v-model="form.transaction_type">
                                            <span class="ml-1">DPS</span>
                                        </label>

                                        <label>
                                            <input type="radio" name="transaction_type" value="loan" v-model="form.transaction_type">
                                            <span class="ml-1">Loan</span>
                                        </label>
                                    </div>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.transaction_type ? errors.transaction_type[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label class="col-form-label">Application Type</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="mt-2">
                                        <label class="mr-4">
                                            <input type="radio" name="application_type" value="weekly" v-model="form.application_type">
                                            <span class="ml-1">Weekly</span>
                                        </label>

                                        <label>
                                            <input type="radio" name="application_type" value="monthly" v-model="form.application_type">
                                            <span class="ml-1">Monthly</span>
                                        </label>
                                    </div>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.application_type ? errors.application_type[0] : '' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label class="col-form-label">From Date</label>
                                </div>
                                <div class="col-md-8">
                                    <Datepicker v-model="from_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select From Date"/>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.from_date ? errors.from_date[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label class="col-form-label">To Date</label>
                                </div>
                                <div class="col-md-8">
                                    <Datepicker v-model="to_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select To Date"/>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.to_date ? errors.to_date[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 text-right">
                            <button type="submit" class="btn btn-primary" id="generateTransaction">
                                <span>{{ $t('generate') }}</span>
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="box-footer"></div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import $ from 'jquery';
import Datepicker from "vue3-date-time-picker";
import moment from 'moment'
import {ref} from "vue";

export default ({
    name: 'GenerateTransaction',

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
                from_date: "",
                to_date: "",
                application_type: "",
                transaction_type: ""
            },
            from_date: "",
            to_date: "",
            errors: null,
            error: null,
        }
    },

    computed: {
        ...mapGetters({
            validation_errors: 'validation_errors',
            error_message: 'error_message',
            application_types: 'group/application_types',
        }),
    },

    methods: {
        ...mapActions({
            getMembers: 'member/getMembers',
            generateTransaction: 'transaction/generateTransaction',
        }),

        transactionGenerate() {
            $('#generateTransaction').prop('disabled', true).addClass('submitted')

            let formData = new FormData();
            let inputData = this.form

            Object.keys(inputData).forEach(fieldName => {
                formData.append(fieldName, inputData[fieldName]);
            })

            this.generateTransaction(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    Object.assign(this.$data, this.$options.data.apply(this))

                    this.$swal({
                        icon: "success",
                        title: "Success!",
                        text: "Transaction has been generated",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#generateTransaction').prop('disabled', false).removeClass('submitted')
            })

        }
    },

    mounted() {

    },

    watch: {
        from_date: function () {
            this.form.from_date = moment(this.from_date).format("L");
        },

        to_date: function () {
            this.form.to_date = moment(this.to_date).format("L");
        }
    }

})
</script>

<style lang="css">
    .dp__theme_light {
        --dp-primary-color: #6366f1;
        --dp-icon-color: #6366f1;
    }
</style>

