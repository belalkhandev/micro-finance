<template>
    <div class="modal fade" id="downloadLoanTransactions">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Download Loan Transactions</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer text-right">
                    <a :href="'/download/loan/'+member_id+'/transactions'" class="btn btn-outline-info w-100 mt-2" target="_blank">
                        <i class="bx bx-download"></i>
                        Loan Transactions
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MemberLoanTransaction",
    props: {
        member_id: Number
    },
    data() {
        return {
            form: {
                member_id: this.member_id,
                from_date: '',
                to_date: ''
            }
        }
    },
}
</script>

<style scoped>

</style>
