<template>
    <div class="box animate__animated animate__fadeIn">
        <div class="box-body">
            <div class="member member-show">
                <div class="member-img mt-2 mb-2">
                    <img v-if="member.photo" :src="member.photo" alt="" class="w-24 img-thumbnail">
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
                            <router-link :to="{ name:'MemberApplications', params: { member_id: member.id }}">
                                <span>DPS/Loan Applications</span>
                                <i class='bx bx-chevrons-right'></i>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name:'MemberDpsTransaction', params: { member_id: member.id }}">
                                <span>Dps transaction History</span>
                                <i class='bx bx-chevrons-right'></i>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name:'MemberLoanTransaction', params: { member_id: member.id }}">
                                <span>Loan Transaction history</span>
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
                            <td class="text-right">{{ ucFirst(member.member_type) }}</td>
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
                    <h5>Download</h5>
                    <a :href="'/download/member/profile/'+member.id" class="btn btn-outline-primary w-100">
                        <i class="bx bx-download"></i>
                        Member Profile
                    </a>
                    <a href="" class="btn btn-outline-success w-100 mt-2">
                        <i class="bx bx-download"></i>
                        DPS Transactions
                    </a>
                    <a href="" class="btn btn-outline-info w-100 mt-2">
                        <i class="bx bx-download"></i>
                        Loan Transactions
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {helpers} from "../mixin";

export default {
    name: 'MemberShowSidebar',
    props: {
        member: Object
    },
    mixins: [helpers]

}
</script>
