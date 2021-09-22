<template>
    <div>
        <div class="table-responsive" v-if="files.length > 0">
            <b-table
                id="files_table"
                ref="files_table"
                striped
                hover
                fixed
                foot-clone
                responsive
                :items="files"
                :fields="fields"
                :per-page="perPage"
                :current-page="currentPage"
                @row-clicked="updateFile">


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
                    <form action="/api/download" target="_blank" method="POST" class="m-o p-0 d-inline">
                        <input type="hidden" name="token" :value="token">
                        <input type="hidden" name="fileId" :value="data.item.id">
                        <input type="hidden" name="fileName" :value="data.item.location">

                        <b-button size="sm" type="submit" class="d-inline-block" variant="primary" v-b-tooltip.hover title="Download File">
                            <i class="fas fa-download"></i>
                        </b-button>
                    </form>

                    <b-button @click="updateFile(data.item)" variant="info" v-b-tooltip.hover title="Update File" size="sm" class="d-inline-block">
                        <i class="fas fa-pencil-alt"></i>
                    </b-button>
                    <b-button @click="deleteFile(data.item)" variant="danger" v-b-tooltip.hover title="Delete File" size="sm" class="d-inline-block">
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

export default {
    name: "ListAllFiles",
    data() {
        return {
            currentPage: 1,
            perPage: 10,
            fields: [
                { key: 'id',                label: 'ID',                sortable: true  },
                { key: 'title',             label: 'Title',             sortable: true  },
                { key: 'is_private',        label: 'Is Private',        sortable: true  },
                { key: 'options',           label: 'Options',           sortable: false },
            ],
        }
    },
    created() {
        this.getFilesList()
    },
    computed: {
        ...mapState({
            files: state => state.files.list,
        }),
        total() {
            return this.files.length
        },
        token() {
            return this.$store.getters.token;
        },
    },
    methods: {
        ...mapActions([
            'getFilesList',
            'deleteFile'
        ]),
        updateFile(file) {
            this.$emit('setFileToUpdate', file);
        },
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
