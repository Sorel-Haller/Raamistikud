<script setup lang="ts">
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/vue3';
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
import { Button } from '@/components/ui/button';
import {
  Pagination,
  PaginationContent,
  PaginationEllipsis,
  PaginationItem,
  PaginationNext,
  PaginationPrevious,
} from '@/components/ui/pagination';
import { destroy, edit } from '@/routes/profile';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts', 
        href: index().url,
    },
];

export type Post = {
    id: number;
    title: string;
    content: string;
    author: {
        id: number;
        first_name: string;
        last_name: string;
    };
    published: boolean;
    created_at: string;
    updated_at: string;
    created_at_formated: string;
    updated_at_formated: string;
}

interface PaginationLink {
  url: string | null;
  label: string;
  page?: number | null;
  active: boolean;
}

interface PaginatedResponse {
  current_page: number;
  data: Post[];
  first_page_url: string;
  from: number;
  last_page: number;
  last_page_url: string;
  links: PaginationLink[];
  next_page_url: string | null;
  path: string;
  per_page: number;
  prev_page_url: string | null;
  to: number;
  total: number;
}

const deletePost = (postId: number) => {
    router.delete(destroy)
}

defineProps<{
    posts: PaginatedResponse
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
                            <TableRow v-for="post in posts.data" :key="post.id">
                                <TableCell class="font-medium">{{ post.id }}</TableCell>
                                <TableCell>{{ post.title }}</TableCell>
                                <TableCell>{{ post.author.first_name }} {{ post.author.last_name }}</TableCell>
                                <TableCell>{{ post.created_at_formated }}</TableCell>
                                <TableCell>{{ post.updated_at_formated }}</TableCell>
                                <TableCell>{{ post.published }}</TableCell>
                                <TableCell>
                                    <DropdownMenu>
                                        <DropdownMenuTrigger>
                                            <Button size="icon" variant="ghost">
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

                    <Pagination 
                        class="w-full"
                        :page="posts.current_page"
                        v-slot="{ page }" 
                        :items-per-page="posts.per_page" 
                        :total="posts.total"
                        @update:page="(page) => router.get(index().url, { page })"
                        :default-page="2">
                        <PaginationContent v-slot="{ items } ">
                        <PaginationPrevious />

                        <template v-for="(item, index) in items" :key="index">
                            <PaginationItem
                            v-if="item.type === 'page'"
                            :value="item.value"
                            :is-active="item.value === page"
                            >
                            {{ item.value }}
                            </PaginationItem>
                        </template>

                        <PaginationEllipsis :index="6" />

                        <PaginationNext />
                        </PaginationContent>
                    </Pagination>
            </div>
        </div>
    </AppLayout>
</template>
