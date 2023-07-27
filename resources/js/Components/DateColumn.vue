<template>
    <div class="font-medium">
        <span class="text-gray-700 mb-1" :tooltip="Carbon.create(date).diffForHumans()">
            {{ Carbon.create(date).format('d/m/Y') }}
        </span>
    </div>
</template>

<script setup>
import { Carbon } from '@/Classes/Carbon.js';

const props = defineProps({
    date: {
        type: String, required: true
    }
})

</script>