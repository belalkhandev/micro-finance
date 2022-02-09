<template>
    <div class="sidebar">
        <!-- brand-logo -->
        <div class="logo">
            <img src="../assets/images/logo.png" alt="">
            <h2>PDSCDSL</h2>
        </div>
        <!-- user -->
        <div class="user">
            <div class="user-img">
                <img src="../assets/images/user.png" alt="">
            </div>
            <div class="user-info" v-if="authenticated && user">
                <h3 class="text-white">{{ user.name }}</h3>
                <p>{{ user.role_name }}</p>
            </div>
        </div>
        <!-- main menus -->
        <div class="navigations">
            <div class="navigation-item">
                <router-link :to="{name: 'Dashboard'}" class="menu-link" @click="openMultimenus">
                    <i class="bx bxs-tachometer text-blue-600" ></i>
                    <span>{{ $t('dashboard') }}</span>
                </router-link>
            </div>
            <div class="navigation-item">
                <router-link :to="{name: 'Profile'}">
                    <i class="bx bxs-user-rectangle text-red-600" ></i>
                    <span>{{ $t('profile') }}</span>
                </router-link>
            </div>
            <div class="navigation-item">
                <a href="">
                    <i class='bx bxs-user-account text-indigo-600' ></i>
                    <span>Members</span>
                </a>
            </div>
            <div class="navigation-item">
                <a href="">
                    <i class="bx bxs-user-rectangle text-red-600" ></i>
                    <span>Profile</span>
                </a>
            </div>
            <div class="navigation-item">
                <a href="">
                    <i class='bx bxs-user-account text-indigo-600' ></i>
                    <span>Members</span>
                </a>
            </div>
            <div class="navigation-item">
                <a href="">
                    <i class='bx bxs-file-doc text-green-600' ></i>
                    <span>Applications</span>
                </a>
            </div>
            <div class="navigation-item">
                <a href="">
                    <i class='bx bxs-user-badge' ></i>
                    <span>Admins</span>
                </a>
            </div>
            <div class="navigation-item has-multimenu">
                <a href="#" class="menu-link" @click="openMultimenus">
                    <i class='bx bxs-report' ></i>
                    <span>Reports</span>
                </a>
                <div class="navigation-content">
                    <div class="close-bar" @click="closeMultimenus">
                        <i class='bx bx-x'></i>
                        <span>Close</span>
                    </div>
                    <div class="navigation-content-header">
                        <h3>Reports</h3>
                    </div>
                    <div class="navigation-content-body">
                        <h5>Daily Reports</h5>
                        <ul>
                            <li>
                                <a href="">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Daily Collection Report</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navigation-item has-multimenu">
                <a href="#" @click="openMultimenus">
                    <i class='bx bxs-cog' ></i>
                    <span>{{  $t('settings') }}</span>
                </a>
                <div class="navigation-content">
                    <div class="close-bar" @click="closeMultimenus">
                        <i class='bx bx-x'></i>
                        <span>Close</span>
                    </div>
                    <div class="navigation-content-header">
                        <h3>{{  $t('settings') }}</h3>
                    </div>
                    <div class="navigation-content-body">
                        <h5>Basic Setup</h5>
                        <ul>
                            <li>
                                <router-link :to="{name: 'Village'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Villages</span>
                                </router-link>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Post-Offices</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Unions</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Upazillas</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Districts</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Divisions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navigation-item">
                <router-link :to="{name: 'Signin'}">
                    <i class='bx bxs-log-out' ></i>
                    <span>Logout</span>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions} from 'vuex'
import $ from 'jquery'

export default ({
    name: 'Navigation',
    computed: {
        ...mapGetters ({
            authenticated: 'auth/authenticated',
            user: 'auth/user'
        })
    },
    methods: {
        openMultimenus(event) {
            const _self = event.currentTarget;
            $(_self).closest('.has-multimenu').addClass('open');
        },

        closeMultimenus(event) {
            const _self = event.currentTarget;
            $(_self).closest('.has-multimenu').removeClass('open');
        },
    }
})
</script>
