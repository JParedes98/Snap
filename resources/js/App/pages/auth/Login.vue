<template>
    <div class="auth bg-1">
        <div class="container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <form @submit.prevent="Login" class="card card-body">

                        <div class="form-group">
                            <h3 class="card-title text-center text-muted font-weight-bold">SIGN <span class="text-primary">IN</span></h3>
                            <p class="card-text font-weight-bold text-muted text-center">
                                Don't you have an account yet?
                                <router-link to="signup" tag="a" class="text-primary text-decoration-none">Sign Up</router-link>
                            </p>
                        </div>

                        <div class="form-group mt-3">
                            <label class="font-weight-bold text-muted"><i class="fas fa-envelope-open-text"></i>&nbsp;EMAIL</label>
                            <input type="email" v-model="user.email" :class="{ 'is-invalid': validation.hasError('user.email')}" class="form-control required" placeholder="ej: email@example.com">
                            <div class="text-danger font-weight-bold">{{ validation.firstError('user.email') }}</div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-muted"><i class="fas fa-unlock-alt"></i>&nbsp;PASSWORD</label>
                            <input type="password" v-model="user.password" :class="{ 'is-invalid': validation.hasError('user.password')}" class="form-control required" placeholder="Type here your password">
                            <div class="text-danger font-weight-bold">{{ validation.firstError('user.password') }}</div>
                        </div>

                        <div class="form-group mt-3">
                            <b-button variant="primary" class="font-weight-bold" pill block type="submit">LOGIN</b-button>
                            <br>
                            <b-button :to="{ name: 'website_files' }" variant="dark" class="font-weight-bold" pill block type="button">
                                GO TO WEBSITE
                            </b-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            user: {
                email: null,
                password: null,

                errors: null
            }
        };
    },

    validators: {
        'user.email': function (value) {
            return Validator.value(value)
                .required('Email field is required.')
                .minLength(3, 'Email must be at least 3 characters.')
                .maxLength(255, 'Email must not be longer then 250 characters.')
                .email('Please type a valid email.');
        },

        'user.password': function (value) {
            return Validator.value(value)
                .required('Password field is required.')
                .minLength(8, 'Password field must be at least 8 characters.');
        },
    },

    methods: {
        async Login() {
            var validation = await this.$validate();

            if(validation) {
                this.$store.dispatch('show_hide_loader');

                var user = {
                    email: this.user.email,
                    password: this.user.password
                }

                this.$store.dispatch('login', user)
                    .then(() => {
                        this.$router.push('/app');
                        this.$store.dispatch('show_hide_loader');
                    })
                    .catch((error) => {
                        this.ShowMessagePopUp({
                            icon: 'error ',
                            title: 'Ups, something went wrong.',
                            text: error.response.data.message,
                        });
                        this.$store.dispatch('show_hide_loader');
                    });
            } else {
                this.FormValidationFailed();
            }
        }
    },
}
</script>

<style scoped>
.auth {
    background: #0073D3;
}
</style>
