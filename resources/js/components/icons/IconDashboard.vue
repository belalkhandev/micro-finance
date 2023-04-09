<template>
    <span class="mr-2">
        <svg-icon type="mdi" :path="path"></svg-icon>
    </span>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiViewDashboardOutline } from '@mdi/js';
export default {
    name: "IconDashboard",
    components: {
        SvgIcon
    },
    data() {
        return {
            path: mdiViewDashboardOutline,
        }
    }
}
</script>

<style scoped>

</style>
