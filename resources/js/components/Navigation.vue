<template>
    <div class="sidebar">
        <div class="close" @click="closeRsSidebar">
            <i class="bx bx-x"></i>
        </div>
        <!-- brand-logo -->
        <div class="logo animate__animated animate__fadeInDown">
            <img src="../assets/images/logo.png" alt="" >
        </div>
        <div class="user" v-if="authenticated && user">
            <div class="user-img">
                <img v-if="user.profile" :src="user.profile.photo" alt="">
                <img v-else src="../assets/images/user.png" alt="">
            </div>
            <div class="user-info">
                <h3 class="text-white">{{ user.name }}</h3>
                <p>{{ user.role_name }}</p>
            </div>
        </div>
        <!-- main menus -->
        <div class="navigations">
            <div class="navigation-item">
                <router-link :to="{name: 'Dashboard'}" class="menu-link" @click="openMultimenus">
<!--                    <i class="bx bxs-tachometer text-blue-600" ></i>-->
                    <img src="../assets/images/nav-icons/dashboard.png" alt="">
                    <span>{{ $t('dashboard') }}</span>
                </router-link>
            </div>
            <div class="navigation-item has-multimenu">
                <a href="javascript:void(0)" class="menu-link" @click="openMultimenus">
<!--                    <i class="bx bxs-user-rectangle text-violet-600" ></i>-->
                    <img src="../assets/images/nav-icons/transaction.png" alt="">
                    <span>{{ $t('transaction') }}</span>
                </a>
                <div class="navigation-content">
                    <div class="close-bar" @click="closeMultimenus">
                        <i class='bx bx-x'></i>
                        <span>Close</span>
                    </div>
                    <div class="navigation-content-header">
                        <h3>{{ $t('transaction') }}</h3>
                    </div>
                    <div class="navigation-content-body">
                        <ul>
                            <li>
                                <router-link :to="{name: 'GenerateTransaction'}" >
                                    <i class='bx bx-chevron-right'></i>
                                    <span>{{ $t('generate') }} {{ $t('transaction') }}</span>
                                </router-link>
                            </li>
                            <hr>
                            <li>
                                <router-link :to="{name: 'DpsTransactionList'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>All DPS Transactions</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'DpsUnpaidTransactionList'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>DPS Unpaid Transactions</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'DpsPaidTransactionList'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>DPS Paid Transactions</span>
                                </router-link>
                            </li>
                            <hr>
                            <li>
                                <router-link :to="{name: 'LoanTransactionList'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>All Loan Transactions</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'LoanUnpaidTransactionList'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Loan Unpaid Transactions</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'LoanPaidTransactionList'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Loan Paid Transactions</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!--  members-->
            <div class="navigation-item has-multimenu">
                <a href="#"  @click="openMultimenus">
                    <img src="../assets/images/nav-icons/add-user.png" alt="">
                    <span>{{ $t('members') }}</span>
                </a>
                <div class="navigation-content">
                    <div class="close-bar" @click="closeMultimenus">
                        <i class='bx bx-x'></i>
                        <span>Close</span>
                    </div>
                    <div class="navigation-content-header">
                        <h3>Manage Members</h3>
                    </div>

                    <div class="navigation-content-body">
                        <ul>
                            <li>
                                <router-link :to="{name: 'Members'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>All Member</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'CreateMember'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>New Member</span>
                                </router-link>
                            </li>
                        </ul>

                        <h5>Member Groups</h5>

                        <ul v-if="fetchGroups">
                            <li v-for="(group, i) in fetchGroups" :key="i">
                                <router-link :to="{name: 'MemberGrouping', params: {
                                    group_id: group.id
                                }}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>{{ group.group_name }} ({{ group.total_member }})</span>
                                </router-link>
                            </li>
                        </ul>

                        <h5>Member Types</h5>
                        <ul v-if="fetchMemberTypes">
                            <li>
                                <router-link :to="{name: 'MemberType', params: {
                                    member_type: 'deposit'
                                }}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>DPS All</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'MemberType', params: {
                                    member_type: 'loan'
                                }}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Loan All</span>
                                </router-link>
                            </li>
                            <li v-for="(member_type, i) in fetchMemberTypes" :key="i">
                                <router-link :to="{name: 'MemberType', params: {
                                    member_type: member_type.code
                                }}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>{{ member_type.name }} </span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navigation-item has-multimenu">
                <a href="#" class="menu-link" @click="openMultimenus">
<!--                    <i class='bx bxs-file-doc text-green-600' ></i>-->
                    <img src="../assets/images/nav-icons/cv.png" alt="">
                    <span>{{ $t('applications') }}</span>
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
                <router-link :to="{name: 'ExpenseList'}">
<!--                    <i class='bx bxs-user-badge text-red-600'></i>-->
                    <img src="../assets/images/nav-icons/expense.png" alt="">
                    <span>{{ $t('expense') }}</span>
                </router-link>
            </div>
            <div class="navigation-item">
                <router-link :to="{name: 'Admin'}">
<!--                    <i class='bx bxs-user-badge text-red-600'></i>-->
                    <img src="../assets/images/nav-icons/unauthorized-person.png" alt="">
                    <span>{{ $t('admins') }}</span>
                </router-link>
            </div>
            <div class="navigation-item has-multimenu">
                <a href="#" @click="openMultimenus">
<!--                    <i class='bx bxs-cog text-blue-600'></i>-->
                    <img src="../assets/images/nav-icons/admin.png" alt="">
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
                            <li>
                                <router-link :to="{name: 'ExpenseCategory'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Expense Categories</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navigation-item has-multimenu">
                <a href="#" class="menu-link" @click="openMultimenus">
<!--                    <i class='bx bxs-report text-orange-600' ></i>-->
                    <img src="../assets/images/nav-icons/report.png" alt="">
                    <span>{{ $t('reports') }}</span>
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

                        <h5>DPS Report</h5>
                        <ul>
                            <li>
                                <router-link :to="{name: 'TodayDpsReport'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Today's Transaction Reports</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'DpsReport'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>All Transaction Reports</span>
                                </router-link>
                            </li>
                        </ul>
                        <h5>Loan Reports</h5>
                        <ul>
                            <li>
                                <router-link :to="{name: 'TodayLoanReport'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>Today's Transaction Reports</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{name: 'LoanReport'}">
                                    <i class='bx bx-chevron-right'></i>
                                    <span>All Transaction Reports</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navigation-item">
                <router-link :to="{name: 'Profile'}">
<!--                    <i class="bx bxs-user-rectangle text-violet-600" ></i>-->
                    <img src="../assets/images/nav-icons/man.png" alt="">
                    <span>{{ $t('profile') }}</span>
                </router-link>
            </div>
            <div class="navigation-item">
                <a href="#" @click.prevent="logout">
<!--                    <i class='bx bxs-log-out text-cyan-500' ></i>-->
                    <img src="../assets/images/nav-icons/check-out.png" alt="">
                    <span>{{ $t('logout') }}</span>
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
            user: 'auth/user',
            groups: 'group/groups',
            memberTypes: 'group/member_types'
        }),

        fetchGroups() {
            if (this.groups) {
                return this.groups;
            } else {
                if (this.authenticated) {
                    this.getGroups().then(() => {
                        return this.groups;
                    })
                }
            }
        },

        fetchMemberTypes()
        {
            return this.memberTypes
        }
    },
    methods: {
        ...mapActions({
            signOut: 'auth/signOut',
            getGroups: 'group/getGroups'
        }),
        openMultimenus(event) {
            const _self = event.currentTarget;
            $(_self).closest('.has-multimenu').addClass('open');
        },

        closeMultimenus(event) {
            const _self = event.currentTarget;
            $(_self).closest('.has-multimenu').removeClass('open');
        },

        closeRsSidebar()
        {
            $('.wrapper').removeClass('rs-open-sidebar');
        },

        logout() {
            this.signOut().then(() => {
                this.$router.replace({
                    name: 'Signin'
                })
            })
        }
    },
    mounted() {
        if (!this.groups && this.authenticated) {
            this.getGroups();
        }
    }
})
</script>
