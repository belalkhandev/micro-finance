<template>
    <span class="mr-2 text-primary">
        <svg-icon type="mdi" :path="path"></svg-icon>
    </span>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiCashMultiple } from '@mdi/js';
export default {
    name: "IconTransaction",
    components: {
        SvgIcon
    },
    data() {
        return {
            path: mdiCashMultiple,
        }
    }
}
</script>

<style scoped>

</style>
