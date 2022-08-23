<template>
    <div class="modal fade" id="downloadSavingsTransactions">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Download Savings Account Transactions</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer text-right">
                    <a :href="'/download/savings/'+member_id+'/transactions'" class="btn btn-info btn-sm" target="_blank">
                        <i class="bx bx-download"></i>
                        <span class="ml-2">Download Statement</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MemberSavingsTransaction",
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
