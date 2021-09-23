<template>
    <b-navbar toggleable="lg" type="dark" variant="primary">
        <b-container>
            <b-navbar-brand :to="{ name: 'app' }">
                <img src="/logo.png" alt="Snap App" class="navbar-logo">
            </b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav right class="ml-auto">
                    <b-nav-item :to="{ name: 'website_files' }">
                        <i class="far fa-file-alt"></i>&nbsp;Files
                    </b-nav-item>
                    <b-nav-item :to="{ name: 'website_snippets' }">
                        <i class="fas fa-code"></i>&nbsp;Snippets
                    </b-nav-item>
                    <b-nav-item :to="{ name: 'website_links' }">
                        <i class="fas fa-link"></i>&nbsp;Links
                    </b-nav-item>

                    <b-nav-item :to="{ name: 'app' }">
                        <i class="fas fa-user-shield"></i>&nbsp;ADMIN
                    </b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </b-container>
    </b-navbar>
</template>

<script>
export default {
    name: "WebsiteNavbar.vue",
}
</script>

<style scoped>
.navbar-logo {
    max-height: 30px;
}
</style>
