<template>
    <AppLayout title="Grupo" :breads="breads">
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <FormSection @submitted="saveGroup">
                <template #title>
                    Crear nuevo grupo
                </template>

                <template #description>
                    Ingrese la informacion del grupo
                </template>

                <template #form>
                    <SelectForm v-model="form.course_id" text="Curso" name="course_id" disabled>
                        <option value="">Seleccionar curso</option>
                        <option v-for="course in courses" :value="course.id">{{ course.name }}</option>
                    </SelectForm>
                    <SelectForm v-model="form.teacher_id" text="Profesor" name="teacher_id">
                        <option value="">Seleccionar profesor</option>
                        <option v-for="teacher in teachers" :value="teacher.id">{{ teacher.name }}</option>
                    </SelectForm>
                    <InputForm text="Info" v-model="form.info"></InputForm>
                </template>

                <template #actions>
                    <Link :href="route('dashboard.groups.index')" class="btn-secondary">
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
import { watch } from 'vue'

const props = defineProps({
    teachers: {
        type: Object, required: true
    },
    courses: {
        type: Object, required: true
    },
    isNew: {
        type: Boolean, default: true
    }
})

const form = useForm({
    id: null,
    course_id: 1,
    teacher_id: null,
    info: '',
    branch_id: null
});

watch(() => form.teacher_id, (value) => {
    if (!value) return;

    const teacher = props.teachers.find(teacher => teacher.id == value);
    form.branch_id = teacher.branch_id;
})

const breads = [
    { name: 'Dashboard', route: 'dashboard.index' },
    { name: 'Grupos', route: 'dashboard.groups.index' },
    { name: props.isNew ? 'Crear' : 'Editar', route: 'dashboard.groups.create' },
]

function saveGroup() {
    if (props.isNew) {
        form.post(route('dashboard.groups.store'), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Grupo creado correctamente!');
                router.get(route('dashboard.groups.index'));
            }
        });
    } else {
        form.put(route('dashboard.groups.update', form.id), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success('Grupo actualizado correctamente!');
                router.get(route('dashboard.groups.index'));
            },
        });
    }
}

</script>