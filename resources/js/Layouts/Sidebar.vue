<template>
    <aside class="w-72 min-h-screen p-0 m-0 bg-white flex flex-col border">
        <div class="h-full px-3 py-4 overflow-y-auto">
            <div class="flex flex-col items-center mt-4 mb-6">
                <div class="h-14 w-14">
                    <img class="h-full w-full" src="/images/login.png" alt="" />
                </div>
            </div>
            <ul class="space-y-2">
                <li v-for="item in items">
                    <span v-if="item.header"
                        class="block text-xs text-gray-500 uppercase tracking-wider font-semibold mt-4 px-2">
                        {{ item.header }}
                    </span>
                    <Link v-else :href="item.route">
                    <span class="flex items-center px-2 py-3 rounded-lg gap-4" :class="getClass(item.route)">
                        <component :is="item.icon ?? DEFAULT_ICON"></component>
                        <span>{{ item.name }}</span>
                    </span>
                    </Link>
                </li>
                <li>
                    <span @click="logout" class="flex items-center px-2 py-3 rounded-lg gap-4 hover:bg-indigo-50"
                        role="button">
                        <IconLogout></IconLogout>
                        <span>Logout</span>
                    </span>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { IconUserCog } from '@tabler/icons-vue';
import { IconUsers } from '@tabler/icons-vue';
import { IconUserStar } from '@tabler/icons-vue';
import { IconBooks } from '@tabler/icons-vue';
import { IconHome, IconLogout, IconUser, IconUsersGroup, IconRun, IconStack, IconActivity, IconMoneybag, IconCurrencyDollarOff, IconBellZ, IconLayoutList } from '@tabler/icons-vue';

const DEFAULT_ICON = IconUser;

const logout = () => {
    // router.post(route('logout'));
};

const items = [
    {
        header: 'Inicio'
    },
    {
        name: 'Dashboard',
        route: route('dashboard.index'),
        icon: IconHome
    },
    {
        header: 'Administración'
    },
    {
        name: 'Promotores',
        route: route('dashboard.promoters.index'),
        icon: IconUserCog
    },
    {
        name: 'Cursos',
        route: route('dashboard.courses.index'),
        icon: IconBooks
    },
    {
        name: 'Profesores',
        route: route('dashboard.teachers.index'),
        icon: IconUserStar
    },
    {
        name: 'Grupos',
        route: route('dashboard.groups.index'),
        icon: IconUsersGroup
    },
    // {
    //     name: 'Expirados',
    //     route: route('dashboard.plans.expired'),
    //     icon: IconBellZ
    // },
    // {
    //     name: 'Personal',
    //     route: route('dashboard.employees.index'),
    //     icon: IconUsersGroup
    // },
    // {
    //     header: 'Sistema'
    // },
    // {
    //     name: 'Usuarios',
    //     route: route('dashboard.users.index'),
    //     icon: IconUsersGroup
    // },
    // {
    //     name: 'Servicios',
    //     route: route('dashboard.services.index'),
    //     icon: IconActivity
    // },
    // {
    //     header: 'Finanzas'
    // },
    // {
    //     name: 'Conceptos',
    //     route: route('dashboard.concepts.index'),
    //     icon: IconStack
    // },
    // {
    //     name: 'Ingresos',
    //     route: route('dashboard.finances.index', 'incomes'),
    //     icon: IconMoneybag
    // },
    // {
    //     name: 'Egresos',
    //     route: route('dashboard.finances.index', 'expenditures'),
    //     icon: IconCurrencyDollarOff
    // },
    // {
    //     name: 'Resumen',
    //     route: route('dashboard.summary.index'),
    //     icon: IconLayoutList
    // },
    // {
    //     header: 'Cuenta'
    // },
    // {
    //     name: 'Perfil',
    //     route: route('dashboard.profile.index')
    // },
]

function getClass(fullRoute) {
    return window.location.href == fullRoute
        ? 'bg-gray-800 text-white'
        : 'hover:bg-gray-100';
}

</script>