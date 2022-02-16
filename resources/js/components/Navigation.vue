<template>
    <div class="sidebar">
        <!-- brand-logo -->
        <div class="logo">
            <img src="../assets/images/logo.png" alt="">
            <h2>pdscdcsl</h2>
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

        <div>
            <button type="button" @click="changeLang('en')">Eng</button>
            <button type="button" @click="changeLang('bn')">Ban</button>
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
                    <i class="bx bxs-user-rectangle text-violet-600" ></i>
                    <span>{{ $t('profile') }}</span>
                </router-link>
            </div>
            <div class="navigation-item">
                <router-link :to="{name: 'Members'}">
                    <i class='bx bxs-user-account text-indigo-600' ></i>
                    <span>Members</span>
                </router-link>
            </div>
            <div class="navigation-item has-multimenu">
                <a href="#" class="menu-link" @click="openMultimenus">
                    <i class='bx bxs-file-doc text-green-600' ></i>
                    <span>Applications</span>
                </a>
                <div class="navigation-content">
                    <div class="close-bar" @click="closeMultimenus">
                        <i class='bx bx-x'></i>
                        <span>Close</span>
                    </div>
                    <div class="navigation-content-header">
                        <h3>Applications</h3>
                    </div>
                    <div class="navigation-content-body">
                        <h5><abbr title="Deposit Pension Scheme">DPS</abbr> Applications</h5>
                        <ul>
                            <li>
                                <router-link :to="{name: 'ApplicationDPS'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>All DPS Applications</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'CreateDPS'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>New DPS Application</span>
                                </router-link>
                            </li>
                        </ul>

                        <h5>Loan Applications</h5>
                        <ul>
                            <li>
                                <router-link :to="{name: 'ApplicationLoan'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>All Loan Applications</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'CreateLoan'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>New Loan Application</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navigation-item">
                <router-link :to="{name: 'Admin'}">
                    <i class='bx bxs-user-badge text-red-600'></i>
                    <span>Admins</span>
                </router-link>
            </div>
            <div class="navigation-item has-multimenu">
                <a href="#" class="menu-link" @click="openMultimenus">
                    <i class='bx bxs-report text-orange-600' ></i>
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
                    <i class='bx bxs-cog text-blue-600'></i>
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
                                <router-link :to="{name: 'Postoffice'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Postoffice</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'MemberGroup'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Member groups</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navigation-item">
                <a href="#" @click.prevent="logout">
                    <i class='bx bxs-log-out text-cyan-500' ></i>
                    <span>Logout</span>
                </a>
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
        ...mapActions({
            signOut: 'auth/signOut'
        }),
        openMultimenus(event) {
            const _self = event.currentTarget;
            $(_self).closest('.has-multimenu').addClass('open');
        },

        closeMultimenus(event) {
            const _self = event.currentTarget;
            $(_self).closest('.has-multimenu').removeClass('open');
        },

        logout() {
            this.signOut().then(() => {
                this.$router.replace({
                    name: 'Signin'
                })
            })
        }
    }
})
</script>
