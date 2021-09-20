import App from './App/App.vue';
import './App/Libraries';
import './App/Mixins';
import router from './App/Router';
import store from './App/Store';

// SET GLOBALLY
window.Vue = require("vue").default;

// RUN APP
new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
