<template>
    <div class="box">
        <div class="box-body">
            <form action="">
                <input type="text" name="" class="form-control" placeholder="Enter account no">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default ({
    name: "Index",
    components: {

    },

    data () {
        return {

        }
    },

    computed: {
        ...mapGetters({
            members: 'member/members'
        }),

        fetchPostOffices() {
            return this.members;
        }
    },

    methods: {
        ...mapActions({
            getMembers: 'member/getMembers',
        }),

    },

    mounted() {
        this.getMembers();
    }


})
</script>
