<template>
    <div v-click-outside="close" class="relative">
        <div @click.prevent="open = !open">
            <slot name="trigger"/>
        </div>

        <div v-show="open" class="absolute bg-gray-900 z-50 rounded-l w-56 overflow-hidden shadow-light">
            <slot/>
        </div>
    </div>
</template>

<script>
    import ClickOutside from 'vue-click-outside'

    export default {
        directives: {
            ClickOutside
        },
        data() {
            return {
                open: false
            }
        },
        methods: {
            close() {
                this.open = false
            }
        }
    }
</script>
