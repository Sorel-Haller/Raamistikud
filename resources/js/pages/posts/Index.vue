<script setup lang="ts">
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { index } from '@/routes/posts';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import { MoreVertical } from 'lucide-vue-next';
import { Button } from '@/components/ui/button'
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

defineProps<{
    posts: Post[]
}>()

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
                                            <<Button size="icon" variant="ghost">
                                                <MoreVertical />
                                            </Button>
                                        </DropdownMenuTrigger>
                                        <DropdownMenuContent>
                                            <DropdownMenuLabel>View</DropdownMenuLabel>
                                            <DropdownMenuItem>Edit</DropdownMenuItem>
                                            <DropdownMenuSeparator/>
                                            <DropdownMenuItem class="text-destructive">Delete</DropdownMenuItem>        
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
            </div>
        </div>
    </AppLayout>
</template>
