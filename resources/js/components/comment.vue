<template>
    
    <div class="card mt-5 p-5">
        <div class="media" v-for="comment in comments.data" :key="comment.id">
            <avatar class="mr-3" :size="50" :username=comment.user.name></avatar>

            <div class="media-body">
                <h6 class="mt-0">{{ comment.user.name}}</h6>
                <small>{{ comment.body }}</small>
                
                <div class="form-inline my-4 w-full">
                    <input type="text" class="form-control form-control-sm w-80">
                    <button class="btn btn-sm btn-primary">
                        <small>Add Comment</small>
                    </button>
                </div>

                <div class="media mt-3">
                    
                    <a href="" class="mr-3">
                        <img src="https://picsum.photos/id/42/200/200" width="50" height="50" alt="" class="rounded-circle mr-3" >
                    </a>

                    <div class="media-body">
                        <h6 class="mt-0">Media Heading</h6>
                        <small>akshgriuw jhgadkfhgw kuugfiubds dshhf sdf dsf sd f sdf ds f sdaf sdgfsafg saf gsag sd afaf sdafsdafsdafas</small>
                        
                        <div class="form-inline my-4 w-full">
                            <input type="text" class="form-control form-control-sm w-80">
                            <button class="btn btn-sm btn-primary">
                                <small>Add Comment</small>
                            </button>
                        </div>
                    </div>

                </div>

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

import Avatar from 'vue-avatar'

    export default {

        components: {
            Avatar
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