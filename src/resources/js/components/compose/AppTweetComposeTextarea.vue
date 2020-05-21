<template>
     <textarea
         class="bg-gray-900 w-full outline-none text-gray-300 text-lg resize-none mb-2"
         autofocus
         @input="input"
         :value="value"
     ></textarea>
</template>

<script>
    export default {
        props: {
            value: {
                required: false
            }
        },
        methods: {
            input(e) {
                this.$emit('input', e.target.value);
                this.resize(e)
            },

            resize(e) {
                e.target.style.height = 'auto'
                e.target.style.height = `${e.target.scrollHeight}px`
            }
        }
    }
</script>
