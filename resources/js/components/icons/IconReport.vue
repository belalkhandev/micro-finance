<template>
    <span class="mr-2">
        <svg-icon type="mdi" :path="path"></svg-icon>
    </span>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiFinance } from '@mdi/js';
export default {
    name: "IconReport",
    components: {
        SvgIcon
    },
    data() {
        return {
            path: mdiFinance,
        }
    }
}
</script>

<style scoped>

</style>
