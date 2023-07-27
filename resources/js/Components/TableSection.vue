<template>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6 gap-4">
                <slot name="topbar" />
            </div>
            <div class="bg-white overflow-hidden shadow-soft-xl sm:rounded-lg">
                <slot name="options" />
                <div class="overflow-hidden rounded-lg m-0">
                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                        <thead class="bg-gray-50">
                            <tr>
                                <slot name="header" />
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                            <slot name="body" />
                        </tbody>
                    </table>
                </div>
                <slot name="paginator" />
            </div>
        </div>
    </div>
</template>

<script setup>

</script>