<script setup lang="ts">
import { ref } from 'vue'
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
// import { login,dashboard } from '@/routes';
// import { store } from '@/routes/register';
import { router } from '@inertiajs/vue3';
import { useAuthStore } from '@/stores/authStore';
// import { useRouter } from 'vue-router';

const auth = useAuthStore();
// const router = useRouter();

const form = ref({
    first_name: '',
    middle_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const errors = ref({})
const processing = ref(false)

const submit = async () => {
    processing.value = true
    errors.value = {}

    try {
        await auth.register(form.value);
        await router.visit('/dashboard');

    } catch (err: any) {
        console.error(err)
        errors.value = err.errors || {}
    } finally {
        processing.value = false
    }
}
</script>

<template>
    <AuthBase
        title="Create an account"
        description="Enter your details below to create your account"
    >
        <Head title="Register" />
        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="name">Name</Label>
                    <Input
                        id="first_name"
                        type="text"
                        autofocus
                        :tabindex="1"
                        autocomplete="first_name"
                        name="first_name"
                        placeholder="First name"
                        v-model="form.first_name"
                    />
                    <div v-if="errors.first_name" class="text-red-500 text-sm space-y-1">
                        <div v-for="(errMsg, index) in errors.first_name" :key="index">
                            {{ errMsg }}
                        </div>
                    </div>
                </div>

                <div class="grid gap-2">
                    <Label for="name">Middle Name</Label>
                    <Input
                        id="middle_name"
                        type="text"
                        autofocus
                        :tabindex="1"
                        autocomplete="middle_name"
                        name="middle_name"
                        placeholder="Middle name"
                        v-model="form.middle_name"
                    />
                    <div v-if="errors.middle_name" class="text-red-500 text-sm space-y-1">
                        <div v-for="(errMsg, index) in errors.middle_name" :key="index">
                            {{ errMsg }}
                        </div>
                    </div>
                </div>
                <div class="grid gap-2">
                    <Label for="name">Middle Name</Label>
                    <Input
                        id="last_name"
                        type="text"
                        autofocus
                        :tabindex="1"
                        autocomplete="last_name"
                        name="last_name"
                        placeholder="Last name"
                        v-model="form.last_name"
                    />
                    <div v-if="errors.last_name" class="text-red-500 text-sm space-y-1">
                        <div v-for="(errMsg, index) in errors.last_name" :key="index">
                            {{ errMsg }}
                        </div>
                    </div>
                </div>

                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        :tabindex="2"
                        autocomplete="email"
                        name="email"
                        v-model="form.email"
                        placeholder="email@example.com"
                    />
                    <div v-if="errors.email" class="text-red-500 text-sm space-y-1">
                        <div v-for="(errMsg, index) in errors.email" :key="index">
                            {{ errMsg }}
                        </div>
                    </div>
                </div>

                <div class="grid gap-2">
                    <Label for="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        :tabindex="3"
                        autocomplete="new-password"
                        name="password"
                        v-model="form.password"
                        placeholder="Password"
                    />
                    <div v-if="errors.password" class="text-red-500 text-sm space-y-1">
                        <div v-for="(errMsg, index) in errors.password" :key="index">
                            {{ errMsg }}
                        </div>
                    </div>
                </div>

                <div class="grid gap-2">
                    <Label for="password_confirmation">Confirm password</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        :tabindex="4"
                        autocomplete="new-password"
                        name="password_confirmation"
                        placeholder="Confirm password"
                        v-model="form.password_confirmation"
                    />
                    <div v-if="errors.password_confirmation" class="text-red-500 text-sm space-y-1">
                        <div v-for="(errMsg, index) in errors.password_confirmation" :key="index">
                            {{ errMsg }}
                        </div>
                    </div>
                </div>

                <Button
                    type="submit"
                    class="mt-2 w-full"
                    tabindex="5"
                    :disabled="processing"
                    data-test="register-user-button"
                >
                    <Spinner v-if="processing" />
                    Create account
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Already have an account?
                <TextLink
                    :href="login()"
                    class="underline underline-offset-4"
                    :tabindex="6"
                    >Log in</TextLink
                >
            </div>
        </Form>
    </AuthBase>
</template>
