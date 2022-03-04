<template>
    <div class="row" v-if="member">
        <div class="col-md-3">
            <div class="box">
                <div class="box-body">
                    <div class="member member-show">
                        <div class="member-img mt-2 mb-2">
                            <img v-if="member.photo" :src="member.photo" alt="" class="w-24">
                            <img v-else src="../../assets/images/user.png" alt="" class="w-24">
                        </div>
                        <div class="member-info text-center mb-4">
                            <h3>{{ member.name }}</h3>
                            <a href="tel:01798673163">{{ member.phone }}</a>
                        </div>
                        <div class="member-nav mb-4">
                            <ul>
                                <li>
                                    <router-link :to="{ name:'MemberShow', params: { member_id: member.id }}">
                                        <span>Profile</span>
                                        <i class='bx bx-chevrons-right'></i>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name:'MemberNewTransaction', params: { member_id: member.id }}">
                                        <span>New transaction</span>
                                        <i class='bx bx-chevrons-right'></i>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name:'MemberAllTransaction', params: { member_id: member.id }}">
                                        <span>Transaction history</span>
                                        <i class='bx bx-chevrons-right'></i>
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                        <div class="member-account mb-2">
                            <h5>Account Overview</h5>
                            <table class="w-100">
                                <tr>
                                    <td>Account no</td>
                                    <td class="text-right">{{ member.account_no }}</td>
                                </tr>
                                <tr>
                                    <td>Member Type</td>
                                    <td class="text-right" v-if="member.member_type === 'deposit_weekly'">DPS(Weekly)</td>
                                    <td class="text-right" v-else-if="member.member_type === 'deposit_monthly'">DPS(Monthly)</td>
                                    <td class="text-right" v-else="member.member_type === 'loan'">Loan</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="text-right">{{ member.address }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td class="text-success text-right" v-if="member.is_active">Active</td>
                                    <td class="text-danger text-right" v-else>Inactive</td>
                                </tr>
                            </table>
                        </div>
                        <div class="member-download">
                            <h5 class="member-section-ttile">Download</h5>
                            <a href="" class="btn btn-outline-primary w-100">
                                <i class="bx bx-download"></i>
                                Member Profile
                            </a>
                            <a href="" class="btn btn-outline-success w-100 mt-2">                                            <i class="bx bx-download"></i>
                                Transaction History
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>Member Profile</h5>
                    </div>
                    <div class="action">
                        <a href="" class="btn btn-outline-secondary btn-sm">
                            <i class="bx bx-edit"></i>
                            Edit Profile
                        </a>
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
                                    <h5>{{ member.gender }}</h5>
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
                                    <h5>{{ member.nominee.gender }}</h5>
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
                                    <h5>{{ member.joining_date }}</h5>
                                </div>
                                <div class="member-info">
                                    <p>Member Type</p>
                                    <h5>{{ member.member_type }}</h5>
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

export default({
    name: 'AdminProfile',
    data() {
        return {
            member_id: this.$route.params.member_id
        }
    },

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
