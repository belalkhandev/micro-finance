<template>
    <div class="box">
        <div class="box-header">
            <div class="box-title">
                <h5>Update Loan Application</h5>
            </div>
            <div class="box-action">
                <router-link :to="{name: 'ApplicationLoan'}" class="btn btn-success btn-sm">Loan application list</router-link>
            </div>
        </div>
        <div class="box-body">
            <form @submit.prevent="updateLoanApplication">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
                            {{ application }}
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label class="col-form-label">Member</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="member-select" :class="{open: isOpen}">
                                        <div class="member-input" @click.prevent="showMemberList">
                                            <input type="text" v-model="member_input_text" class="form-control" placeholder="Choose Member" readonly>
                                            <span class="select-icon">
                                                <i class="bx bx-chevron-down"></i>
                                            </span>
                                        </div>
                                        <div class="member-list">
                                            <div class="member-search">
                                                <input type="text" v-model="search_key" placeholder="Search by account no, name, phone" class="form-control">
                                                <span class="list-close" @click="closeMemberList">
                                                    <i class="bx bx-x"></i>
                                                </span>
                                            </div>
                                            <div class="members">
                                                <div class="member" v-for="(member, i) in filterMembers" :key="member.id" @click.prevent="chooseMember(member)">
                                                    <p>{{ member.account_no }} - {{ member.name }} - {{ member.phone }} ({{ member.member_type }})</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.member_id ? errors.member_id[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label class="col-form-label">Loan Amount</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.loan_amount" placeholder="Enter loan amount" class="form-control" @keyup="loanCalculation">
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.loan_amount ? errors.loan_amount[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label class="col-form-label">Service (in (%) Percentage)</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.service" placeholder="0" class="form-control" @keyup="loanCalculation">
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.service ? errors.service[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label class="col-form-label">Total Amount</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.total_loan" placeholder="0" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label class="col-form-label">Installment</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.total_installment" placeholder="0" class="form-control" @keyup="loanCalculation">
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.total_installment ? errors.total_installment[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label class="col-form-label">Installment Amount</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.installment_amount" placeholder="0" class="form-control" readonly>
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
                                            <input type="radio" name="application_type" value="weekly" v-model="form.dps_type" @change="dpsType">
                                            <span class="ml-1">Weekly</span>
                                        </label>

                                        <label>
                                            <input type="radio" name="application_type" value="monthly" v-model="form.dps_type" @change="dpsType">
                                            <span class="ml-1">Monthly</span>
                                        </label>
                                    </div>
                                    <span class="text-danger text-sm" v-if="errors">{{ errors.dps_type ? errors.dps_type[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label class="col-form-label">Start From</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select v-model="form.w_day" class="form-control" id="w_day">
                                                <option value="">Select Day</option>
                                                <option v-for="(day, i) in days" :value="day.code">{{ day.name }}</option>
                                            </select>
                                            <span class="text-danger text-sm" v-if="errors">{{ errors.w_day ? errors.w_day[0] : '' }}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <Datepicker v-model="monthly_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select Date" id="m_date"/>
                                            <span class="text-danger text-sm" v-if="errors">{{ errors.m_date ? errors.m_date[0] : '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4 bg-yellow-50 p-2">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label class="col-form-label">Previous Calculation</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="number" v-model="form.prev_deposit" class="form-control" placeholder="Previous Deposit">
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="form-floating mb-3">
                                                <textarea v-model="form.remarks" class="form-control" id="remarks" placeholder="Leave a comments here"></textarea>
                                                <label for="remarks">Comments</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 text-right">
                            <button type="submit" class="btn btn-primary" id="updateApplication">
                                <span>{{ $t('update') }}</span>
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
import $ from 'jquery'
import {helpers} from "../../../mixin";

export default ({
    name: "LoanCreate",

    mixins: [helpers],

    data() {
        return {
            form: {
                member_id: "",
                loan_amount: "",
                service: 15,
                service_amount: 0,
                total_loan: 0,
                total_installment: 1,
                installment_amount: 0,
                dps_type: "weekly",
                w_day: "",
                m_date: "",
                prev_deposit: "",
                remarks: "",
                application_id: this.$route.params.application_id
            },
            monthly_date: "",
            member_input_text: "",
            search_key: "",
            errors: null,
            error: null,
            isOpen: false
        }
    },

    computed: {
        ...mapGetters({
            validation_errors: 'validation_errors',
            error_message: 'error_message',
            members: 'member/searchData',
            application_types: 'group/application_types',
            applications: 'loan/applications',
            days: 'group/days'
        }),

        filterRoles(){
            return this.roles
        },

        filterMembers()
        {
            if (this.members && this.members.length)
            {
                if (this.search_key.length > 1) {
                    return this.members.filter((member) => {
                        return member.account_no.toLowerCase().includes(this.search_key.toLowerCase())
                            || member.name.toLowerCase().includes(this.search_key.toLowerCase())
                            || member.phone.toLowerCase().includes(this.search_key.toLowerCase())
                    });
                }
            }

            return this.members;
        },

        application () {
            if (this.applications && this.form.application_id) {
                const application = this.applications.find(application => application.id == this.form.application_id)

                if (application) {
                    this.form.member_id = application.member_id;
                    this.form.loan_amount = application.loan_amount;
                    this.form.service = application.service;
                    this.form.service_amount = application.service_amount;
                    this.form.total_loan = application.total_amount;
                    this.form.total_installment = application.installment;
                    this.form.installment_amount = application.installment_amount;
                    this.form.dps_type = application.dps_type;
                    this.form.w_day = application.w_day ? application.w_day : "";
                    this.monthly_date = application.m_date;
                    this.form.prev_deposit = application.prev_deposit;
                    this.form.remarks = application.remarks;
                    this.member_input_text = application.member.account_no + '-' + application.member.name + '-' + application.member.phone+ ' ('+ this.ucFirst(application.member.member_type) +')' ;
                }
            }
        }
    },

    methods: {
        ...mapActions({
            getMembers: 'member/getSearchData',
            getApplications: 'loan/getApplications',
            updateApplication: 'loan/editApplication'
        }),

        showMemberList() {
            this.isOpen = !this.isOpen
            $('.member-input .form-control').focus();
        },

        closeMemberList() {
            this.isOpen = !this.isOpen
        },

        chooseMember(member) {
            this.form.member_id = member.id;
            this.member_input_text = member.account_no + '-' + member.name + '-' + member.phone+ ' ('+ member.member_type  +')' ;

            if (member.member_type === 'deposit_weekly' || member.member_type === 'loan') {
                this.form.w_day = member.day;
                this.form.dps_type = "weekly";
                $('#m_date').prop("disabled", true);
                $('#w_day').prop("disabled", false);
                this.form.m_date = "";
            } else if (member.member_type === 'deposit_monthly') {
                $('#w_day').prop("disabled", true);
                $('#m_date').prop("disabled", false);
                this.form.dps_type = "monthly";
                this.form.w_day = "";
            }

            this.search_key = "";
            this.isOpen = !this.isOpen;
        },

        dpsType() {
            if (this.form.dps_type === 'weekly') {
                $('#m_date').prop("disabled", true);
                $('#w_day').prop("disabled", false);
                this.form.m_date = "";
            }else {
                $('#w_day').prop("disabled", true);
                $('#m_date').prop("disabled", false);
                this.form.w_day = "";
            }

            this.loanCalculation();
        },

        loanCalculation() {
            let loan_amount = this.form.loan_amount ? this.form.loan_amount : 0;
            let service = this.form.service ? this.form.service : 0;
            let total_installment = this.form.total_installment ? this.form.total_installment : 0;
            let service_amount = loan_amount*(service/100)
            this.form.service_amount = service_amount;
            this.form.total_loan = parseFloat(loan_amount)+ service_amount;
            this.form.installment_amount = this.form.total_loan/total_installment;
        },

        updateLoanApplication() {
            $('#updateApplication').prop('disabled', true).addClass('submitted')

            let formData = this.form;

            this.updateApplication(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    Object.assign(this.$data, this.$options.data.apply(this))
                    this.$swal({
                        icon: "success",
                        title: "Updated!",
                        text: "Loan Application has been updated successfully",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#updateApplication').prop('disabled', false).removeClass('submitted')
            })

        }
    },

    mounted() {
        if (!this.members) {
            this.getMembers();
        }


        if (!this.applications) {
            this.getApplications();
        }
    },

    watch: {
        monthly_date: function () {
            this.form.m_date = this.datePickerFormat(this.monthly_date);
        }
    }
})
</script>
