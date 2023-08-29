<template>
    <AppLayout title="Dashboard" :breads="breads">

        <TableSection>
            <template #topbar>
                <div></div>
                <Link :href="route('dashboard.groups.create')" class="btn-primary">
                    Nuevo
                </Link>
            </template>

            <template #header>
                <th>ID</th>
                <th>Curso</th>
                <th>Docente</th>
                <th>Info.</th>
                <th>Suc.</th>
                <th>Accciones</th>
            </template>
            <template #body>
                <tr v-for="(group, index) in groups.data" class="hover:bg-gray-50">
                    <td>
                        {{ group.id }}
                    </td>
                    <td>
                        {{ group.course }}
                    </td>
                    <th>
                        <UserInformation :user="{ name: group.teacher }" />
                    </th>
                    <td>
                        {{ group.info }}
                    </td>
                    <td>
                        {{ group.branch.name }}
                    </td>
                    <td>
                        <div class="flex gap-4">
                            <Link :href="route('dashboard.groups.show', group.id)">
                                <IconEye />
                            </Link>

                            <Link :href="route('dashboard.groups.edit', group.id)">
                                <IconPencil />
                            </Link>
                        </div>
                    </td>
                </tr>
                <tr v-if="groups.length == 0">
                    <td colspan="6" class="text-center">No data to display</td>
                </tr>
            </template>
            <template #paginator>
                <ThePaginator :links="groups.links"/>
            </template>
        </TableSection>
    </AppLayout>
</template>

<script setup>
import TableSection from '@/Components/TableSection.vue';
import UserInformation from '@/Components/UserInformation.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { IconEye } from '@tabler/icons-vue';
import { IconPencil } from '@tabler/icons-vue';
import ThePaginator from "@/Components/ThePaginator.vue"

const props = defineProps({
    groups: {
        type: Object, required: true
    },
})

const breads = [
    { name: 'Dashboard', route: 'dashboard.index' },
    { name: 'Grupos', route: 'dashboard.groups.index' },
]

</script>