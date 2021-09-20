var SweetAlertMixin = {
    methods: {
        ShowMessagePopUp(options) {
            let icon    = options.icon  ? options.icon  : 'error';
            let title   = options.title ? options.title : '';
            let text    = options.text  ? options.text  : '';
            let timer   = options.timer ? options.timer : 4000;

            Vue.swal({
                icon: icon,
                title: title,
                text: text,
                showConfirmButton: false,
                timer: timer,
                timerProgressBar: true,
            });
        },

        ShowSnackBar(options) {
            let icon    = options.icon  ? options.icon  : 'error';
            let title   = options.title ? options.title : '';
            let text    = options.text  ? options.text  : '';
            let timer   = options.timer ? options.timer : 4000;

            Vue.swal({
                toast: true,
                icon: icon,
                title: title,
                text: text,
                position: "bottom-end",
                showConfirmButton: false,
                timer: timer,
                timerProgressBar: true,
            });
        },

        FormValidationFailed() {
            Vue.swal({
                toast: true,
                icon: 'warning',
                title: '¡Ups!',
                text: 'Form input validation failed, Please field all the data properly.',
                position: "bottom-end",
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            });
        },
    },
}

export default SweetAlertMixin;
