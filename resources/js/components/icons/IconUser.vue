<template>
    <span class="mr-2">
        <svg-icon type="mdi" :path="path"></svg-icon>
    </span>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiAccountGroupOutline } from '@mdi/js';
export default {
    name: "IconAdmins",
    components: {
        SvgIcon
    },
    data() {
        return {
            path: mdiAccountGroupOutline,
        }
    }
}
</script>

<style scoped>

</style>
