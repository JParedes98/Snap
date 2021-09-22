<template>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body rounded banner-card">
                <h1 class="text-muted font-weight-bold">SNAP <span class="text-primary">LINKS</span></h1>
                <b-button pill variant="outline-primary" class="d-inline" v-b-modal.createUpdateLink>
                    <i class="fas fa-plus"></i>&nbsp;NEW LINK
                </b-button>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-body rounded">
                <list-links
                    v-on:setLinkToUpdate="setLinkToUpdate">
                </list-links>
            </div>
        </div>
    </div>

    <b-modal id="createUpdateLink" ref="createUpdateLink" hide-header hide-footer centered size="sm">
        <manage-link v-if="link != null" :linkProp="link"></manage-link>
        <manage-link v-else></manage-link>
    </b-modal>
</div>
</template>

<script>
import ListAllLinks from './components/ListAllLinks.vue'
import CreateUpdateLink from './components/CreateUpdateLink.vue'

export default {
    name: "LinksIndex",
    data() {
        return {
            link: null
        }
    },
    components: {
        'list-links': ListAllLinks,
        'manage-link': CreateUpdateLink
    },
    methods: {
        setLinkToUpdate(link) {
            this.link = link;
            this.$bvModal.show('createUpdateLink', link);
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
