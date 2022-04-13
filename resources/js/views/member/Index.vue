<template>
    <div class="box">
        <div class="box-header">
            <div class="box-title">
                <h4>Member list</h4>
            </div>
            <div class="box-action">
                <div class="search" :class="is_open_search ? 'open-search' : ''">
                    <div class="search-form">
                        <div class="search-group">
                            <input type="search" v-model="search_key" placeholder="Search keyword" class="form-control">
                        </div>
                        <div class="search-group">
                            <Datepicker v-model="search_date" format="yyyy-MM-dd" :enableTimePicker="false" autoApply placeholder="Search Date"/>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm focus:shadow-none" @click="openSearch()">
                        <i class="bx bx-search-alt"></i>
                    </button>
                </div>
                <router-link :to="{name: 'CreateMember'}" class="btn btn-sm btn-primary">New member</router-link>
            </div>
        </div>
        <div class="box-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Acc. no</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Father/Spouse Name</th>
                        <th>Mother Name</th>
                        <th>Member Type</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(member, i) in fetchMembers" :key="i" class="animate__animated animate__fadeIn">
                        <td>{{ per_page*(page-1)+(i+1) }}</td>
                        <td>{{ member.account_no }}</td>
                        <td>{{ member.name }}</td>
                        <td>
                            <img v-if="member.photo" :src="member.photo" alt="" class="w-8 rounded">
                            <img v-else src="https://via.placeholder.com/35" alt="" class="w-8 rounded">
                        </td>
                        <td>{{ member.father_name }}</td>
                        <td>{{ member.mother_name }}</td>
                        <td>{{ ucFirst(member.member_type) }}</td>
                        <td v-if="member.is_active" class="text-success">Active</td>
                        <td v-else class="text-danger">Inactive</td>
                        <td>
                            <div class="action">
                                <router-link :to="{ name:'MemberShow', params: { member_id: member.id }}" class="btn btn-outline-success btn-sm"><i class="bx bx-show"></i></router-link>
                                <router-link :to="{ name:'MemberDpsTransaction', params: { member_id: member.id }}"  class="btn btn-outline-primary btn-sm mr-1"><i class='bx bx-transfer-alt'></i></router-link>
                                <router-link :to="{ name:'MemberLoanTransaction', params: { member_id: member.id }}"  class="btn btn-outline-warning btn-sm mr-1"><i class='bx bx-transfer-alt'></i></router-link>
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
            <div class="pagination" v-if="members && members.length > per_page">
                <p class="pagination-data">
                    Page no {{ page }} Show {{ page === pages.length ? (members ? members.length : 0) : page*(fetchMembers ? fetchMembers.length : 0) }} of {{ members ? members.length : 0 }} Data
                </p>
                <ul>
                    <li class="page-item">
                        <button class="page-link" @click="page = 1" data-toggle="tooltip" data-placement="bottom" title="First Page"><i class="bx bx-chevrons-left"></i></button>
                    </li>
                    <li class="page-item">
                        <button class="page-link" v-if="page !== 1" @click="page--" data-toggle="tooltip" data-placement="bottom" title=""><i class="bx bx-chevron-left"></i></button>
                    </li>
                    <li class="page-item">
                        <button type="button" class="page-link" v-for="pageNumber in pages.slice(page-1, page+10)" :class="page===pageNumber ? 'active': ''" :key="pageNumber" @click="page = pageNumber"> {{ pageNumber}} </button>
                    </li>
                    <li class="page-item">
                        <button type="button" @click="page++" v-if="page < pages.length" class="page-link"> <i class="bx bx-chevron-right"></i> </button>
                    </li>
                    <li class="page-item">
                        <button class="page-link"  @click="page = pages.length" data-toggle="tooltip" data-placement="bottom" title="Last Page"><i class="bx bx-chevrons-right"></i></button>
                    </li>
                </ul>
            </div>
            <!-- end pagination -->
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import {helpers} from "../../mixin";

export default ({
    name: "Index",

    mixins: [helpers],

    computed: {
        ...mapGetters({
            members: 'member/members'
        }),

        fetchMembers() {
            if (this.members) {
                if (this.search_key && !this.search_date) {
                    return this.paginate(this.members.filter(
                        member =>
                            member.account_no.toLowerCase().includes(this.search_key.toLowerCase()) ||
                            member.name.toLowerCase().includes(this.search_key.toLowerCase()) ||
                            member.phone.toLowerCase().includes(this.search_key.toLowerCase())
                    ));
                } else if (this.search_date && !this.search_key) {
                    return this.paginate(this.members.filter(
                        member =>
                            this.datePickerFormat(member.joining_date) === this.datePickerFormat(this.search_date)
                    ));
                } else if (this.search_key && this.search_date) {
                    return this.paginate(this.members.filter(
                        member =>
                            this.datePickerFormat(member.joining_date) === this.datePickerFormat(this.search_date) &&
                            member.account_no.toLowerCase().includes(this.search_key.toLowerCase()) ||
                            member.name.toLowerCase().includes(this.search_key.toLowerCase()) ||
                            member.phone.toLowerCase().includes(this.search_key.toLowerCase())
                    ));
                } else {
                    return this.paginate(this.members);
                }
            }

            return this.members

        }
    },

    methods: {
        ...mapActions({
            getMembers: 'member/getMembers',
            deleteMember: 'member/deleteMember'
        }),

        showEditModal(data) {

        },

        deleteConfirm(member_id) {
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

        // pagination set pages
        setPages() {
            let numberOfPages = Math.ceil(this.members ? this.members.length / this.per_page : 0);
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },
    },

    mounted() {
        if(!this.members) {
            this.getMembers().then(() => {
                this.setPages();
            });
        }

        this.setPages();
    }


})
</script>
