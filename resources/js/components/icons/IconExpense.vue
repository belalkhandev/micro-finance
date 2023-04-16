<template>
    <span class="nav-icon text-warning">
        <svg-icon type="mdi" :path="path"></svg-icon>
    </span>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiFileDocumentArrowRightOutline } from '@mdi/js';
export default {
    name: "IconExpense",
    components: {
        SvgIcon
    },
    data() {
        return {
            path: mdiFileDocumentArrowRightOutline,
        }
    }
}
</script>

<style scoped>

</style>
