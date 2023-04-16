<template>
    <div class="row">
        <div class="col-md-4">
            <div class="widget widget-primary mb-4">
                <div class="widget-header">
                    <h5 class="title">Total Member</h5>
                    <span>
                        <i class='bx bx-group'></i>
                    </span>
                </div>
                <div class="widget-body" v-if="fetchMembers">
                    <router-link to="#">
                        <h3>{{ fetchMembers.total }}</h3>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget widget-success mb-4">
                <div class="widget-header">
                    <h5 class="title">Total Members (DPS)</h5>
                    <span>
                        <i class='bx bx-group'></i>
                    </span>
                </div>
                <div class="widget-body" v-if="fetchMembers">
                    <router-link :to="{name: 'MemberType', params: {
                                    member_type: 'deposit'
                                }}">
                        <h3>{{ fetchMembers.total_members_dps }}</h3>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="widget widget-warning mb-4">
                <div class="widget-header">
                    <h5 class="title">Total Members (Loan)</h5>
                    <span>
                        <i class='bx bx-group'></i>
                    </span>
                </div>
                <div class="widget-body" v-if="fetchMembers">
                    <router-link :to="{name: 'MemberType', params: {
                                    member_type: 'loan'
                                }}">
                        <h3>{{ fetchMembers.total_members_loan }}</h3>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
            <div class="box-title">
                <h4>Member list</h4>
            </div>
            <div class="box-action">
                <button class="btn btn-sm btn-secondary" @click="downloadMember()">Download</button>
                <router-link :to="{name: 'CreateMember'}" class="btn btn-sm btn-primary">New member</router-link>
            </div>
        </div>
        <div class="box-body">
            <!-- end pagination -->
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Member</th>
                        <th>Father/Spouse Name</th>
                        <th>Mother Name</th>
                        <th>Member Type</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody v-if="fetchMembers && fetchMembers.data">
                    <tr v-for="(member, i) in fetchMembers.data" :key="i" class="animate__animated animate__fadeIn">
                        <td>{{ fetchMembers.from+i }}</td>
                        <td>
                            <div class="application-member">
                                <img :src="member.photo ? member.photo : ''" alt="" class="w-8 rounded">
                                <div>
                                    {{ member.name }}
                                    <p>Acc. no: {{ member.account_no }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ member.father_name }}</td>
                        <td>{{ member.mother_name }}</td>
                        <td>{{ ucFirst(member.member_type) }}</td>
                        <td v-if="member.is_active" class="text-success">Active</td>
                        <td v-else class="text-danger">Inactive</td>
                        <td>
                            <div class="action">
                                <router-link :to="{ name:'MemberShow', params: { member_id: member.id }}" class="btn btn-outline-success btn-sm"><i class="bx bx-show"></i></router-link>
                                <router-link :to="{ name: 'EditMember', params:{member_id: member.id}}" class="btn btn-outline-danger btn-sm"><i class="bx bx-edit"></i></router-link>
                                <a href="#" class="btn btn-outline-warning btn-sm" @click.prevent="deleteConfirm(member.id)"><i class="bx bx-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <!-- pagination -->
            <div class="pagination" v-if="fetchMembers">
                <p class="pagination-data">
                    Page {{ fetchMembers.current_page }} Showing  {{ fetchMembers.from }} to {{ fetchMembers.to }} of {{ fetchMembers.total }} Data
                </p>
                <Pagination :data="fetchMembers" @pagination-change-page="getResults" :limit="6"/>
            </div>
            <!-- end pagination -->
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import {helpers} from "../../mixin";
import LaravelVuePagination from 'laravel-vue-pagination';

export default ({
    name: "Index",
    components: {
        'Pagination': LaravelVuePagination
    },

    mixins: [helpers],

    computed: {
        ...mapGetters({
            members: 'member/members'
        }),

        fetchMembers() {
            return this.members
        }
    },

    methods: {
        ...mapActions({
            getMembers: 'member/getMembers',
            deleteMember: 'member/deleteMember'
        }),

        deleteConfirm(member_id) {
            if (!this.perms.find(perm => {
                return perm.name === 'delete_member'
            })) {
                this.$swal({
                    icon: 'warning',
                    title: 'Access Denied',
                    text: 'Sorry you have no permission for the action'
                });

                return;
            }
            this.$swal({
                title:"Really want to delete!",
                text: "Are you sure? You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Yes, Delete it!",
                cancelButtonColor: '#c82333',
            }).then((res) => {
                if (res.isConfirmed) {
                    this.deleteMember(member_id).then(() => {
                        if (!this.error_message) {
                            this.$swal({
                                icon: 'success',
                                title: 'Congratulation!',
                                text: 'Member has been deleted successfully'
                            })
                        }else {
                            this.error = this.error_message
                        }
                    })
                }
            });
        },

        getResults(page = 1) {
            this.getMembers(page);
        },

        downloadMember() {
            window.open(window.location.origin+'/download/members/all')
        },
    },

    mounted() {
        this.getResults(1);
    }


})
</script>
