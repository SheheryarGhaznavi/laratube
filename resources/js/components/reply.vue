<template>
    
    <div>
        <div class="media mt-3 my-3" v-for="reply in replies.data" :key="reply.id">
            
            <a href="" class="mr-3">
                <avatar class="mr-3" :size="50" :username=reply.user.name></avatar>
            </a>

            <div class="media-body">
                <h6 class="mt-0">{{reply.user.name}}</h6>
                <small>{{reply.body}}</small>
            </div>
        </div>
        <div v-if="comment.replyCount > 0 && replies.next_page_url" class="text-center">
            <button @click="fetch" class="btn btn-info">Load Replies</button>
        </div>
    </div>

</template>

<script>

import Avatar from 'vue-avatar'

export default {

    props: [
        'comment'
    ],

     components: {
        Avatar,
    },

    data() {
        return {
            replies : {
                data : [],
                next_page_url : `/comment/${this.comment.id}/reply`
            }
        }
    },

    methods: {
        fetch() {
            axios.get(this.replies.next_page_url)
            .then(({data}) => {
                this.replies = {
                    ...data,
                    data: [
                        ...this.replies.data,
                        ...data.data
                    ]
                }
            })
        },

        add(reply) {
            this.replies = {
                ...this.replies,
                data : [
                    reply,
                    ...this.replies.data
                ]
            }
        }
    }

}
</script>