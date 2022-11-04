<template>
    <div class="modal fade" id="downloadSavingsTransactions">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Download Savings Account Transactions</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 text-left">
                                <label class="col-form-label">From Date</label>
                            </div>
                            <div class="col-md-8">
                                <Datepicker v-model="from_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select From Date"/>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <a :href="'/download/savings/'+member_id+'/transactions?from_date='+form.from_date+'&to_date='+form.to_date" class="btn btn-success btn-sm" target="_blank">
                        <i class="bx bx-download"></i>
                        <span class="ml-2">Download</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {helpers} from "../../mixin";

export default {
    name: "MemberSavingsTransaction",
    props: {
        member_id: Number
    },
    mixins: [helpers],
    data() {
        return {
            form: {
                member_id: this.member_id,
                from_date: '',
                to_date: ''
            },
            from_date: "",
            to_date: "",
        }
    },
    watch: {
        from_date: function () {
            this.form.from_date = this.datePickerFormat(this.from_date);
        },

        to_date: function () {
            this.form.to_date = this.datePickerFormat(this.to_date);
        }
    }
}
</script>

<style scoped>

</style>
