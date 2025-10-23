<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { WeatherData, type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

defineProps<{
    weather: WeatherData;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div
                    class="relative flex aspect-video flex-col justify-between overflow-hidden rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border"
                >
                    <div class="flex items-center justify-between text-2xl font-semibold text-gray-900 dark:text-white">
                        <span class="text-4xl">{{ weather.main.temp }}°C</span>
                    </div>

                    <ul class="">
                        <li class="flex items-center justify-between py-2">
                            <span class="flex items-center gap-2">
                                <img class="size-10" :src="`https://openweathermap.org/img/wn/${weather.weather[0].icon}@2x.png`" alt="" />
                                <span class="capitalize">{{ weather.weather[0].description }}</span>
                            </span>
                        </li>
                        <li class="flex items-center justify-between py-2">
                            <span class="flex items-center gap-2">
                                <span class="text-lg">💧</span>
                                <span>Niiskus</span>
                            </span>
                            <span class="font-medium">{{ weather.main.humidity }}%</span>
                        </li>
                        <li class="flex items-center justify-between py-2">
                            <span class="flex items-center gap-2">
                                <span class="text-lg">🌬️</span>
                                <span>Tuule kiirus</span>
                            </span>
                            <span class="font-medium">{{ weather.wind.speed }} m/s</span>
                        </li>
                    </ul>

                    <img class="size-20" :src="`https://openweathermap.org/img/wn/${weather.weather[0].icon}@2x.png`" alt="" />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
