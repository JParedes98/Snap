<template>
    <div>
        <div class="table-responsive" v-if="snippets.length > 0">
            <b-table
                id="snippets_table"
                ref="snippets_table"
                striped
                hover
                fixed
                foot-clone
                responsive
                :items="snippets"
                :fields="fields"
                :per-page="perPage"
                :current-page="currentPage"
                @row-clicked="updateSnippet">


                <!--COLUMN TEMPLATES-->
                <template v-slot:cell(title)="data">
                    <h6 class="font-weight-bold">{{ data.item.title }}</h6>
                </template>

                <template v-slot:cell(is_private)="data">
                    <b-badge :variant="data.item.is_private ? 'primary' : 'dark'">
                        <h6 class="m-0 p-0">{{ data.item.is_private ? "Yes" : "No" }}</h6>
                    </b-badge>
                </template>

                <template v-slot:cell(options)="data">
                    <b-button @click="previewSnippet(data.item)" variant="primary" v-b-tooltip.hover title="Open Snippet" size="sm" class="d-inline-block">
                        <i class="far fa-eye"></i>
                    </b-button>
                    <b-button @click="copyToClipboard(data.item)" variant="info" v-b-tooltip.hover title="Copy Snippet" size="sm" class="d-inline-block">
                        <i class="far fa-copy"></i>
                    </b-button>
                    <b-button @click="updateSnippet(data.item)" variant="info" v-b-tooltip.hover title="Update Snippet" size="sm" class="d-inline-block">
                        <i class="fas fa-pencil-alt"></i>
                    </b-button>
                    <b-button @click="deleteSnippet(data.item)" variant="danger" v-b-tooltip.hover title="Delete Snippet" size="sm" class="d-inline-block">
                        <i class="far fa-trash-alt"></i>
                    </b-button>
                </template>
            </b-table>

            <b-pagination
                class="pagination-menu"
                v-model="currentPage"
                :total-rows="total"
                :per-page="perPage">
            </b-pagination>

            <copy-component ref="copyComponent"></copy-component>
        </div>

        <div v-else>
            <b-img-lazy src="/images/empty.svg" class="img-fluid empty-table-image" alt=""></b-img-lazy>
            <br>
            <h4 class="text-center font-weight-bold">No records found</h4>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import copyToClipboard from "../../../../components/CopyToClipboard";

export default {
    name: "ListAllSnippets",
    components: {
        'copy-component': copyToClipboard
    },
    data() {
        return {
            currentPage: 1,
            perPage: 10,
            fields: [
                { key: 'title',             label: 'Title',             sortable: true  },
                { key: 'description',       label: 'Description',       sortable: false },
                { key: 'is_private',        label: 'Is Private',        sortable: true  },
                { key: 'options',           label: 'Options',           sortable: false },
            ],
        }
    },
    created() {
        this.getSnippetsList()
    },
    computed: {
        ...mapState({
            snippets: state => state.snippets.list,
        }),
        total() {
            return this.snippets.length
        },
    },
    methods: {
        ...mapActions([
            'getSnippetsList',
            'deleteSnippet'
        ]),
        updateSnippet(snippet) {
            this.$emit('setSnippetToUpdate', snippet);
        },
        previewSnippet(snippet) {
            this.$emit('previewSnippet', snippet);
        },
        copyToClipboard(snippet) {
            this.$refs.copyComponent.copyToClipboard(snippet.html);
        }
    }
}
</script>

<style scoped>
.pagination-menu {
    float: right;
}

.empty-table-image {
    display: block;
    margin: auto;
    max-width: 350px;
}
</style>
