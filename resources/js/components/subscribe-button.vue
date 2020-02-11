
<template>
    <button type="button" @click="toggleSubscription" class="btn btn-danger">
        {{ owner ? '' : subscribed ? 'Unsubscribe' : 'Subscribe' }} {{ count }} {{ owner ? 'Subscribers' : '' }}
    </button>
</template>

<script>
import numeral from 'numeral'

export default {
    props: {
        initialSubscription: {
            type: Array,
            required: true,
            default: () => []
        },
        channel: {
            type: Object,
            required: true,
            default: () => ({})
        }
    },
    data() {
        return {
            subscription: this.initialSubscription
        }
    },
    computed: {
        subscribed() {
            if(!__auth() || this.channel.user_id === __auth().id) return false;
            return !!this.subscribedUser;
        },
        owner() {
            if(__auth() && this.channel.user_id === __auth().id) return true;
            return false;
        },
        subscribedUser() {
            if(!__auth()) return false;
            return this.subscription.find(subscription => subscription.user_id === __auth().id);
        },
        count() {
            return numeral(this.subscription.length).format('0a');
        }
    },
    methods: {
        toggleSubscription() {
            if(! __auth()) {
                return alert('Please Log In to subscribe');
            }

            if (this.owner) {
                return alert('You cannot subscribe to your channel');
            }

            if (this.subscribed) {
                axios.delete(`/channel/${this.channel.id}/subscription/${this.subscribedUser.id}`)
                .then(response => {
                    this.subscription = response.data;
                });
            } else {
                axios.post(`/channel/${this.channel.id}/subscription`)
                .then(response => {
                    this.subscription = response.data;
                });
            }
        }
    }
}
</script>