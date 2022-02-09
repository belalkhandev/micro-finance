<template>
    <div class="modal fade" id="editVillageModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update village</h5>
                    <button type="button" class="btn btn-outline-danger btn-sm text-lg px-0 py-0 flex align-items-center" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i></button>
                </div>
                <form @submit.prevent="updateVillage">
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
                                    <label class="col-form-label">Union</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" v-model="form.union_id">
                                        <option value="">Select</option>
                                        <option v-for="(union, i) in fetchUnions" :value="union.id">{{ union.name }}</option>
                                    </select>
                                    <span class="text-danger" v-if="errors">{{ errors.union_id ? errors.union_id[0] : '' }}</span>
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
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="ml-2 btn btn-primary" id="updateVillage">
                                <span>Save changes</span>
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
        village: Object
    },
    data() {
        return {
            form: {
                village_id: null,
                upazilla_id: "",
                union_id: "",
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
            unions: 'location/unions',
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

        fetchUnions(){
            if (this.form.upazilla_id && this.unions) {
                return this.unions.filter(union => union.upazilla_id === this.form.upazilla_id)
            } else if (this.district_id && this.unions) {
                return this.unions.filter(union => union.upazilla.district_id === this.district_id)
            }

            return this.unions
        },
    },

    methods: {
        ...mapActions({
            getDistricts: 'location/getDistricts',
            getUpazillas: 'location/getUpazillas',
            getUnions: 'location/getUnions',
            editVillage: 'location/editVillage',
        }),

        updateVillage() {
            $('#updateVillage').prop('disabled', true).addClass('submitted')

            let formData = this.form;

            this.editVillage(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    Object.assign(this.$data, this.$options.data.apply(this))

                    this.$swal({
                        icon: "success",
                        title: "Updated!",
                        text: "Village has been updated successfully",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#updateVillage').prop('disabled', false).removeClass('submitted')
            })

        }
    },

    mounted() {
        this.getDistricts();
        this.getUpazillas();
        this.getUnions();
    },

    watch: {
        village() {
            if (this.village) {
                this.form.village_id = this.village.id;
                this.district_id = this.village.union.upazilla.district_id;
                this.form.upazilla_id = this.village.upazilla_id;
                this.form.union_id = this.village.union_id;
                this.form.name = this.village.name;
                this.form.bn_name = this.village.bn_name;
            }
        },

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

