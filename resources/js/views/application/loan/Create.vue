<template>
    <div class="box">
        <div class="box-header">
            <div class="box-title">
                <h5>Create Loan Application</h5>
            </div>
            <div class="box-action">
                <router-link :to="{name: 'ApplicationLoan'}" class="btn btn-primary btn-sm">Loan application list</router-link>
            </div>
        </div>
        <div class="box-body">
            <form @submit.prevent="storeDpsApplication">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="form-group">
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
                                            <input type="date" v-model="form.m_date" id="m_date" class="form-control" disabled>
                                            <span class="text-danger text-sm" v-if="errors">{{ errors.m_date ? errors.m_date[0] : '' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 text-right">
                            <button type="submit" class="btn btn-primary" id="storeApplication">
                                <span>{{ $t('save') }}</span>
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

export default ({
    name: "Create",

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
                m_date: ""
            },
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
            members: 'member/members',
            application_types: 'group/application_types',
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

                // return this.members.filter((member) => {
                //     return member.member_type !== 'loan'
                // });
            }

            return this.members;
        }

    },

    methods: {
        ...mapActions({
            getMembers: 'member/getMembers',
            createApplication: 'loan/createApplication'
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
            }else {
                $('#w_day').prop("disabled", true);
                $('#m_date').prop("disabled", false);
            }
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

        storeDpsApplication() {
            $('#storeApplication').prop('disabled', true).addClass('submitted')

            let formData = new FormData();
            let inputData = this.form

            Object.keys(inputData).forEach(fieldName => {
                formData.append(fieldName, inputData[fieldName]);
            })

            this.createApplication(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    Object.assign(this.$data, this.$options.data.apply(this))
                    this.$swal({
                        icon: "success",
                        title: "Success!",
                        text: "Loan Application has been saved successfully",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#storeApplication').prop('disabled', false).removeClass('submitted')
            })

        }
    },

    mounted() {
        if (!this.members) {
            this.getMembers();
        }
    },
})
</script>
