<template>
    <div class="box">
        <div class="box-header">
            <div class="box-title">
                <h5>Create Loan Application</h5>
            </div>
        </div>
        <div class="box-body"></div>
        <div class="box-footer"></div>
    </div>
</template>

<script>
import {mapGetters, mapActions} from "vuex";
import $ from 'jquery'

export default ({
    name: "Create",

    data() {
        return {
            form: {
                name: "",
                email: "",
                phone: "",
                password: "",
                password_confirmation: "",
                role_id: "",
                photo: null
            },
            errors: null,
            error: null,
        }
    },

    computed: {
        ...mapGetters({
            validation_errors: 'validation_errors',
            error_message: 'error_message',
        }),

        filterRoles(){
            return this.roles
        },
    },

    methods: {
        ...mapActions({

        }),

        handlePhoto(){
            this.form.photo = this.$refs.photo.files[0];
        },

        storeUser() {
            $('#storeUser').prop('disabled', true).addClass('submitted')

            let formData = new FormData();
            let inputData = this.form

            Object.keys(inputData).forEach(fieldName => {
                formData.append(fieldName, inputData[fieldName]);
            })

            this.createUser(formData).then(() => {
                if (!this.validation_errors && !this.error_message) {
                    this.errors = this.error = null;
                    Object.assign(this.$data, this.$options.data.apply(this))

                    this.$swal({
                        icon: "success",
                        title: "Success!",
                        text: "Admin has been stored successfully",
                        timer: 3000
                    })
                } else {
                    this.errors = this.validation_errors
                    this.error = this.error_message
                }

                $('#storeUser').prop('disabled', false).removeClass('submitted')
            })

        }
    },

    mounted() {

    },
})
</script>

