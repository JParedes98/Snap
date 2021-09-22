<template>
    <div class="container">
        <div class="row mt-3">
            <h3 class="text-muted font-weight-bold">
                PUBLIC <span class="text-primary">SNIPPETS</span>
            </h3>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card card-body rounded my-2" v-for="snippet in snippets" :key="snippet.id">
                    <h5 class="text-primary">{{ snippet.title }}</h5>
                    <p class="text-muted">
                        {{ snippet.description }}
                    </p>
                    <p>
                        <strong class="text-muted">Owner: {{ snippet.owner.name }}</strong>
                    </p>
                    <div>
                        <b-button @click="selectedSnippet = snippet" v-b-modal.previewSnippet class="d-inline-block" pill variant="primary" size="sm">
                            <i class="fas fa-eye"></i>&nbsp;Preview
                        </b-button>
                        <b-button @click="copyToClipboard(snippet)" class="d-inline-block" pill variant="primary" size="sm">
                            <i class="far fa-copy"></i>&nbsp;Copy
                        </b-button>
                    </div>
                </div>
            </div>
        </div>

        <b-modal id="previewSnippet" ref="previewSnippet" hide-header hide-footer centered size="xl">
            <div class="card" v-if="selectedSnippet">
                <div class="card-body">
                    <div v-html="selectedSnippet.html"></div>
                </div>
            </div>
        </b-modal>

        <copy-component ref="copyComponent"></copy-component>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import copyToClipboard from "../../components/CopyToClipboard";

export default {
    name: "Snippets",
    components: {
        'copy-component': copyToClipboard
    },
    data() {
        return {
            selectedSnippet: null,
        }
    },
    created() {
        this.GetList('snippets')
    },
    computed: {
        ...mapState({
            snippets: state => state.website.snippetsList,
        }),
    },
    methods: {
        ...mapActions([
            'GetList',
        ]),
        copyToClipboard(snippet) {
            this.$refs.copyComponent.copyToClipboard(snippet.html);
        }
    }
}
</script>
