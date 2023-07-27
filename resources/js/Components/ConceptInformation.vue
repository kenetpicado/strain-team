<template>
    <div class="flex gap-3 font-normal text-gray-900 items-center">
        <div style="background-color: #eef2ff; color:#4f46e5"
            class="rounded-full h-10 w-10 flex items-center justify-center">
            <component :is="conceptComponents[concept.name] ?? DEFAULT_ICON"></component>
        </div>

        <div class="text-sm">
            <div class="font-medium text-gray-700">{{ concept.name }}</div>
        </div>
    </div>
</template>

<script setup>
import {
    IconDroplet,
    IconBottle,
    IconBolt,
    IconWifi,
    IconShoppingCart,
    IconBrandFacebook,
    IconUserDollar,
    IconSpray,
    IconBarbell,
    IconInfoCircle,
    IconFile,
    IconPill,
    IconActivity,
    IconFileDollar
} from '@tabler/icons-vue';

const props = defineProps({
    concept: {
        type: Object, required: true
    }
})

const DEFAULT_ICON = IconInfoCircle;

const conceptComponents = {
    Agua: IconDroplet,
    Bebidas: IconBottle,
    Energia: IconBolt,
    Internet: IconWifi,
    Tienda: IconShoppingCart,
    Publicidad: IconBrandFacebook,
    Limpieza: IconUserDollar,
    'Articulos de limpieza': IconSpray,
    'Equipo y maquinaria': IconBarbell,
    Papeleria: IconFile,
    Suplementos: IconPill,
    Servicios: IconActivity,
    Impuestos: IconFileDollar
}

</script>