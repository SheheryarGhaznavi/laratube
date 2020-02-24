<template>
    
    <div class="card mt-5 p-5">

        <div v-if="auth" class="form-inline my-4 w-full">
            <input v-model="newComment" type="text" class="form-control form-control-sm w-80">
            <button @click="add" class="btn btn-sm btn-primary">
                <small>Add Comment</small>
            </button>
        </div>
        <br>

        <SingleComment v-for="comment in comments.data" :key="comment.id" :comment="comment" />

        <div class="text-center">
            <button v-if="this.comments.next_page_url" @click="fetch()" class="btn btn-success">
                Load More
            </button>
            <span v-else> No More Comments </span>
        </div>
    </div>

</template>

<script>

import SingleComment from './single-comment.vue'

    export default {

        components: {
            SingleComment
        },

        props: ['video'],

        mounted() {
            this.fetch();
        },

        computed : {
            auth() {
                return __auth()
            }
        },

        data: () => ({
            comments: {
                data: []
            },
            newComment: ''
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
            },

            add() {
                if (!this.newComment) return

                axios.post(`/comment/${this.video.id}`,{
                    body: this.newComment
                }).then(({data}) => {
                    this.comments = {
                        ...this.comments,
                        data: [
                            data,
                            ...this.comments.data
                        ]
                    }
                })
            }
        },

    }
</script>