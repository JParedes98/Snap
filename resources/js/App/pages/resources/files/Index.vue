<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body rounded banner-card">
                    <h1 class="text-muted font-weight-bold">SNAP <span class="text-primary">FILES</span></h1>
                    <b-button pill variant="outline-primary" class="d-inline" v-b-modal.createUpdateFile>
                        <i class="fas fa-upload"></i>&nbsp;UPLOAD
                    </b-button>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card card-body rounded">
                    <list-files
                        v-on:setFileToUpdate="setFileToUpdate">
                    </list-files>
                </div>
            </div>
        </div>

        <b-modal id="createUpdateFile" ref="createUpdateFile" hide-header hide-footer centered size="sm">
            <manage-file v-if="file != null" :fileProp="file"></manage-file>
            <manage-file v-else></manage-file>
        </b-modal>
    </div>
</template>

<script>
import ListAllFiles from './components/ListAllFiles.vue'
import CreateUpdateFile from './components/CreateUpdateFile.vue'

export default {
    name: "FilesIndex",
    data() {
        return {
            file: null
        }
    },
    components: {
        'list-files': ListAllFiles,
        'manage-file': CreateUpdateFile
    },
    methods: {
        setFileToUpdate(file) {
            this.file = file;
            this.$bvModal.show('createUpdateFile', file);
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
