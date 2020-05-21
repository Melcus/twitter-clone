<template>
    <form class="flex" @submit.prevent="submit">

        <img :src="$user.avatar" class="mr-3 w-12 h-12 rounded-full"/>

        <div class="flex-grow">
            <app-tweet-compose-textarea
                v-model="form.body"
                placeholder="Add a comment"
            />

            <div class="flex justify-between">
                <ul class="flex items-center"></ul>
                <div class="flex items-center justify-end">
                    <div>
                        <app-tweet-compose-limit
                            class="mr-2"
                            :body="form.body"
                        />
                    </div>
                    <button type="submit"
                            class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
                    >
                        Retwoot
                    </button>
                </div>

            </div>
        </div>
    </form>
</template>

<script>
    import compose from '../../mixins/compose'
    import {mapActions} from 'vuex'

    export default {
        mixins: [
            compose
        ],

        props: {
            tweet: {
                required: true,
                type: Object
            }
        },

        methods: {

            ...mapActions({
                quoteTweet: 'timeline/quoteTweet'
            }),

            async post() {
                await this.quoteTweet({
                    tweet: this.tweet,
                    data: this.form
                })

                this.$emit('success')
            }
        }
    }

</script>
