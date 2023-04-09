<template>
    <span class="mr-2">
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
