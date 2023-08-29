<template>
    <AppLayout title="Dashboard" :breads="breads">

        <Loading v-model:active="form.processing" :is-full-page="true" />

        <DialogModal :show="openModal">
            <template #title>
                {{ isNew ? 'Nuevo' : 'Editar' }}
            </template>
            <template #content>
                <div class="grid gap-6">
                    <InputForm text="Nombre" name="name" v-model="form.name" required />
                    <InputForm text="Correo" name="email" v-model="form.email" type="email" required />
                    <SelectForm v-if="isNaN(branches)" v-model="form.branch_id" text="Sucursal" name="branch_id">
                        <option value="">Seleccionar sucursal</option>
                        <option v-for="branch in branches" :value="branch.id">{{ branch.name }}</option>
                    </SelectForm>
                </div>
            </template>
            <template #footer>
                <button type="button" @click="resetValues" class="btn-secondary">
                    Cancelar
                </button>
                <button type="button" @click="saveTeacher" class="btn-primary">
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
                <th>Email</th>
                <th>Suc.</th>
                <th>Status</th>
                <th>Accciones</th>
            </template>
            <template #body>
                <tr v-for="(teacher, index) in teachers.data" class="hover:bg-gray-50">
                    <td>
                        {{ teacher.id }}
                    </td>
                    <th>
                        <UserInformation :user="teacher" />
                    </th>
                    <td>
                        {{ teacher.email }}
                    </td>
                    <td>
                        {{ teacher.branch }}
                    </td>
                    <td>
                        <span :class="[teacher.is_active ? 'badge-blue' : 'badge-red']" tooltip="Cambiar estado"
                            @click="confirmToggleStatus(teacher.id)" role="button">
                            {{ teacher.is_active ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td>
                        <IconPencil @click="editTeacher(teacher)" role="button" />
                    </td>
                </tr>
                <tr v-if="teachers.length == 0">
                    <td colspan="6" class="text-center">No data to display</td>
                </tr>
            </template>
            <template #paginator>
                <ThePaginator :links="teachers.links"/>
            </template>
        </TableSection>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputForm from '@/Components/Form/InputForm.vue';
import { router, useForm } from '@inertiajs/vue3';
import UserInformation from '@/Components/UserInformation.vue';
import TableSection from '@/Components/TableSection.vue';
import { IconPencil } from '@tabler/icons-vue';
import { toast, confirmAction } from "@/Use/helpers.js";
import SelectForm from "@/Components/Form/SelectForm.vue";
import ThePaginator from "@/Components/ThePaginator.vue"

const props = defineProps({
    teachers: {
        type: Object, required: true
    },
    branches: {
        type: [Object, Number], required: true
    }
})

const openModal = ref(false)
const isNew = ref(true);

const breads = [
    { name: 'Dashboard', route: 'dashboard.index' },
    { name: 'Profesores', route: 'dashboard.teachers.index' },
]

const form = useForm({
    id: null,
    name: '',
    email: '',
    branch_id: !isNaN(props.branches) ? props.branches : null
})

function editTeacher(teacher) {
    form.id = teacher.id;
    form.name = teacher.name;
    form.email = teacher.email;
    isNew.value = false;
    openModal.value = true;
}

function saveTeacher() {
    if (isNew.value) {
        form.post(route('dashboard.teachers.store'), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Profesor creado correctamente!')
                resetValues()
            },
        });
    } else {
        form.put(route('dashboard.teachers.update', form.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Profesor actualizado correctamente!')
                resetValues()
            },
        });
    }
}

function confirmToggleStatus(id) {
    const data = {
        id: id,
        table: 'teachers'
    }

    confirmAction({
        title: 'Cambiar estado',
        message: '¿Estás seguro de cambiar el estado de este docente?',
        action: () => {
            router.put(route('dashboard.toggle-status'), data, {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    toast.success('Estado actualizado correctamente!')
                },
            });
        }
    })
}

function resetValues() {
    form.reset();
    isNew.value = true;
    openModal.value = false;
}

</script>