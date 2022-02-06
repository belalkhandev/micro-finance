<template>
    <div class="main-header">
<!--        <div id="drawer">Apps</div>-->
        <h5>{{ page_title }}</h5>
    </div>
</template>

<script>
export default({
    name: 'PageTitle',
    data () {
        return {
            page_title: 'Dashboard'
        }
    },
    watch: {
        '$route.name'(to, next) {
            this.page_title = this.$route.meta.title
        }
    }
})
</script>
