<template>
    <span class="mr-2 text-warning">
        <svg-icon type="mdi" :path="path"></svg-icon>
    </span>
</template>

<script>
import SvgIcon from '@jamescoyle/vue-icon'
import { mdiApplicationCogOutline } from '@mdi/js';
export default {
    name: "IconSettings",
    components: {
        SvgIcon
    },
    data() {
        return {
            path: mdiApplicationCogOutline,
        }
    }
}
</script>

<style scoped>

</style>
