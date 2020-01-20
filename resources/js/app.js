
require('./bootstrap');

window.Vue = require('vue');

require('./components/subscribe-button');
require('./components/upload-video')

const app = new Vue({
    el: '#app',
});
