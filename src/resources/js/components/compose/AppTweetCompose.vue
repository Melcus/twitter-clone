<template>
    <form class="flex">
        <div class="mr-3">
            <img :src="$user.avatar" class="w-12 rounded-full"/>
        </div>
        <div class="flex-grow">
            <textarea
                class="bg-gray-900 w-full outline-none text-gray-300 text-lg resize-none mb-2"
                placeholder="What's happening"
                autofocus
            ></textarea>
            <div class="flex justify-between">
                <div>
                    <!-- actions-->
                </div>
                <div>
                    <button type="submit"
                            class="bg-blue-500 rounded-full text-gray-300 text-center px-4 py-3 font-bold leading-none"
                    >
                        Twoot
                    </button>
                </div>

            </div>
        </div>
    </form>
</template>

<script>

</script>
