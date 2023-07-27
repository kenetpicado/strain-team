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
                    <InputForm text="Tarifa" name="fee" v-model="form.fee" type="number"></InputForm>
                </div>
            </template>
            <template #footer>
                <button type="button" @click="resetValues" class="btn-secondary">
                    Cancelar
                </button>
                <button type="button" @click="savePromoter" class="btn-primary">
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
                <th>Status</th>
                <th>Fee</th>
                <th>Accciones</th>
            </template>
            <template #body>
                <tr v-for="(promoter, index) in promoters" class="hover:bg-gray-50">
                    <td>
                        {{ promoter.id }}
                    </td>
                    <th>
                        <UserInformation :user="promoter" />
                    </th>
                    <td>
                        {{ promoter.email }}
                    </td>
                    <td>
                        <span :class="[promoter.is_active ? 'badge-blue' : 'badge-red']" tooltip="Cambiar estado"
                            @click="confirmToggleStatus(promoter.id)" role="button">
                            {{ promoter.is_active ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td>
                        C$ {{ promoter.fee }}
                    </td>
                    <td>
                        <IconPencil @click="editPromoter(promoter)" role="button" />
                    </td>
                </tr>
                <tr v-if="promoters.length == 0">
                    <td colspan="6" class="text-center">No data to display</td>
                </tr>
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

const props = defineProps({
    promoters: {
        type: Object, required: true
    },
})

const openModal = ref(false)
const isNew = ref(true);

const breads = [
    { name: 'Dashboard', route: 'dashboard.index' },
    { name: 'Promotores', route: 'dashboard.promoters.index' },
]

const form = useForm({
    id: null,
    name: '',
    email: '',
    fee: 0
})

function editPromoter(promoter) {
    form.id = promoter.id;
    form.name = promoter.name;
    form.email = promoter.email;
    form.fee = promoter.fee;
    isNew.value = false;
    openModal.value = true;
}

function savePromoter() {
    if (isNew.value) {
        form.post(route('dashboard.promoters.store'), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Promotor creado correctamente!')
                resetValues()
            },
        });
    } else {
        form.put(route('dashboard.promoters.update', form.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Promotor actualizado correctamente!')
                resetValues()
            },
        });
    }
}

function confirmToggleStatus(id) {
    const data = {
        id: id,
        table: 'promoters'
    }

    confirmAction({
        title: 'Cambiar estado',
        message: '¿Estás seguro de cambiar el estado de este promotor?',
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