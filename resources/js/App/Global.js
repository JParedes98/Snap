import Vue from 'vue';
import Axios from 'axios';
import SimpleVueValidation from 'simple-vue-validator';

window.Vue = Vue;
window.axios = Axios;
window.Validator = SimpleVueValidation.Validator;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem('jwt_token');
