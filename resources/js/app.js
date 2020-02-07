
require('./bootstrap');

window.Vue = require('vue');

Vue.config.ignoredElements = ['video-js'];

require('./components/subscribe-button');
require('./components/upload-video')

const app = new Vue({
    el: '#app',
});
