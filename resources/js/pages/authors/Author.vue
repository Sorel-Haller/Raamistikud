<script setup lang="ts">
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/vue3';
import { index } from '@/routes/author';
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
        title: 'Authors', 
        href: index().url,
    },
];

type Author = {
    id: number;
    first_name: string;
    last_name: string;
    date_of_birth: Date;
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
  data: Author[];
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

const deleteAuthor = (authorId: number) => {
    router.delete(`/author/${authorId}`)
}

defineProps<{
    authors: PaginatedResponse
}>()

</script>

<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="max-w-2xl flex flex-1 flex-col h-full mx-auto w-full overwlow-x-auto rounded-xl p-4">
                    <Table>
                        <TableCaption>
                            Recently edited authors
                        </TableCaption>
                        <TableHeader>
                            <TableRow>
                                <TableHead class="w-[180px]">Id</TableHead>
                                <TableHead>First Name</TableHead>
                                <TableHead>Last Name</TableHead>
                                <TableHead>Date Of Birth</TableHead>
                                <TableHead class="text-right">Created at</TableHead>
                                <TableHead class="text-right">Updated at</TableHead>
                                <TableHead>
                                    <span class="sr-only">Actions</span>    
                                </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="author in authors.data" :key="author.id">
                                <TableCell class="font-medium">{{ author.id }}</TableCell>
                                <TableCell>{{ author.first_name }}</TableCell>
                                <TableCell>{{ author.last_name }}</TableCell>
                                <TableCell>{{ author.date_of_birth }}</TableCell>
                                <TableCell>{{ author.created_at_formated }}</TableCell>
                                <TableCell>{{ author.updated_at_formated }}</TableCell>
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
                        :page="authors.current_page"
                        v-slot="{ page }" 
                        :items-per-page="authors.per_page" 
                        :total="authors.total"
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
