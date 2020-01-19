<div class="text-center">
    <subscribe-button :subscription="{{ $channel->subscription }}" inline-template>
        <button type="button" @click="toggleSubscription" class="btn btn-danger">
            Unsubscribe 7k
        </button>
    </subscribe-button>
</div>