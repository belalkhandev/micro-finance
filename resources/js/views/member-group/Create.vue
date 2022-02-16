<template>
    <div class="modal fade" id="createGroupModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Group</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <form @submit.prevent="storeGroup">
                    <div class="modal-body">
                        <span class="text-danger" v-if="error">{{ error }}</span>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Group name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.group_name" placeholder="Group name" class="form-control">
                                    <span class="text-danger" v-if="errors">{{ errors.group_name ? errors.group_name[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Group No</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.group_no" placeholder="Group No" class="form-control">
                                    <span class="text-danger" v-if="errors">{{ errors.group_no ? errors.group_no[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Days</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" v-model="form.day">
                                        <option value="">Select</option>
                                        <option v-for="(day, i) in fetchDays" :value="day.code">{{ day.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">{{ $t('close') }}</button>
                            <button type="submit" class="ml-2 btn btn-primary" id="storeGroup">
                                <span>{{ $t('save') }}</span>
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";
import $ from 'jquery'

export default ({
    name: "Create",

    data() {
        return {
            form: {
                group_name: "",
                group_no: "",
                day: ""
            },
            errors: null,
            error: null,
        }
    },

    computed: {
        ...mapGetters({
            days: 'group/days',
            validation_errors: 'validation_errors',
            error_message: 'error_message',
        }),

        fetchDays(){
            return this.days
        },
    },

    methods: {
        ...mapActions({
            createGroup: 'group/createGroup',
        }),

        storeGroup() {
            $('#storeGroup').prop('disabled', true).addClass('submitted')

            let formData = new FormData();
            let inputData = this.form

            Object.keys(inputData).forEach(fieldName => {
                formData.append(fieldName, inputData[fieldName]);
            })

            this.createGroup(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    Object.assign(this.$data, this.$options.data.apply(this))

                    this.$swal({
                        icon: "success",
                        title: "Success!",
                        text: "Group has been stored successfully",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#storeGroup').prop('disabled', false).removeClass('submitted')
            })

        }
    },

    watch: {
        district_id () {
            this.form.upazilla_id = "";
            this.form.union_id = "";
        },
        upazilla_id () {
            this.form.union_id = "";
        }
    }
})
</script>

