<template>
    <span class="mr-2 text-success">
        <svg-icon type="mdi" :path="path"></svg-icon>
    </span>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiAccountMultipleOutline } from '@mdi/js';
export default {
    name: "IconMember",
    components: {
        SvgIcon
    },
    data() {
        return {
            path: mdiAccountMultipleOutline,
        }
    }
}
</script>

<style scoped>

</style>
