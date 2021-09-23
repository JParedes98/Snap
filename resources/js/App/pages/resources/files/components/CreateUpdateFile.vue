<template>
    <form @submit.prevent="submitForm">
        <div class="formg-roup">
            <h1 class="text-center text-muted font-weight-bold">
                <span v-html="windowTitle"></span>
            </h1>
        </div>

        <div class="formg-group">
            <label for="title">Title</label>
            <input v-model="file.title" type="text" id="title" :class="{ 'is-invalid': validation.hasError('file.title')}" class="form-control" placeholder="Enter the file title">
            <div class="text-danger font-weight-bold">{{ validation.firstError('file.title') }}</div>
        </div>

        <div class="formg-group">
            <label>PDF</label>
            <b-form-file accept=".pdf" v-model="file.pdf" :class="{ 'is-invalid': validation.hasError('file.pdf')}"></b-form-file>

            <div class="text-danger font-weight-bold">{{ validation.firstError('file.pdf') }}</div>
        </div>

        <div class="formg-group my-3">
            <label class="switch" v-b-tooltip.hover title="Should this file be public accessible?">
                <input v-model="file.isPrivate" type="checkbox" :checked="file.isPrivate">
                <span class="slider round"></span>
            </label>

            <label class="font-weight-bold text-muted">&nbsp;File is private</label>
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
    name: "CreateUpdateFile",
    props: {
        fileProp: {
            type: Object,
            default: function () {
                return {
                    id: '',
                    title: '',
                    pdf: null,
                    isPrivate: false,
                }
            },
            required: false
        },
    },
    created() {
        this.setFileObject(this.fileProp);
    },
    computed: {
        ...mapState({
            file: state => state.files.file,
        }),
        windowTitle() {
            if(this.fileProp) {
                return 'UPDATE <span class="text-primary">FILE</span>';
            } else {
                return 'UPLOAD <span class="text-primary">FILE</span>';
            }
        },
    },
    validators: {
        'file.title': function (value) {
            return Validator.value(value)
                .required('Title field is required.')
                .maxLength(125, 'Title field must be less then 125 characters.');
        },

        'file.pdf': function (value) {
            return Validator.value(value)
                .required('File pdf is required.');
        },
    },
    methods: {
        ...mapActions([
            'createUpdateFile'
        ]),
        ...mapMutations([
            'setFileObject'
        ]),
        async submitForm() {
            let validation = await this.$validate();

            if(validation) {
                await this.createUpdateFile()
                    .then(res => {
                        this.ShowMessagePopUp({
                            icon: 'success',
                            title: 'Great',
                            text: 'File stored successfully'
                        });
                        this.$emit('FileClose');
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

