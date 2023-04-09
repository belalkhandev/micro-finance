<template>
    <span class="mr-2">
        <svg-icon type="mdi" :path="path"></svg-icon>
    </span>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiLogoutVariant } from '@mdi/js';
export default {
    name: "IconLogout",
    components: {
        SvgIcon
    },
    data() {
        return {
            path: mdiLogoutVariant,
        }
    }
}
</script>

<style scoped>

</style>
