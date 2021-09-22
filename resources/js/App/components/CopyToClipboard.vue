<template>
<div>
    <input type="hidden" id="copyToClipboardInput">
</div>
</template>

<script>
export default {
    name: "CopyToClipboard",
    methods: {
        copyToClipboard (copyToClipboard) {
            let copyToClipboardInput = document.querySelector('#copyToClipboardInput');
            copyToClipboardInput.setAttribute('type', 'text');
            copyToClipboardInput.setAttribute('value', copyToClipboard);
            copyToClipboardInput.select()

            try {
                let successful = document.execCommand('copy');
                if(successful) {
                    this.ShowSnackBar({
                        icon: 'success',
                        title: 'Great.',
                        text: 'Copied to clipboard',
                    });
                }
            } catch (err) {
                this.ShowSnackBar({
                    icon: 'error',
                    title: 'Ups.',
                    text: 'something went wrong',
                });
            }

            copyToClipboardInput.setAttribute('type', 'hidden')
            window.getSelection().removeAllRanges()
        },
    },
}
</script>

<style scoped>

</style>
