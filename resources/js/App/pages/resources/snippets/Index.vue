<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body rounded banner-card">
                    <h1 class="text-muted font-weight-bold">SNAP <span class="text-primary">SNIPPETS</span></h1>
                    <b-button pill variant="outline-primary" class="d-inline" v-b-modal.createUpdateSnippet>
                        <i class="fas fa-plus"></i>&nbsp;NEW SNIPPET
                    </b-button>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card card-body rounded">
                    <list-snippets
                        v-on:setSnippetToUpdate="setSnippetToUpdate"
                        v-on:previewSnippet="previewSnippet">
                    </list-snippets>
                </div>
            </div>
        </div>

        <b-modal id="createUpdateSnippet" ref="createUpdateSnippet" hide-header hide-footer centered size="xl">
            <manage-snippet v-if="snippet != null" :snippetProp="snippet"></manage-snippet>
            <manage-snippet v-else></manage-snippet>
        </b-modal>

        <b-modal id="previewSnippet" ref="previewSnippet" hide-header hide-footer centered size="xl">
            <div class="card" v-if="snippet">
                <div class="card-header">
                    <h5 class="text-center text-muted font-weight-bold">
                        {{ snippet.title }}
                    </h5>
                    <h6 class="text-center text-muted">{{ snippet.description }}</h6>
                </div>

                <div class="card-body">
                    <div v-html="snippet.html"></div>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
import ListAllSnippets from './components/ListAllSnippets.vue'
import CreateUpdateSnippet from './components/CreateUpdateSnippet.vue'

export default {
    name: "SnippetsIndex",
    data() {
        return {
            snippet: null
        }
    },
    components: {
        'list-snippets': ListAllSnippets,
        'manage-snippet': CreateUpdateSnippet
    },
    methods: {
        setSnippetToUpdate(snippet) {
            this.snippet = snippet;
            this.$bvModal.show('createUpdateSnippet', snippet);
        },
        previewSnippet(snippet) {
            this.snippet = snippet;
            this.$bvModal.show('previewSnippet', snippet);
        }
    }
}
</script>

<style lang="scss" scoped>
.banner-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-direction: row;
}

.rounded {
    border-radius: 15px !important;
}
</style>
