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
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="col-form-label">District</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" v-model="district_id">
                                        <option>Select</option>
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
                                        <option>Select</option>
                                        <option v-for="(upazilla, i) in fetchUpazillas" :value="upazilla.id">{{ upazilla.name }}</option>
                                    </select>
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
                                        <option>Select</option>
                                        <option v-for="(union, i) in fetchUnions" :value="union.id">{{ union.name }}</option>
                                    </select>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-right">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                            <button type="submit" class="ml-2 btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";

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
        }
    },

    computed: {
        ...mapGetters({
            districts: 'location/districts',
            upazillas: 'location/upazillas',
            unions: 'location/unions',
        }),

        fetchDistricts(){
            return this.districts
        },

        fetchUpazillas(){
            if (this.district_id) {
                return this.upazillas.filter(upazilla => upazilla.district_id === this.district_id)
            }

            return this.upazillas
        },

        fetchUnions(){
            if (this.form.upazilla_id) {
                return this.unions.filter(union => union.upazilla_id === this.form.upazilla_id)
            }

            return this.unions
        },
    },

    methods: {
        updateVillage() {
            console.log(this.form)
        }
    },

    watch: {
        village() {
            if (this.village) {
                const vill = this.village;
                this.form.village_id = vill.id;
                this.district_id = vill.union.upazilla.district_id;
                this.form.upazilla_id = vill.upazilla_id;
                this.form.union_id = vill.union_id;
                this.form.name = vill.name;
                this.form.bn_name = vill.bn_name;
            }
        }
    }
})
</script>

