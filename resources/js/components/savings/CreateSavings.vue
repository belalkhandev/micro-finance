<template>
    <div class="modal fade" id="savingsCreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Savings Transaction Create</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <form @submit.prevent="createSavings">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Savings Type</label>
                            <div class="col-md-8">
                                <select class="form-select form-control" v-model="form.savings_type" required>
                                    <option value="">Select Type</option>
                                    <option value="deposit">Deposit</option>
                                    <option value="withdraw">Withdraw</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Amount</label>
                            <div class="col-md-8">
                                <input type="number" v-model="form.amount" class="form-control" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-4">Savings Balance (Previous)</label>
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
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

            pre_balance: this.member.savings_deposit - this.member.savigns_withdraw,
            new_balance: 0
        }
    }
}
</script>

<style scoped>

</style>
