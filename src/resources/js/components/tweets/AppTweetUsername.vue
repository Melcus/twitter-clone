<template>
    <span class="text-gray-300 font-bold">{{ user.name }}<span
        class="text-gray-600">@{{ user.username }}</span></span>
</template>

<script>
    export default {
        props: {
            user: {
                required: true,
                type: Object
            }
        }
    }
</script>
