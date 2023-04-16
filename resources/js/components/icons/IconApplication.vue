<template>
    <span class="nav-icon text-info">
        <svg-icon type="mdi" :path="path"></svg-icon>
    </span>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiAccountCashOutline } from '@mdi/js';
export default {
    name: "IconApplication",
    components: {
        SvgIcon
    },
    data() {
        return {
            path: mdiAccountCashOutline,
        }
    }
}
</script>

<style scoped>

</style>
