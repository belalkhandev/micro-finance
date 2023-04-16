<template>
    <span class="nav-icon text-info">
        <svg-icon type="mdi" :path="path"></svg-icon>
    </span>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiBadgeAccountHorizontalOutline } from '@mdi/js';
export default {
    name: "IconProfile",
    components: {
        SvgIcon
    },
    data() {
        return {
            path: mdiBadgeAccountHorizontalOutline,
        }
    }
}
</script>

<style scoped>

</style>
