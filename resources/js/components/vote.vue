<template>
    
    <div>
        <a @click="vote('up')" ><i class="fa fa-thumbs-up" :class="{'thumbs-up-active' : upVoted}"></i></a> {{ upVoteCount }}
        &nbsp;
        <a @click="vote('down')" ><i class="fa fa-thumbs-down" :class="{'thumbs-down-active' : downVoted}"></i></a> {{ downVoteCount }}
    </div>

</template>

<script>

import numeral from 'numeral'

export default {
    props: {
        default_vote: {
            required: true,
            default: () => []
        },
        entity_owner: {
            required: true,
            default: ''
        },
        entity_id: {
            required:true,
            deafault: ''
        }
    },

    data() {
        return {
            votes: this.default_vote
        }
    },

    computed: {
        upVote() {
            return this.votes.filter(v => v.type == 'up')
        },
        downVote() {
            return this.votes.filter(v => v.type == 'down')
        },
        upVoteCount() {
            return numeral(this.upVote.length).format('0a')
        },
        downVoteCount() {
            return numeral(this.downVote.length).format('0a')
        },
        upVoted() {
            if (!__auth()) return false

            return !!this.upVote.find(v => v.user_id === __auth().id)
        },
        downVoted() {
            if (!__auth()) return false

            return !!this.downVote.find(v => v.user_id === __auth().id)
        }
    },

    methods: {
        vote(type) {
            if (__auth() && __auth().id === this.entity_owner) {
                return alert('You cannot vote this item')
            } else if (!__auth()) {
                return alert('Please Log In to continue');
            }

            if (type === 'up' && this.upVoted) return

            if (type === 'down' && this.downVoted) return
                    console.log(this.upVoted)

            axios.get(`/vote/${this.entity_id}/${type}`)
            .then(({data}) => {
                if (this.upVoted || this.downVoted) {
                    this.votes = this.votes.map((v) => {
                        if (v.user_id === __auth().id) {
                            return data
                        }
                        return v
                    })
                } else {
                    this.votes = [
                        ...this.votes,
                        data
                    ]
                }
            })
        }
    },
}
</script>