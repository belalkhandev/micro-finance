<template>
    <div class="box">
        <div class="box-header">
            <div class="box-title">
                <h4>Add new member</h4>
            </div>
            <div class="box-action">
                <router-link :to="{name: 'Members'}" class="btn btn-sm btn-primary">Member list</router-link>
            </div>
        </div>
        <form @submit.prevent="storeMember">
            <div class="box-body">
                <div class="form-section form-section-primary">
                    <h5>Personal Information</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name  <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.name" placeholder="Enter name" class="form-control">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.name ? errors.name[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Father/Spouse name  <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.father_name" placeholder="Enter father/spouse name" class="form-control">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.father_name ? errors.father_name[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mother Name</label>
                                <input type="text" v-model="form.mother_name" placeholder="Enter mother name" class="form-control">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.mother_name ? errors.mother_name[0] : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gender  <span class="text-danger">*</span></label>
                                <select v-model="form.gender" class="form-select">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                <span class="text-danger text-sm" v-if="errors">{{ errors.gender ? errors.gender[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.phone" placeholder="Enter phone" class="form-control">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.phone ? errors.phone[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>NID</label>
                                <input type="text" v-model="form.nid" placeholder="Enter NID" class="form-control">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.nid ? errors.nid[0] : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Photo</label>
                                <input type="file" class="form-control" ref="member_photo" id="member_photo" @change="handleMemberPhoto()">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.member_photo ? errors.member_photo[0] : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-section form-section-danger">
                    <h5>Address Information</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>District</label>
                                <select class="form-select" v-model="form.district_id">
                                    <option value="">Select</option>
                                    <option v-for="(district, i) in fetchDistricts" :value="district.id" :key="i">
                                        <span v-if="lang == 'en'">{{ district.name }}</span>
                                        <span v-else>{{ district.bn_name ? district.bn_name : district.name }}</span>
                                    </option>
                                </select>
                                <span class="text-danger text-sm" v-if="errors">{{ errors.district_id ? errors.district_id[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Upazilla</label>
                                <select class="form-select" v-model="form.upazilla_id" @change="changeUpazillaId">
                                    <option value="">Select</option>
                                    <option v-for="(upazilla, i) in fetchUpazillas" :value="upazilla.id" :key="i">
                                        <span v-if="lang == 'en'">{{ upazilla.name }}</span>
                                        <span v-else>{{ upazilla.bn_name ? upazilla.bn_name : upazilla.name }}</span>
                                    </option>
                                </select>
                                <span class="text-danger text-sm" v-if="errors">{{ errors.upazilla_id ? errors.upazilla_id[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Union</label>
                                <select class="form-select" v-model="form.union_id">
                                    <option value="">Select</option>
                                    <option v-for="(union, i) in fetchUnions" :value="union.id" :key="i">
                                        <span v-if="lang == 'en'">{{ union.name }}</span>
                                        <span v-else>{{ union.bn_name ? union.bn_name : union.name }}</span>
                                    </option>
                                </select>
                                <span class="text-danger text-sm" v-if="errors">{{ errors.union_id ? errors.union_id[0] : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Post-Office <span class="text-danger">*</span></label>
                                <select class="form-select" v-model="form.post_office_id">
                                    <option value="">Select</option>
                                    <option v-for="(post_office, i) in fetchPostOffices" :value="post_office.id" :key="i">
                                        <span v-if="lang == 'en'">{{ post_office.name }}</span>
                                        <span v-else>{{ post_office.bn_name ? post_office.bn_name : post_office.name }}</span>
                                    </option>
                                </select>
                                <span class="text-danger text-sm" v-if="errors">{{ errors.post_office_id ? errors.post_office_id[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Village <span class="text-danger">*</span></label>
                                <select class="form-select" v-model="form.village_id">
                                    <option value="">Select</option>
                                    <option v-for="(village, i) in fetchVillages" :value="village.id" :key="i">
                                        <span v-if="lang == 'en'">{{ village.name }}</span>
                                        <span v-else>{{ village.bn_name ? village.bn_name : village.name }}</span>
                                    </option>
                                </select>
                                <span class="text-danger text-sm" v-if="errors">{{ errors.village_id ? errors.village_id[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" v-model="form.address" class="form-control" id="">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.address ? errors.address[0] : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section form-section-success">
                    <h5>Account Information</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Joining Date <span class="text-danger">*</span></label>
                                <Datepicker v-model="joining_date" format="dd-MM-yyyy" :enableTimePicker="false" autoApply placeholder="Select Date" />
                                <span class="text-danger text-sm" v-if="errors">{{ errors.joining_date ? errors.joining_date[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Account No <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.account_no" placeholder="Enter account no" class="form-control">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.account_no ? errors.account_no[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Member Type <span class="text-danger">*</span></label>
                                <select v-model="form.member_type" class="form-select">
                                    <option value="">Select</option>
                                    <option v-for="(type, i) in memberTypes" :key="i" :value="type.code">
                                        {{ lang === 'bn' ? type.bn_name : type.name }}
                                    </option>
                                </select>
                                <span class="text-danger text-sm" v-if="errors">{{ errors.member_type ? errors.member_type[0] : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Group</label>
                                <select v-model="form.group" class="form-select" id="memberGroup" disabled>
                                    <option value="">Select Group</option>
                                    <option v-for="(group, i) in groups" :key="i" :value="group.id">
                                        {{ '('+group.group_no+') '+group.group_name + '-'+group.day }}
                                    </option>
                                </select>
                                <span class="text-danger text-sm" v-if="errors">{{ errors.group ? errors.group[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Day <span class="text-danger">*</span></label>
                                <select v-model="form.day" class="form-select">
                                    <option value="">Select</option>
                                    <option v-for="(day, i) in days" :key="i" :value="day.code">
                                        {{ day.name }}
                                    </option>
                                </select>
                                <span class="text-danger text-sm" v-if="errors">{{ errors.day ? errors.day[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select v-model="form.is_active" class="form-select">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-section form-section-warning">
                    <h5>{{ memberType }} Information</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" v-model="form.nominee_name" placeholder="Enter name" class="form-control">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.nominee_name ? errors.nominee_name[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Father/Spouse name</label>
                                <input type="text" v-model="form.nominee_father_name" placeholder="Enter father/spouse name" class="form-control">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.nominee_father_name ? errors.nominee_father_name[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mother Name</label>
                                <input type="text" v-model="form.nominee_mother_name" placeholder="Enter mother name" class="form-control">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.nominee_mother_name ? errors.nominee_mother_name[0] : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gender</label>
                                <select v-model="form.nominee_gender" class="form-select">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                                <span class="text-danger text-sm" v-if="errors">{{ errors.nominee_gender ? errors.nominee_gender[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" v-model="form.nominee_phone" placeholder="Enter phone" class="form-control">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.nominee_phone ? errors.nominee_phone[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>NID</label>
                                <input type="text" v-model="form.nominee_nid" placeholder="Enter NID" class="form-control">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.nominee_nid ? errors.nominee_nid[0] : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Relation with member</label>
                                <select v-model="form.relation" class="form-control">
                                    <option value="">Select</option>
                                    <option v-for="(relation, i) in relations" :key="i" :value="relation.code">
                                        {{ relation.name }}
                                    </option>
                                </select>
                                <span class="text-danger text-sm" v-if="errors">{{ errors.relation ? errors.relation[0] : '' }}</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Address</label>
                                <textarea v-model="form.nominee_address" placeholder="Enter nominee address" rows="1" class="form-control"></textarea>
                                <span class="text-danger text-sm" v-if="errors">{{ errors.nominee_address ? errors.nominee_address[0] : '' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Photo</label>
                                <input type="file" class="form-control" ref="nominee_photo" id="nominee_photo" @change="handleNomineePhoto()">
                                <span class="text-danger text-sm" v-if="errors">{{ errors.nominee_photo ? errors.nominee_photo[0] : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="ml-2 btn btn-primary" id="storeMember">
                    <span>{{ $t('save') }}</span>
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";
import $ from 'jquery';
import {helpers} from "../../mixin";

export default ({
    name: "Create",

    data() {
        return {
            form: {
                name:'',
                father_name: '',
                mother_name: '',
                gender: 'male',
                phone: '',
                nid: '',
                member_photo: '',
                district_id: '',
                upazilla_id: '',
                union_id: '',
                post_office_id: '',
                village_id: '',
                address: '',
                joining_date: this.datePickerFormat(new Date()),
                account_no: '',
                member_type: '',
                group: '',
                day:'',
                is_active: 1,
                nominee_name:'',
                nominee_father_name: '',
                nominee_mother_name: '',
                nominee_gender: 'male',
                nominee_phone: '',
                nominee_nid: '',
                nominee_photo: '',
                nominee_address: '',
                relation: '',
            },
            joining_date: this.datePickerFormat(new Date()),
            errors: null,
            error: null,
        }
    },

    mixins: [helpers],

    computed: {
        ...mapGetters({
            districts: 'location/districts',
            upazillas: 'location/upazillas',
            unions: 'location/unions',
            villages: 'location/villages',
            post_offices: 'location/post_offices',
            groups: 'group/groups',
            days: 'group/days',
            memberTypes: 'group/member_types',
            relations: 'group/relations',
            validation_errors: 'validation_errors',
            error_message: 'error_message',
        }),

        filterRoles(){
            return this.roles
        },

        fetchDistricts(){
            if (this.districts) {
                this.form.district_id = 12
            }

            return this.districts
        },

        fetchUpazillas(){
            if (this.form.district_id && this.upazillas) {
                return this.upazillas.filter(upazilla => upazilla.district_id === this.form.district_id)
            }

            return this.upazillas
        },

        fetchUnions(){
            return this.unions
        },

        fetchPostOffices() {
            if (this.form.upazilla_id && this.post_offices) {
                return this.post_offices.filter(po => po.upazilla_id === this.form.upazilla_id)
            }

            return this.post_offices
        },

        fetchVillages(){
            if (this.form.union_id && this.villages) {
                return this.villages.filter(village => village.union_id === this.form.union_id)
            }

            return this.villages
        },

        memberType () {
            if (this.form.member_type == 'loan_weekly' || this.form.member_type == 'loan_monthly') {
                $('#memberGroup').prop("disabled", false);
                return 'Guarantor';
            }

            $('#memberGroup').prop("disabled", true);
            this.form.group = "";

            return 'Nominee';
        }
    },

    methods: {
        ...mapActions({
            getDistricts: 'location/getDistricts',
            getUpazillas: 'location/getUpazillas',
            getUnions: 'location/getUnions',
            getVillages: 'location/getVillages',
            getGroups: 'group/getGroups',
            getPostOffices: 'location/getPostOffices',
            createMember: 'member/createMember'
        }),

        handleMemberPhoto(){
            this.form.member_photo = this.$refs.member_photo.files[0];
        },

        handleNomineePhoto(){
            this.form.nominee_photo = this.$refs.nominee_photo.files[0];
        },

        storeMember() {
            $('#storeMember').prop('disabled', true).addClass('submitted')

            let formData = new FormData();
            let inputData = this.form

            Object.keys(inputData).forEach(fieldName => {
                formData.append(fieldName, inputData[fieldName]);
            })

            this.createMember(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    Object.assign(this.$data, this.$options.data.apply(this))

                    this.$swal({
                        icon: "success",
                        title: "Success!",
                        text: "Member has been stored successfully",
                        timer: 3000
                    })
                } else {
                    this.$swal({
                        icon: "warning",
                        title: "Something went wrong",
                        text: "Please check that the given data valid",
                        timer: 3000
                    }),
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#storeMember').prop('disabled', false).removeClass('submitted')
            })
        },
        changeUpazillaId() {
            if (this.form.upazilla_id) {
                this.getUnions(this.form.upazilla_id).then(() => {
                    return this.unions
                });
            } else {
                return this.unions = null
            }
        }
    },

    mounted() {
        this.getDistricts();
        this.getUpazillas();
        this.getPostOffices('');
        this.getVillages();
        this.getGroups();
    },

    watch: {
        district_id () {
            this.form.upazilla_id = "";
            this.form.post_office_id = "";
            this.form.village_id = "";
        },

        upazilla_id () {
            this.form.union_id = "";
            this.form.post_office_id = "";
            this.form.village_id = "";
        },

        union_id () {
            this.form.village_id = "";
        },

        joining_date: function () {
            this.form.joining_date = this.datePickerFormat(this.joining_date);
        }

    }
})
</script>

<style lang="css">
    .form-control {
        background-color: #ffffff80;
    }

    .form-control:focus {
        background-color: #ffffff90;
    }

    .dp__theme_light {
        --dp-primary-color: #6366f1;
        --dp-icon-color: #6366f1;
    }
</style>

