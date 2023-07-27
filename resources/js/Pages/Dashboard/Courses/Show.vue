<template>
    <AppLayout title="Dashboard" :breads="breads">
        <DialogModal :show="openModal">
            <template #title>
                {{ isNew ? 'Nuevo' : 'Editar' }}
            </template>
            <template #content>
                <div class="grid gap-6">
                    <InputForm text="Nombre" name="name" v-model="form.name" required />
                </div>
            </template>
            <template #footer>
                <button type="button" @click="resetValues" class="btn-secondary">
                    Cancelar
                </button>
                <button type="button" @click="saveCourse" class="btn-primary">
                    Guardar
                </button>
            </template>
        </DialogModal>

        <TableSection>
            <template #topbar>
                <div></div>
                <button type="button" @click="openModal = true" class="btn-primary">
                    Nuevo
                </button>
            </template>

            <template #header>
                <th>ID</th>
                <th>Nombre</th>
                <th>Accciones</th>
            </template>
            <template #body>
                <tr v-for="(module, index) in course.modules" class="hover:bg-gray-50">
                    <td>
                        {{ module.id }}
                    </td>
                    <td>
                        <span class="font-bold">
                            {{ module.name }}
                        </span>
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <IconPencil @click="editModule(module)" role="button" />
                        </div>
                    </td>
                </tr>
                <tr v-if="course.modules.length == 0">
                    <td colspan="3" class="text-center">No data to display</td>
                </tr>
            </template>
        </TableSection>
    </AppLayout>
</template>

<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import TableSection from '@/Components/TableSection.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { toast } from "@/Use/helpers.js";
import { useForm } from '@inertiajs/vue3';
import { IconPencil } from '@tabler/icons-vue';
import { ref } from 'vue';

const props = defineProps({
    course: {
        type: Object, required: true
    },
})

const openModal = ref(false)
const isNew = ref(true);

const breads = [
    { name: 'Dashboard', route: 'dashboard.index' },
    { name: 'Cursos', route: 'dashboard.courses.index' },
    { name: props.course.name, route: 'dashboard.courses.show', params: props.course.id },
]

const form = useForm({
    id: null,
    name: '',
    course_id: props.course.id
})

function editModule(course) {
    form.id = course.id;
    form.name = course.name;
    isNew.value = false;
    openModal.value = true;
}

function saveCourse() {
    if (isNew.value) {
        form.post(route('dashboard.modules.store'), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Modulo creado correctamente!')
                resetValues()
            },
        });
    } else {
        form.put(route('dashboard.modules.update', form.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Modulo actualizado correctamente!')
                resetValues()
            },
        });
    }
}

function resetValues() {
    form.reset();
    isNew.value = true;
    openModal.value = false;
}

</script>