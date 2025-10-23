<script setup lang="ts">
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/Table.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { index } from '@/routes/posts';
import DropdownMenuTrigger from '@/components/ui/dropdown-menu/DropdownMenuTrigger.vue';
import DropdownMenuSeparator from '@/components/ui/dropdown-menu/DropdownMenuSeparator.vue';
import DropdownMenuItem from '@/components/ui/dropdown-menu/DropdownMenuItem.vue';

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
            <div class="max-w-2xl flex flex-1 flex-col h-full mx-auto w-full overwlow-x-auto rounded-xl p-4">
                    <Table>
                        <TableCaption>
                            Recently edited posts
                        </TableCaption>
                        <TableHeader>
                            <TableRow>
                                <TableHead class="w-[180px]">Id</TableHead>
                                <TableHead>Title</TableHead>
                                <TableHead>Author</TableHead>
                                <TableHead class="text-right">Created at</TableHead>
                                <TableHead class="text-right">Updated at</TableHead>
                                <TableHead class="text-right">Published</TableHead>
                                <TableHead>
                                    <span class="sr-only">Actions</span>    
                                </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="post in posts" :key="post.id">
                                <TableCell class="font-medium">{{ post.id }}</TableCell>
                                <TableCell>{{ post.title }}</TableCell>
                                <TableCell>{{ post.author }}</TableCell>
                                <TableCell>{{ post.created_at_formated }}</TableCell>
                                <TableCell>{{ post.updated_at_formated }}</TableCell>
                                <TableCell>{{ post.published }}</TableCell>
                                <TableCell>
                                    <DropdownMenu>
                                        <DropdownMenuTrigger>
                                            <button size="icon" variant="ghost">
                                                <MoreVertical />
                                            </button>
                                        </DropdownMenuTrigger>
                                        <DropdownMenuContent>
                                            <DropdownMenuLabel>View</DropdownMenuLabel>
                                            <DropdownMenuItem>Edit</DropdownMenuItem>
                                            <DropdownMenuSeparator/>
                                            <DropdownMenuItem class="text-destructive">Delete</DropdownMenuItem>        
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                            </TableRow>
                        </TableBody>
                    </Table>
            </div>
        </div>
    </AppLayout>
</template>
