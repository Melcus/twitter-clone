<template>
    <a href="" class="flex items-center text-base" @click.prevent="likeOrUnlike">
        <inline-svg
            :src="`assets/svg/heart${liked ? '_full':''}.svg`"
            fill="black"
            width="24"
            height="24"
            class="fill-current text-gray-600  mr-2 w-5"
            :class="{
                'text-red-600' : liked
            }"
        />
        <span
            class="text-gray-600"
            :class="{
                'text-red-600' : liked
            }"
        >{{ tweet.likes_count }}</span>
    </a>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },
        computed: {

            ...mapGetters({
                likes: 'likes/likes'
            }),

            liked() {
                return this.likes.includes(this.tweet.id)
            }

        },
        methods: {

            ...mapActions({
                likeTweet: 'likes/likeTweet',
                unlikeTweet: 'likes/unlikeTweet',
            }),

            likeOrUnlike() {
                console.log(this.tweet)
                if (this.liked) {
                    this.unlikeTweet(this.tweet)
                    return
                }

                this.likeTweet(this.tweet)
            }
        }
    }
</script>
