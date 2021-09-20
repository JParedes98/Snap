import App from './App/App.vue';
import './App/Libraries';
import './App/Mixins';
import './App/Global';
import router from './App/Router';
import store from './App/Store';

// RUN APP
new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
