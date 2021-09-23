<template>
    <form @submit.prevent="submitForm">
        <div class="formg-roup">
            <h1 class="text-center text-muted font-weight-bold">
                <span v-html="windowTitle"></span>
            </h1>
        </div>

        <div class="formg-group">
            <label for="title">Title</label>
            <input v-model="snippet.title" type="text" id="title" :class="{ 'is-invalid': validation.hasError('snippet.title')}" class="form-control" placeholder="Enter the snippet title">
            <div class="text-danger font-weight-bold">{{ validation.firstError('snippet.title') }}</div>
        </div>

        <div class="formg-group">
            <label for="title">Description</label>
            <textarea v-model="snippet.description" :class="{ 'is-invalid': validation.hasError('snippet.description')}" rows="5" class="form-control" placeholder="Enter the snippet description">
        </textarea>
            <div class="text-danger font-weight-bold">{{ validation.firstError('snippet.description') }}</div>
        </div>

        <div class="formg-group my-3">
            <label class="switch" v-b-tooltip.hover title="Should this snippet be public accessible?">
                <input v-model="snippet.isPrivate" type="checkbox" :checked="snippet.isPrivate">
                <span class="slider round"></span>
            </label>

            <label class="font-weight-bold text-muted">&nbsp;Snippet is private</label>
        </div>

        <div class="formg-group">
            <label for="title">HTML Code</label>
            <textarea v-model="snippet.html" :class="{ 'is-invalid': validation.hasError('snippet.html')}" rows="15" class="form-control" placeholder="Enter the snippet code">
        </textarea>
            <div class="text-danger font-weight-bold">{{ validation.firstError('snippet.html') }}</div>
        </div>

        <div class="form-group border border-dark my-4">
            <div v-html="snippet.html"></div>
        </div>

        <div class="form-group">
            <b-button type="submit" block pill variant="primary" class="m-auto">
                SAVE
            </b-button>
        </div>
    </form>
</template>

<script>
import {mapActions, mapState, mapMutations} from "vuex";

export default {
    name: "CreateUpdateSnippet",
    props: {
        snippetProp: {
            type: Object,
            default: function () {
                return {
                    id: '',
                    title: '',
                    description: '',
                    isPrivate: false,
                    html: '',
                }
            },
            required: false
        },
    },
    created() {
        this.setSnippetObject(this.snippetProp)
    },
    computed: {
        ...mapState({
            snippet: state => state.snippets.snippet,
        }),
        windowTitle() {
            if(this.snippetProp) {
                return 'UPDATE <span class="text-primary">SNIPPET</span>';
            } else {
                return 'NEW <span class="text-primary">SNIPPET</span>';
            }
        },
    },
    validators: {
        'snippet.title': function (value) {
            return Validator.value(value)
                .required('Title field is required.')
                .maxLength(125, 'Title field must be less then 125 characters.');
        },

        'snippet.description': function (value) {
            return Validator.value(value)
                .required('Description field is required.')
                .maxLength(500, 'Description field must be less then 500 characters.');
        },

        'snippet.html': function (value) {
            return Validator.value(value)
                .required('HTML Code field is required.');
        },
    },
    methods: {
        ...mapActions([
            'createUpdateSnippet'
        ]),
        ...mapMutations([
            'setSnippetObject'
        ]),
        async submitForm() {
            let validation = await this.$validate();

            if(validation) {
                await this.createUpdateSnippet()
                    .then(res => {
                        this.ShowMessagePopUp({
                            icon: 'success',
                            title: 'Great',
                            text: 'Snippet stored successfully'
                        });
                        this.$emit('SnippetClose');
                    })
                    .catch(error => {
                        this.ShowSnackBar({
                            icon: 'error',
                            title: 'Ups, something went wrong',
                            text: error.response.data.message
                        });
                    })

            } else {
                this.FormValidationFailed();
            }
        }
    }
}
</script>
