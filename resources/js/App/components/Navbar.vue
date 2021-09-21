<template>
    <b-navbar toggleable="lg" type="dark" variant="primary">
        <b-container>
            <b-navbar-brand :to="{ name: 'app' }">
                <img src="/logo.png" alt="Snap App" class="navbar-logo">
            </b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav right class="ml-auto">
                    <b-nav-item :to="{ name: 'files' }">
                        <i class="far fa-file-alt"></i>&nbsp;Files
                    </b-nav-item>
                    <b-nav-item :to="{ name: 'snippets' }">
                        <i class="fas fa-code"></i>&nbsp;Snippets
                    </b-nav-item>
                    <b-nav-item :to="{ name: 'links' }">
                        <i class="fas fa-link"></i>&nbsp;Links
                    </b-nav-item>

                    <b-nav-item-dropdown right>
                        <template #button-content>
                            <i class="fas fa-envelope-open-text"></i>&nbsp;{{ user.name ? user.name : 'Account' }}
                        </template>
                        <b-dropdown-item @click="Logout">
                            <i class="fas fa-sign-out-alt"></i>&nbsp;Sign Out
                        </b-dropdown-item>
                        <b-dropdown-divider v-if="user.email"></b-dropdown-divider>
                        <b-dropdown-item v-if="user.email" disabled>
                            <small class="text-center">{{ user.email }}</small>
                        </b-dropdown-item>
                    </b-nav-item-dropdown>
                </b-navbar-nav>
            </b-collapse>
        </b-container>
    </b-navbar>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "Navbar.vue",
    methods: {
        Logout() {
            this.$store.dispatch('logout')
                .then( () => {
                    this.$router.push('/login')
                })
                .catch((error) => {
                    this.ShowMessagePopUp({
                        icon: 'error',
                        title: 'Ups, something went wrong.',
                        text: error.response.data.message
                    });
                });
        },
    },
    computed: {
        ...mapState({
            user: state => state.users.user,
        }),
    },
}
</script>

<style scoped>
.navbar-logo {
    max-height: 30px;
}
</style>
