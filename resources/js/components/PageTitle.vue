<template>
    <div class="main-header">
        <div class="page-control">
            <div class="app-icon" @click="openRsSidebar">
                <div class="bx bxs-grid"></div>
            </div>
            <h5>{{ page_title }}</h5>
        </div>
        <div>
            <button type="button" class="mr-2 btn btn-outline-secondary py-0 px-1 focus:shadow-none hover:text-white" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="bx bx-search-alt"></i> <span>Search member</span></button>
            <button class="btn mr-2 py-0 px-1 focus:shadow-none" :class="lang === 'en' ? 'btn-primary' : 'btn-outline-primary'" @click="changeLang('en')">Eng</button>
            <button class="btn py-0 px-1 focus:shadow-none" :class="lang === 'bn' ? 'btn-success' : 'btn-outline-success'" @click="changeLang('bn')">বাংলা</button>
            <SearchMember/>
        </div>
    </div>
</template>

<script>
import $ from 'jquery';
import SearchMember from "../components/Search"

export default({
    name: 'PageTitle',
    components: {
        SearchMember
    },
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

        openRsSidebar()
        {
            $('.wrapper').addClass('rs-open-sidebar');
        }
    },
    watch: {
        '$route.name'(to, next) {
            this.page_title = this.$route.meta.title
        }
    }
})
</script>
