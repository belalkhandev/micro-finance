<template>
    <div class="row" v-if="member">
        <div class="col-md-3">
            <member-show-sidebar :member="member"></member-show-sidebar>
        </div>
        <div class="col-md-9">
            <div class="box animate__animated animate__fadeIn">
                <div class="box-header">
                    <div class="box-title">
                        <h5>Member Profile</h5>
                    </div>
                    <div class="action">
                        <router-link :to="{name: 'EditMember', params: {member_id: member.id}}" class="btn btn-outline-secondary btn-sm">
                            <i class="bx bx-edit"></i>
                            Edit Profile
                        </router-link>
                    </div>
                </div>
                <div class="box-body">
                    <div class="member-details">
                        <div class="member-detail">
                            <h3>Personal Information</h3>
                            <div class="member-infos">
                                <div class="member-info">
                                    <p>Name</p>
                                    <h5>{{ member.name }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Father/Spouse name</p>
                                    <h5>{{ member.father_name }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Mother  name</p>
                                    <h5>{{ member.mother_name }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Phone</p>
                                    <h5>{{ member.phone}}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Gender</p>
                                    <h5>{{ ucFirst(member.gender) }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>NID</p>
                                    <h5>{{ member.nid }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="member-detail">
                            <h3>Nominee information</h3>
                            <div class="member-infos">
                                <div class="member-info">
                                    <p>Name</p>
                                    <h5>{{ member.nominee.name }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Father/Spouse name</p>
                                    <h5>{{ member.nominee.father_name }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Mother  name</p>
                                    <h5>{{ member.nominee.mother_name }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Gender</p>
                                    <h5>{{ member.nominee.gender }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Phone</p>
                                    <h5>{{ member.nominee.phone }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Gender</p>
                                    <h5>{{ ucFirst(member.nominee.gender) }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>NID</p>
                                    <h5>{{ member.nominee.nid }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Relation</p>
                                    <h5>{{ member.nominee.relation }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Address</p>
                                    <h5>{{ member.nominee.address }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="member-detail">
                            <h3>Account information</h3>
                            <div class="member-infos">
                                <div class="member-info">
                                    <p>Account No</p>
                                    <h5>{{ member.account_no }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Joining Date</p>
                                    <h5>{{ userFormattedDate(member.joining_date) }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Member Type</p>
                                    <h5>{{ ucFirst(member.member_type) }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Group</p>
                                    <h5>{{ 'No group' }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Day</p>
                                    <h5>{{ member.day }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions} from 'vuex'
import MemberShowSidebar from '../../components/MemberShowSidebar'
import {helpers} from "../../mixin";

export default({
    name: 'MemberProfileShow',
    components: {
        MemberShowSidebar
    },
    data() {
        return {
            member_id: this.$route.params.member_id
        }
    },

    mixins: [helpers],

    computed: {
        ...mapGetters ({
            members: 'member/members'
        }),

        member() {
            if (this.members && this.member_id) {
                return this.members.find(member => member.id == this.member_id)
            }
        }
    },

    methods: {
        ...mapActions({
            getMembers: 'member/getMembers'
        })
    },

    mounted() {
        if (!this.members) {
            this.getMembers();
        }
    }


})
</script>
