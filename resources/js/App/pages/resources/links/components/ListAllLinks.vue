<template>
<div>
    <div class="table-responsive" v-if="links.length > 0">
        <b-table
            id="links_table"
            ref="links_table"
            striped
            hover
            fixed
            foot-clone
            responsive
            :items="links"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            @row-clicked="updateLink">


            <!--COLUMN TEMPLATES-->
            <template v-slot:cell(title)="data">
                <h6 class="font-weight-bold">{{ data.item.title }}</h6>
            </template>

            <template v-slot:cell(url)="data">
                <a :href="data.item.url" :target="data.item.open_in_new_tab ? '_blank' : ''">
                    {{ data.item.url }}
                </a>
            </template>

            <template v-slot:cell(open_in_new_tab)="data">
                <b-badge :variant="data.item.open_in_new_tab ? 'primary' : 'dark'">
                    <h6 class="m-0 p-0">{{ data.item.open_in_new_tab ? "Yes" : "No" }}</h6>
                </b-badge>
            </template>

            <template v-slot:cell(is_private)="data">
                <b-badge :variant="data.item.is_private ? 'primary' : 'dark'">
                    <h6 class="m-0 p-0">{{ data.item.is_private ? "Yes" : "No" }}</h6>
                </b-badge>
            </template>

            <template v-slot:cell(options)="data">
                <b-button @click="openLink(data.item)" variant="primary" v-b-tooltip.hover title="Open Link" size="sm" class="d-inline-block">
                    <i class="fas fa-external-link-alt"></i>
                </b-button>
                <b-button @click="updateLink(data.item)" variant="info" v-b-tooltip.hover title="Update Link" size="sm" class="d-inline-block">
                    <i class="fas fa-pencil-alt"></i>
                </b-button>
                <b-button @click="confirmDelete(data.item)" variant="danger" v-b-tooltip.hover title="Delete Link" size="sm" class="d-inline-block">
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
    name: "ListAllLinks",
    data() {
        return {
            currentPage: 1,
            perPage: 10,
            fields: [
                { key: 'id',                label: 'ID',                sortable: true  },
                { key: 'title',             label: 'Title',             sortable: true  },
                { key: 'url',               label: 'Link URL',          sortable: true  },
                { key: 'open_in_new_tab',   label: 'Open in New Tab',   sortable: true  },
                { key: 'is_private',        label: 'Is Private',        sortable: true  },
                { key: 'options',           label: 'Options',           sortable: false },
            ],
        }
    },
    created() {
        this.getLinksList()
            .then(res => {
                console.log(res);
            })
            .catch(error => {
                this.ShowSnackBar({
                    icon: 'error',
                    title: 'Ups, something went wrong',
                    text: error.response.data.message
                })
            })
    },
    computed: {
        ...mapState({
            links: state => state.links.list,
        }),
        total() {
            return this.links.length
        },
    },
    methods: {
        ...mapActions([
            'getLinksList',
            'deleteLink'
        ]),
        async confirmDelete(link) {
            let confirmation = await Vue.swal({
                icon: "warning",
                title: "Are you sure?",
                text: "Do you sure you want to delete this link?",
                confirmButtonText: "Delete!",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancel",
            });
            if (confirmation.isConfirmed) {
                this.deleteLink(link)
                    .then(res => {
                        this.ShowMessagePopUp({
                            icon: 'success',
                            title: 'Great',
                            text: 'Link deleted successfully'
                        })
                    })
                    .catch(error => {
                        this.ShowSnackBar({
                            icon: 'error',
                            title: 'Ups, something went wrong',
                            text: error.response.data.message
                        })
                    })
            }
        },
        updateLink(link) {
            this.$emit('setLinkToUpdate', link);
        },
        openLink(link) {
            let target = link.open_in_new_tab ? '_blank' : '_self';
            window.open(link.url, target);
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
