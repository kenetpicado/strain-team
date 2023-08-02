<template>
    <AppLayout title="Dashboard" :breads="breads">
        <TableSection>
            <template #topbar>
                <div></div>
                <Link :href="route('dashboard.students.create')" class="btn-primary">
                Nuevo
                </Link>
            </template>

            <template #header>
                <th>ID</th>
                <th>Nombre</th>
                <th>Accciones</th>
            </template>
            <template #body>
                <tr v-for="(student, index) in students.data" class="hover:bg-gray-50">
                    <td>
                        {{ student.id }}
                    </td>
                    <th>
                        <UserInformation :user="student" />
                    </th>
                    <td>
                        <Link :href="route('dashboard.students.edit', student.id)">
                        <IconPencil />
                        </Link>
                    </td>
                </tr>
                <tr v-if="students.data.length == 0">
                    <td colspan="3" class="text-center">No data to display</td>
                </tr>
            </template>
        </TableSection>
    </AppLayout>
</template>

<script setup>
import TableSection from '@/Components/TableSection.vue';
import UserInformation from '@/Components/UserInformation.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { IconPencil } from '@tabler/icons-vue';

const props = defineProps({
    students: {
        type: Object, required: true
    },
})

const breads = [
    { name: 'Dashboard', route: 'dashboard.index' },
    { name: 'Estudiantes', route: 'dashboard.students.index' },
]

</script>