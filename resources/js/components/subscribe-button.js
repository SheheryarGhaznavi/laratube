Vue.component('subscribe-button',{
    props: {
        subscription: {
            type: Array,
            required: true,
            default: () => []
        }
    },
    methods: {
        toggleSubscription() {
            if(! __auth()) {
                alert('Please Log In to subscribe');
            }
        }
    },
});