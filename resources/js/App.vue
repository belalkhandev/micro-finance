<template>
    <div class="wrapper">
        <navigation/>
        <div class="main-content">
            <page-title></page-title>
            <div class="content">
                <router-view />
            </div>
            <span class="loader"></span>
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

<style lang="css">
    .loader {
        border: 2px solid;
        border-color: transparent #FFF;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: inline-block;
        box-sizing: border-box;
        animation: rotation 2s linear infinite;
        position: absolute;
        top: calc(50% - 24px);
        left: calc(50% - 24px);
        display: none;
    }
    .loader::after {
        content: '';
        box-sizing: border-box;
        position: absolute;
        left: 50%;
        top: 50%;
        border: 24px solid;
        border-color: transparent rgba(255, 255, 255, 0.15);
        border-radius: 50%;
        transform: translate(-50%, -50%);
    }

    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
