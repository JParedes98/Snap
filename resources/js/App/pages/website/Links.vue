<template>
    <div class="container">
        <div class="row mt-3">
            <h3 class="text-muted font-weight-bold">
                PUBLIC <span class="text-primary">LINKS</span>
            </h3>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card card-body rounded my-2" v-for="link in links" :key="link.id">
                    <h4 class="text-center">
                        <a :href="link.url" :target="link.open_in_new_tab ? '_blank' : '_self'">
                            {{ link.title }}
                        </a>
                        <br>
                        <small class="text-muted">Owner: {{ link.owner.name }}</small>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    name: "Links",
    created() {
        this.GetList('links')
    },
    computed: {
        ...mapState({
            links: state => state.website.linksList,
        }),
    },
    methods: {
        ...mapActions([
            'GetList',
        ]),
    }
}
</script>

