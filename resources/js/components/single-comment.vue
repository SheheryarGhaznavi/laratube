<template>
    
    <div class="media">
        <avatar class="mr-3" :size="50" :username=comment.user.name></avatar>

        <div class="media-body">
            <h6 class="mt-0">{{ comment.user.name}}</h6>
            <small>{{ comment.body }}</small>

            <div class="d-flex">
                <vote :default_vote="comment.vote" :entity_id="comment.id" :entity_owner="comment.user.id"> </vote>
                <button @click="showReply = !showReply" class="btn btn-sm btn-default ml-2" :class="{ 'btn-default' : !showReply, 'btn-danger' : showReply }">
                    {{ showReply ? 'Cancel' : 'Add Reply' }}
                </button>
            </div>
            
            <div v-if="showReply" class="form-inline my-4 w-full">
                <input v-model="body" type="text" class="form-control form-control-sm w-80">
                <button @click="addReply" class="btn btn-sm btn-primary">
                    <small>Reply</small>
                </button>
            </div>

            <Reply ref="reply" :comment="comment"></Reply>

        </div>
    </div>

</template>

<script>


import Reply from './reply.vue'
import Avatar from 'vue-avatar'


export default {
    
    components : {
        Reply,
        Avatar
    },

    data() {
        return {
            body : '',
            showReply: false
        }
    },

    props : {
        comment : {
            required : true,
            default: () => ({})
        },
        video : {
            required : true,
            default: () => ({})
        }
    },

    methods : {
        addReply() {
            if (!this.body) return

            axios.post(`/comment/${this.video.id}`,{
                comment_id: this.comment.id,
                body: this.body
            }).then(({data}) => {
                this.$refs.reply.add(data)
                this.showReply = false
                this.body = ''
            })
        }
    }

}
</script>