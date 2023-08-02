<template>
    <AppLayout title="Grupo" :breads="breads">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submitted="saveStudent">
                <template #title>
                    Informacion del estudiante
                </template>

                <template #description>
                    Ingrese todos los datos personales del estudiante.
                </template>

                <template #form>
                    <InputForm required text="Nombre" name="name" v-model="form.name" />
                    <InputForm required text="Fecha de nacimiento" name="birth" v-model="form.birth" type="date" />
                    <InputForm text="Celular" name="phone" v-model="form.phone" type="number" />
                    <InputForm required text="Tutor" v-model="form.tutor" />
                    <InputForm required text="Grado" name="degree" v-model="form.degree" />
                    <InputForm text="Cedula" name="id_number" v-maska="'###-######-####A'" v-model="form.id_number" />
                    <SelectForm v-if="isNaN(branches)" v-model="form.branch_id" text="Sucursal" name="branch_id" required>
                        <option value="">Seleccionar sucursal</option>
                        <option v-for="branch in branches" :value="branch.id">{{ branch.name }}</option>
                    </SelectForm>
                </template>

                <template #actions>
                    <Link :href="route('dashboard.students.index')" class="btn-secondary">
                    Cancelar
                    </Link>
                    <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        class="btn-primary">
                        Guardar
                    </button>
                </template>
            </FormSection>
        </div>
    </AppLayout>
</template>

<script setup>
import InputForm from '@/Components/Form/InputForm.vue';
import SelectForm from "@/Components/Form/SelectForm.vue";
import FormSection from '@/Components/FormSection.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { toast } from '@/Use/helpers.js';
import { Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps({
    student: {
        type: Object, required: false
    },
    branches: {
        type: [Object, Number], required: true
    },
})

const form = useForm({
    id: props.student?.id ?? null,
    name: props.student?.name ?? '',
    birth: props.student?.birth ?? null,
    id_number: props.student?.phone ?? null,
    phone: props.student?.phone ?? null,
    tutor: props.student?.tutor ?? null,
    degree: props.student?.degree ?? null,
    branch_id: props.student?.branch_id ?? (!isNaN(props.branches) ? props.branches : null),
});

const breads = [
    { name: 'Dashboard', route: 'dashboard.index' },
    { name: 'Estudiantes', route: 'dashboard.students.index' },
    { name: !props.student ? 'Crear' : 'Editar', route: 'dashboard.students.create' },
]

function saveStudent() {
    if (!props.student) {
        form.post(route('dashboard.students.store'), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Estudiante creado correctamente!');
                router.get(route('dashboard.students.index'));
            }
        });
    } else {
        form.put(route('dashboard.students.update', form.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Estudiante actualizado correctamente!');
                router.get(route('dashboard.students.index'));
            },
        });
    }
}

</script>