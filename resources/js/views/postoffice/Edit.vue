<template>
    <div class="modal fade" id="editPostOfficeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Post office</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <form @submit.prevent="updatePostOffice">
                    <div class="modal-body">
                        <span class="text-danger" v-if="error">{{ error }}</span>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">District</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" v-model="district_id">
                                        <option value="">Select</option>
                                        <option v-for="(district, i) in fetchDistricts" :value="district.id">{{ district.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Upazilla</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" v-model="form.upazilla_id">
                                        <option value="">Select</option>
                                        <option v-for="(upazilla, i) in fetchUpazillas" :value="upazilla.id">{{ upazilla.name }}</option>
                                    </select>
                                    <span class="text-danger" v-if="errors">{{ errors.upazilla_id ? errors.upazilla_id[0] : '' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Code</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" v-model="form.post_code" placeholder="Post code" class="form-control">
                                    <span class="text-danger" v-if="errors">{{ errors.post_code ? errors.post_code[0] : '' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.name" placeholder="Name" class="form-control">
                                    <span class="text-danger" v-if="errors">{{ errors.name ? errors.name[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Bangla name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.bn_name" placeholder="Name in bangla" class="form-control">
                                    <span class="text-danger" v-if="errors">{{ errors.bn_name ? errors.bn_name[0] : '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">{{ $t('close') }}</button>
                            <button type="submit" class="ml-2 btn btn-primary" id="updatePostOffice">
                                <span>{{ $t('save_change') }}</span>
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
    name: "Edit",
    props: {
        post_office: Object
    },
    data() {
        return {
            form: {
                post_office_id: null,
                upazilla_id: "",
                post_code: "",
                name: "",
                bn_name: ""
            },
            district_id: "",
            errors: null,
            error: null,
        }
    },

    computed: {
        ...mapGetters({
            districts: 'location/districts',
            upazillas: 'location/upazillas',
            validation_errors: 'validation_errors',
            error_message: 'error_message',
        }),

        fetchDistricts(){
            if (this.districts) {
                this.district_id = 12
            }

            return this.districts
        },

        fetchUpazillas(){
            if (this.district_id && this.upazillas) {
                return this.upazillas.filter(upazilla => upazilla.district_id === this.district_id)
            }

            return this.upazillas
        },
    },

    methods: {
        ...mapActions({
            getDistricts: 'location/getDistricts',
            getUpazillas: 'location/getUpazillas',
            editPostOffice: 'location/editPostOffice',
        }),

        updatePostOffice() {
            $('#updatePostOffice').prop('disabled', true).addClass('submitted')

            let formData = this.form;

            this.editPostOffice(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;

                    this.$swal({
                        icon: "success",
                        title: "Updated!",
                        text: "PostOffice has been updated successfully",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#updatePostOffice').prop('disabled', false).removeClass('submitted')
            })

        }
    },

    mounted() {
        this.getDistricts();
        this.getUpazillas();
    },

    watch: {
        post_office() {
            if (this.post_office) {
                this.form.post_office_id = this.post_office.id;
                this.district_id = this.post_office.upazilla.district_id;
                this.form.upazilla_id = this.post_office.upazilla_id;
                this.form.post_code = this.post_office.code;
                this.form.name = this.post_office.name;
                this.form.bn_name = this.post_office.bn_name;
            }
        },

        district_id () {
            this.form.upazilla_id = "";
        },
    }
})
</script>

