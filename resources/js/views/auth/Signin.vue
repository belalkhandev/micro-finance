<template>
    <div class="auth-wrap">
        <div class="auth">
            <div class="auth-box">
                <div class="auth-header">
                    <div class="logo flex justify-content-center align-items-center">
                        <img src="../../assets/images/logo.png" alt="">
                    </div>
                    <h1>{{ $t('auth_welcome') }}</h1>
                </div>
                <div class="auth-body">
                    <form @submit.prevent="loginSubmit">
                        <span class="text-danger" v-if="error">{{ error }}</span>
                        <div class="form-group">
                            <label>{{ $t('email') }}*</label>
                            <input type="email" v-model="form.email" :placeholder="$t('enter_email')" class="form-control">
                            <span class="text-danger" v-if="errors">{{ errors.email ? errors.email[0] : '' }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ $t('password') }}*</label>
                            <input type="password" v-model="form.password" :placeholder="$t('enter_password')" class="form-control">
                            <span class="text-danger" v-if="errors">{{ errors.password ? errors.password[0] : '' }}</span>
                        </div>
                        <div class="form-group form-submit-group">
                            <button type="submit" class="btn btn-primary" id="loginSubmit">
                                {{ $t('signin') }}
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="auth-footer"></div>
            </div>
        </div>
        <div class="auth auth-content">
            <div class="content">
                <h1>{{ $t('pdscdcsl') }}</h1>
                <h5>{{ $t('slogan') }}</h5>
                <img src="../../assets/images/graphic5.svg" alt="">
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    import $ from "jquery";
    export default ({
        name: 'Signin',
        data() {
            return {
                form: {
                    email: 'superadmin@becodezen.com',
                    password: 'password'
                },
                errors: null,
                error: null,
            }
        },
        computed: {
            ...mapGetters({
                validation_errors: 'validation_errors',
                error_message: 'error_message',
                user: 'auth/user'
            })
        },

        methods: {
            ...mapActions({
                signIn: 'auth/signIn'
            }),

            loginSubmit(){
                $('#loginSubmit').prop('disabled', true).addClass('submitted')

                this.signIn(this.form).then(() => {
                    if (!this.validation_errors && !this.error_message) {
                        this.errors = this.error = null;
                        if (this.user) {
                            this.$router.replace({
                                name: 'Dashboard'
                            })
                        }
                    }else {
                        this.errors = this.validation_errors;
                        this.error = this.error_message
                    }

                    $('#loginSubmit').prop('disabled', false).removeClass('submitted')
                });
            }
        }
    })
</script>
