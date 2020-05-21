<template>
    <a
        href=""
        class="flex items-center text-base"
        @click.prevent="$modal.show(TweetReplyModal, {tweet})"
    >
        <inline-svg
            src="assets/svg/comment.svg"
            width="24"
            height="24"
            class="fill-current text-gray-600  mr-2 w-5"
        />
        <span class="text-gray-600">{{ tweet.replies_count }}</span>
    </a>
</template>

<script>
    import TweetReplyModal from "../../modals/TweetReplyModal";

    export default {
        props: {
            tweet: {
                required: true,
                type: Object
            }
        },
        data() {
            return {
                TweetReplyModal
            }
        }
    }
</script>
