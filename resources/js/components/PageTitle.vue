<template>
    <div class="main-header">
        <h5>{{ page_title }}</h5>
        <div>
            <button class="btn mr-2 py-0 px-1 focus:shadow-none" :class="lang === 'en' ? 'btn-primary' : 'btn-outline-primary'" @click="changeLang('en')">Eng</button>
            <button class="btn py-0 px-1 focus:shadow-none" :class="lang === 'bn' ? 'btn-success' : 'btn-outline-success'" @click="changeLang('bn')">বাংলা</button>
        </div>
    </div>
</template>

<script>
export default({
    name: 'PageTitle',
    data () {
        return {
            page_title: 'Dashboard',
            lang: localStorage.getItem('lang')
        }
    },
    methods: {
        changeLang(lang) {
            localStorage.setItem('lang', lang)
            this.$i18n.locale = lang
            this.lang = lang
        },
    },
    watch: {
        '$route.name'(to, next) {
            this.page_title = this.$route.meta.title
        }
    }
})
</script>
