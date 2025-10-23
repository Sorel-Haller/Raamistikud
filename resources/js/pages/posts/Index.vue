<script setup lang="ts">
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/Table.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { index } from '@/routes/posts';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: index().url,
    },
];

type Post = {
    id: number;
    title: string;
    content: string;
    author: string;
    published: boolean;
    created_at: string;
    updated_at: string;
    created_at_formated: string;
    updated_at_formated: string;
}

defineProps<(
    posts: any
)>()

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="max-w-2xl h-full mx-auto w-full">
                <ul>
                    <li v-for="post in posts" :key="post.id" class="mb-4 p-4 border rounded-lg">
                        <li v-for="(post, index) in posts" :key="index">
                            {{ post.title }}
                        </li>
                    </li>
                    <table>

                    </table>
            </div>
        </div>
    </AppLayout>
</template>
