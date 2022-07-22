<template>
    <div class="search-container">
        <div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body" style="min-height: 70vh">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="search-form">
                                        <form>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="bx bx-search-alt"></i>
                                                    </div>
                                                    <input type="search" class="form-control" v-model="search_key" placeholder="Account no">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="search-result" v-if="fetchMembers">
                                        <h5 class="rs-count">{{ fetchMembers.length }} Result Found:</h5>
                                        <div class="search-items">
                                            <div class="search-item" v-for="(member, i) in fetchMembers" :key="i">
                                                <router-link :to="{ name:'MemberShow', params: { member_id: member.id }}" @click.prevent="showMemberProfile">
                                                    <div class="search-img">
                                                        <img v-if="member.photo" :src="member.photo" alt="">
                                                        <img v-else src="https://via.placeholder.com/50" alt="">
                                                    </div>
                                                    <div class="search-content">
                                                        <h5>{{ member.name }}</h5>
                                                        <p>Account No: <strong>{{ member.account_no }}</strong>, <strong v-if="member.member_group_id">Group: {{ member.member_group_id }}, </strong> Member type: <strong>{{ ucFirst(member.member_type) }}</strong></p>
                                                        <p>Address: <strong>{{ member.address }}</strong>, Phone: {{ member.phone }}</p>
                                                    </div>
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <img class="m-auto py-4" src="../assets/images/search-image.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary bs-modal-close" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import $ from "jquery";
import {helpers} from "../mixin";

export default ({
    name: "SearchMember",
    data () {
        return {
            search_key: ""
        }
    },

    mixins: [helpers],

    computed: {
        ...mapGetters({
            members: 'member/members'
        }),

        fetchMembers() {

            if (this.search_key.length > 1) {
                return this.members.filter((member) => {
                    return member.account_no.toLowerCase() === this.search_key.toLowerCase()
                });
            }

            return null

        }
    },

    methods: {
        ...mapActions({
            getMembers: 'member/getMembers'
        }),

        showMemberProfile(e) {
            e.preventDefault();
            $('.modal-backdrop').remove();
            $('#searchModal').removeClass('show').removeAttr('style');
            $('body').removeClass('modal-open').removeAttr('style');
        }
    },

    mounted() {
        this.getMembers();
    }
})
</script>
