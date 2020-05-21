<template>
    <div class="text-gray-300 h-32">
        {{ notification.id }}
    </div>
</template>

<script>
    export default {
        props: {
            notification: {
                required: true,
                type: Object
            }
        }
    }
</script>
