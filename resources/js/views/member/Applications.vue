<template>
    <div class="row" v-if="member">
        <div class="col-md-3">
            <member-show-sidebar :member="member"></member-show-sidebar>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <h5>All Applications</h5>
                    </div>
                </div>
                <div class="box-body">
                    All Applications
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions} from 'vuex'
import MemberShowSidebar from '../../components/MemberShowSidebar'

export default({
    name: 'Applications',
    components: {
        MemberShowSidebar
    },
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
