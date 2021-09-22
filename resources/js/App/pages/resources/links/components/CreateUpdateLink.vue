<template>
<form @submit.prevent="submitForm">
    <div class="formg-roup">
        <h1 class="text-center text-muted font-weight-bold">
            <span v-html="windowTitle"></span>
        </h1>
    </div>

    <div class="formg-group">
        <label for="title">Title</label>
        <input v-model="link.title" type="text" id="title" :class="{ 'is-invalid': validation.hasError('link.title')}" class="form-control" placeholder="Enter the Link title">
        <div class="text-danger font-weight-bold">{{ validation.firstError('link.title') }}</div>
    </div>

    <div class="formg-group">
        <label for="url">URL</label>
        <input v-model="link.url" type="text" id="url" :class="{ 'is-invalid': validation.hasError('link.url')}" class="form-control" placeholder="Enter the Link URL">
        <div class="text-danger font-weight-bold">{{ validation.firstError('link.url') }}</div>
    </div>

    <div class="formg-group my-3">
        <label class="switch" v-b-tooltip.hover title="When clicked this link should be opened in new tab ?">
            <input v-model="link.openNewTab" type="checkbox" :checked="link.openNewTab">
            <span class="slider round"></span>
        </label>

        <label class="font-weight-bold text-muted">&nbsp;Open in new tab</label>
    </div>

    <div class="formg-group my-3">
        <label class="switch" v-b-tooltip.hover title="Should this Link be public accessible?">
            <input v-model="link.isPrivate" type="checkbox" :checked="link.isPrivate">
            <span class="slider round"></span>
        </label>

        <label class="font-weight-bold text-muted">&nbsp;Link is private</label>
    </div>

    <div class="form-group">
        <b-button type="submit" block pill variant="primary">
            SAVE
        </b-button>
    </div>
</form>
</template>

<script>
import {mapActions, mapState, mapMutations} from "vuex";

export default {
    name: "CreateUpdateLink",
    props: {
        linkProp: {
            type: Object,
            default: function () {
                return {
                    id: '',
                    title: '',
                    url: '',
                    openNewTab: false,
                    isPrivate: false,
                }
            },
            required: false
        },
    },
    created() {
        this.setLinkObject(this.linkProp);
    },
    computed: {
        ...mapState({
            link: state => state.links.link,
        }),
        windowTitle() {
            if(this.linkProp) {
                return 'UPDATE <span class="text-primary">LINK</span>';
            } else {
                return 'NEW <span class="text-primary">LINK</span>';
            }
        },
    },
    validators: {
        'link.title': function (value) {
            return Validator.value(value)
                .required('Title field is required.')
                .maxLength(125, 'Title field must be less then 125 characters.');
        },

        'link.url': function (value) {
            return Validator.value(value)
                .required('URL field is required.')
                .url('Please type a valid URL');
        },
    },
    methods: {
        ...mapActions([
            'createUpdateLink'
        ]),
        ...mapMutations([
            'setLinkObject'
        ]),
        async submitForm() {
            var validation = await this.$validate();

            if(validation) {
                await this.createUpdateLink();
            }
        }
    }
}
</script>

