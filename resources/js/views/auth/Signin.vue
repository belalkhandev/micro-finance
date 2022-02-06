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
                    <form action="">
                        <div class="form-group">
                            <label>{{ $t('email') }}*</label>
                            <input type="email" name="email" :placeholder="$t('enter_email')" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{ $t('password') }}*</label>
                            <input type="password" name="password" :placeholder="$t('enter_password')" class="form-control">
                        </div>
                        <div class="form-group form-submit-group">
                            <button type="submit" class="btn btn-primary">{{ $t('signin') }}</button>
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
    export default ({

    })
</script>
