<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { edit, update, show, index } from '@/routes/posts'; 
import { type BreadcrumbItem } from '@/types';
import { Head, useForm, router } from '@inertiajs/vue3';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import Switch from '@/components/ui/switch/Switch.vue';
import Button from '@/components/ui/button/Button.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import InputError from '@/components/InputError.vue';
import { NamespaceBody } from 'typescript';

// Props from controller
defineProps<{
    post: {
        id: number;
        first_name: NamespaceBody;
        last_name: NamespaceBody;
        date_of_birth: Date;
    };
}>();

const props = defineProps<{ post: any }>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Edit Post',
        href: edit(props.post.id).url,
    },
];

const form = useForm({
    title: props.post.title || '',
    content: props.post.content || '',
    author: props.post.author || '',
    published: props.post.published || false,
});

const submit = () => {
    form.put(update(props.post.id).url);
};

const destroy = () => {
    if (confirm('Are you sure you want to delete this post?')) {
        router.delete(update(props.post.id).url, {
            onSuccess: () => {
                router.visit(index().url);
            },
        });
    }
};
</script>

<template>
    <Head :title="`Edit Post - ${form.title}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="max-w-2xl h-full mx-auto w-full">
                <h3 class="text-lg font-medium">Edit Post</h3>
                <form @submit.prevent="submit">
                    <div class="grid gap-4 mt-6">
                        <div>
                            <Label for="first_name">First name</Label>
                            <Input class="mt-1" name="first_name" v-model="form.title" />
                            <InputError :message="form.errors.title" />
                        </div>
                        <div>
                            <Label for="last_name">Last name</Label>
                            <Input class="mt-1" name="last_name" v-model="form.title" />
                            <InputError :message="form.errors.title" />
                        </div>
                        <div>
                            <Label for="date_of_birth">Date of borth</Label>
                            <Input class="mt-1" name="date_of_birth" v-model="form.title" />
                            <InputError :message="form.errors.title" />
                        </div>

                    </div>
                    <div class="mt-6 flex justify-end space-x-2">
                        <Button type="submit">Update</Button>
                        <Button
                            type="button"
                            class="bg-red-500 hover:bg-red-600"
                            @click="destroy"
                        >
                            Delete
                        </Button>
                    </div>
                </form>

                <pre>{{ form }}</pre>
            </div>
        </div>
    </AppLayout>
</template>
