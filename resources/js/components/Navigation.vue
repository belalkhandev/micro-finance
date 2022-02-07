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
                <h3>{{ user.name }}</h3>
                <p>{{ user.role_name }}</p>
            </div>
        </div>
        <!-- main menus -->
        <div class="navigations">
            <div class="navigation-item has-multimenu">
                <router-link :to="{name: 'Dashboard'}" class="menu-link">
                    <i class="bx bxs-tachometer text-blue-600" ></i>
                    <span>Dashboard</span>
                </router-link>
                <div class="navigation-content">
                    Some content here
                </div>
            </div>
            <div class="navigation-item">
                <router-link :to="{name: 'Profile'}">
                    <i class="bx bxs-user-rectangle text-red-600" ></i>
                    <span>Profile</span>
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
                <a href="" class="menu-link">
                    <i class='bx bxs-report' ></i>
                    <span>Reports</span>
                </a>
                <div class="navigation-content">
                    <div class="navigation-content-header">
                        <h3>Reports</h3>
                    </div>
                    <div class="navigation-content-body">
                        <h5>Daily Reports</h5>
                        <ul>
                            <li>
                                <a href="">
                                    <i class='bx bx-right-arrow-alt'></i>
                                    <span>Daily Collection Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class='bx bx-right-arrow-alt'></i>
                                    <span>Daily Collection Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class='bx bx-right-arrow-alt'></i>
                                    <span>Daily Collection Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class='bx bx-right-arrow-alt'></i>
                                    <span>Daily Collection Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class='bx bx-right-arrow-alt'></i>
                                    <span>Daily Collection Report</span>
                                </a>
                            </li>
                        </ul>
                        <h5>Daily Reports</h5>
                        <ul>
                            <li>
                                <a href="">
                                    <i class='bx bx-right-arrow-alt'></i>
                                    <span>Daily Collection Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class='bx bx-right-arrow-alt'></i>
                                    <span>Daily Collection Report</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class='bx bx-right-arrow-alt'></i>
                                    <span>Daily Collection Report</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navigation-item">
                <a href="">
                    <i class='bx bxs-cog' ></i>
                    <span>Settings</span>
                </a>
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

export default ({
    name: 'Navigation',
    computed: {
        ...mapGetters ({
            authenticated: 'auth/authenticated',
            user: 'auth/user'
        })
    },
    methods: {
        changeLang(lang) {
            localStorage.setItem('lang', lang)
            this.$i18n.locale = lang
        }
    }
})
</script>
