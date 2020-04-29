<template>
    <div>
        <input
            type="file"
            :id="id"
            class="hidden"
            multiple
            @change="$emit('selected', $event.target.files)"
        >

        <label :for="id" class="cursor-pointer">
            <inline-svg
                :src="`assets/svg/media.svg`"
                fill="black"
                width="24"
                height="24"
                class="fill-current text-blue-500  mr-2 w-5"
            />
        </label>
    </div>
</template>

<script>
    export default {
        props: {
            id: {
                required: true,
                type: String
            }
        }
    }
</script>
