<template>
    <div class="wrapper">
        <navigation/>
        <div class="main-content">
            <page-title></page-title>
            <div class="content">
                <router-view />
            </div>
        </div>
    </div>
    <span style="display: none">{{ currentRoute }}</span>
</template>

<script>
import Navigation from './components/Navigation'
import PageTitle from "./components/PageTitle";

import $ from 'jquery'
export default {
    name: "App",
    components: { Navigation, PageTitle },
    data() {
        return {
            page: this.$route.name
        }
    },
    computed: {
        currentRoute() {
            let current_path = this.$route.name
            if (current_path) {
                if ($('.rs-open-sidebar').length > 0) {
                    if (!$('.rs-open-sidebar .has-multimenu.open').length > 0) {
                        $('.wrapper').removeClass('rs-open-sidebar');
                    }

                    $('.rs-open-sidebar .has-multimenu.open ul li a').click(function () {
                        $('.has-multimenu').removeClass('open');
                        $('.wrapper').removeClass('rs-open-sidebar');
                    })
                }

            } else {
                $('.wrapper').addClass('rs-open-sidebar');
            }
            if (current_path === 'Signin' || current_path === 'NotFound') {
                $('body').addClass('full-screen');
            }else {
                $('body').removeClass('full-screen');
            }
        }
    },
}
</script>
