<template>
    <div class="auth">
        <div class="container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <form @submit.prevent="Register" class="card card-body">
                        <div class="form-group">
                            <h3 class="card-title text-center text-muted font-weight-bold text-uppercase">WELCOME TO <br><span class="text-primary">SNAP</span></h3>
                            <p class="card-text font-weight-bold text-muted text-center">
                                Are you already in Snap?
                                <router-link to="/login" tag="a" class="text-primary text-decoration-none">Sign In</router-link>
                            </p>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-muted" for="given_name"><i class="fas fa-align-center"></i>&nbsp;NAME</label>
                            <input type="text" v-model="name" :class="{ 'is-invalid': validation.hasError('name')}" class="form-control required" id="given_name" placeholder="Ex: Jose Paredes">
                            <div class="text-danger font-weight-bold">{{ validation.firstError('name') }}</div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-muted" for="email"><i class="fas fa-envelope-open-text"></i>&nbsp;EMAIL</label>
                            <input type="email" v-model="email" :class="{ 'is-invalid': validation.hasError('email')}" class="form-control required" id="email" placeholder="ej: email@example.com">
                            <div class="text-danger font-weight-bold">{{ validation.firstError('email') }}</div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-muted" for="password"><i class="fas fa-unlock-alt"></i>&nbsp;PASSWORD</label>
                            <input type="password" v-model="password" :class="{ 'is-invalid': validation.hasError('password')}" class="form-control required" id="password" placeholder="Type here your password">
                            <div class="text-danger font-weight-bold">{{ validation.firstError('password') }}</div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold text-muted" for="repeat"><i class="fas fa-unlock-alt"></i>&nbsp;CONFIRM PASSWORD</label>
                            <input type="password" v-model="repeat" :class="{ 'is-invalid': validation.hasError('repeat')}" class="form-control required" id="repeat" placeholder="Repeat your password">
                            <div class="text-danger font-weight-bold">{{ validation.firstError('repeat') }}</div>
                        </div>

                        <b-button class="mb-2" pill block variant="primary" type="submit">SIGN UP</b-button>

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
            name: '',
            email: '',
            password: '',
            repeat: '',
        };
    },

    validators: {
        'name': function (value) {
            return Validator.value(value)
                .required('Name field is required.')
                .maxLength(250, 'Name field must be at least 250 characters.');
        },

        'email': function (value) {
            return Validator.value(value)
                .required('Email field is required.')
                .minLength(3, 'Email must be at least 3 characters.')
                .maxLength(255, 'Email must not be longer then 250 characters.')
                .email('Please type a valid email.');
        },

        'password': function (value) {
            return Validator.value(value)
                .required('Password field is required.')
                .minLength(8, 'Password field must be at least 8 characters.');
        },

        'repeat, password': function (repeat, password) {
            return Validator.value(repeat)
                .required('Please confirm your password.')
                .match(password, 'Password confirmation does not match.');
        }
    },

    methods: {
        async Register() {
            var validation = await this.$validate();

            if(validation) {
                this.$store.dispatch('show_hide_loader');

                var formData = new FormData();
                formData.append('name', this.name);
                formData.append('email', this.email);
                formData.append('password', this.password);
                formData.append('password_confirmation', this.repeat);

                axios.post('/api/auth/register', formData)
                    .then(res => {
                        this.ShowMessagePopUp({
                            icon: 'success',
                            title: 'Welcome to Snap',
                            text: 'We are very excited to see you around, hope you enjoy using Snap.'
                        });
                        this.$store.dispatch('show_hide_loader');
                        this.$router.push('/login');
                    })
                    .catch((error) => {
                        this.ShowMessagePopUp({
                            title: 'Ups, something went wrong.',
                            error: error.response.data.message,
                        });
                        this.$store.dispatch('show_hide_loader');
                    })
            } else {
                this.FormValidationFailed();
            }
        }
    }
}
</script>

<style scoped>
.auth {
    background: #0073D3;
}
</style>
