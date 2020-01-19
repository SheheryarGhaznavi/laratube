<div class="text-center">
    <subscribe-button :channel="{{ $channel }}" :initial-subscription="{{ $channel->subscription }}" inline-template>
        <button type="button" @click="toggleSubscription" class="btn btn-danger">
            @{{ owner ? '' : subscribed ? 'Unsubscribe' : 'Subscribe' }} @{{ count }} @{{ owner ? 'Subscribers' : '' }}
        </button>
    </subscribe-button>
</div>