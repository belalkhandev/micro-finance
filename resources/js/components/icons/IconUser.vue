<template>
    <span class="mr-2 text-blue-400">
        <svg-icon type="mdi" :path="path"></svg-icon>
    </span>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiAccountLockOutline } from '@mdi/js';
export default {
    name: "IconAdmins",
    components: {
        SvgIcon
    },
    data() {
        return {
            path: mdiAccountLockOutline,
        }
    }
}
</script>

<style scoped>

</style>
