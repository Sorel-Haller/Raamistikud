<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { create, store } from '@/routes/author';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, router } from '@inertiajs/vue3';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import Switch from '@/components/ui/switch/Switch.vue';
import Button from '@/components/ui/button/Button.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import InputError from '@/components/InputError.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Authors',
        href: create().url,
    },
];

const form = useForm({
    first_name: '',
    last_name: '',
    date_of_birth: '',
});

const submit = () => {
    form.post(store().url);
};

const destroy = () => {
    if (confirm('Are you sure you want to delete this author?')) {
        router.delete(store().url, {
            onSuccess: () => {
                router.visit('/author');
            },
        });
    }
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="max-w-2xl h-full mx-auto w-full">
                <h3 class="text-lg font-medium">Create author</h3>
                <form @submit.prevent="submit">
                    <div class="grid gap-4 mt-6">
                        <div>
                            <Label for="first_name">Title</Label>
                            <Input class="mt-1" name="last_name" v-model="form.last_name" />
                            <InputError :message="form.errors.last_name" />
                        </div>
                        <div>
                            <Label for="last_name">Title</Label>
                            <Input class="mt-1" name="last_name" v-model="form.last_name" />
                            <InputError :message="form.errors.last_name" />
                        </div>
                        <div>
                            <Label for="date_of_birth">Title</Label>
                            <Input class="mt-1" name="date_of_birth" v-model="form.date_of_birth" />
                            <InputError :message="form.errors.date_of_birth" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-2">
                        <Button type="submit">Save</Button>
                        <Button type="button" class="bg-red-500 hover:bg-red-600" @click="destroy">
                            Delete
                        </Button>
                    </div>
                </form>

                <pre>{{ form }}</pre>
            </div>
        </div>
    </AppLayout>
</template>
