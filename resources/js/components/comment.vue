<template>
    
    <div class="card mt-5 p-5">

        <div class="form-inline my-4 w-full">
            <input type="text" class="form-control form-control-sm w-80">
            <button class="btn btn-sm btn-primary">
                <small>Add Comment</small>
            </button>
        </div>
        <br>
        <div class="media" v-for="comment in comments.data" :key="comment.id">
            <avatar class="mr-3" :size="50" :username=comment.user.name></avatar>

            <div class="media-body">
                <h6 class="mt-0">{{ comment.user.name}}</h6>
                <small>{{ comment.body }}</small>
                
                <div class="form-inline my-4 w-full">
                    <input type="text" class="form-control form-control-sm w-80">
                    <button class="btn btn-sm btn-primary">
                        <small>Reply</small>
                    </button>
                </div>

                <Reply :comment="comment"></Reply>

            </div>
        </div>

        <div class="text-center">
            <button v-if="this.comments.next_page_url" @click="fetch()" class="btn btn-success">
                Load More
            </button>
            <span v-else> No More Comments </span>
        </div>
    </div>

</template>

<script>

import Reply from './reply.vue'
import Avatar from 'vue-avatar'

    export default {

        components: {
            Avatar,
            Reply
        },

        props: ['video'],

        mounted() {
            this.fetch();
        },

        data: () => ({
            comments: {
                data: []
            }
        }),

        methods: {
            fetch() {
                const url = this.comments.next_page_url ? this.comments.next_page_url : `/video/${this.video.id}/comment`
                axios.get(url)
                .then(({data}) => {
                    this.comments = {
                        ...data,
                        data: [
                            ...this.comments.data,
                            ...data.data
                        ]
                    }
                })
            }
        },

    }
</script>