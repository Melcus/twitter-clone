<template>
    <div class="flex w-full border-b border-gray-800">
        <component :is="`Notification${notification.type}`" :notification="notification"/>
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
