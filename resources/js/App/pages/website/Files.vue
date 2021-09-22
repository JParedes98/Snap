<template>
    <div class="container">
        <div class="row mt-3">
            <h3 class="text-muted font-weight-bold">
                PUBLIC <span class="text-primary">FILES</span>
            </h3>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card card-body rounded my-2" v-for="file in files" :key="file.id">
                    <div class="d-flex justify-content-between align-items-center flex-row">
                        <h5 class="text-primary">{{ file.title }}</h5>
                        <div class="d-block">
                            <form action="/api/download" target="_blank" method="POST">
                                <input type="hidden" name="token" :value="token">
                                <input type="hidden" name="fileId" :value="file.id">
                                <input type="hidden" name="fileName" :value="file.location">

                                <b-button size="sm" type="submit" class="my-3" pill variant="primary">
                                    <i class="fas fa-download"></i>&nbsp;Download
                                </b-button>
                            </form>
                        </div>
                    </div>
                    <small class="text-muted">Owner: {{ file.owner.name }}</small>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    name: "Files",
    created() {
        this.GetList('files')
    },
    computed: {
        ...mapState({
            files: state => state.website.filesList,
        }),
        token() {
            return this.$store.getters.token;
        },
    },
    methods: {
        ...mapActions([
            'GetList',
        ]),
    }
}
</script>


