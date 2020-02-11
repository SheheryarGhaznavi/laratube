
require('./bootstrap');

window.Vue = require('vue');

Vue.config.ignoredElements = ['video-js']

Vue.component('subscribe-button',require('./components/subscribe-button.vue').default)

Vue.component('vote',require('./components/vote.vue').default)

require('./components/upload-video')

const app = new Vue({
    el: '#app',
});
