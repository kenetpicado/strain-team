<template>
    <div class="flex gap-3 font-normal text-gray-900 items-center">
        <div class="h-10 w-10">
            <img class="h-full w-full rounded-full object-cover object-center" :src="getAvatarUrl(user.name)"
                alt="" />
        </div>
        <div class="text-sm">
            <div class="font-medium text-gray-700">{{ user.name }}</div>
            <!-- <div class="text-gray-400" v-if="user.phone">{{ user.phone }}</div>
            <div class="text-gray-400 text-xs mt-1" v-if="type">
                {{ typeList[type] }}
            </div> -->
        </div>
    </div>
</template>

<script setup>
import { getAvatarUrl } from "@/Use/helpers.js"

const props = defineProps({
    user: {
        type: Object, required: true
    },
    type: {
        type: String, required: false
    }
})

const typeList = {
    "App\\Models\\Employee": "Empleado",
    "App\\Models\\Customer": "Cliente"
}

</script>