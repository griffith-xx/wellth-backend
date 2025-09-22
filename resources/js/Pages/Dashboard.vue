<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import Button from "primevue/button";
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="flex gap-4">
            <Button variant="link" asChild v-slot="slotProps">
                <Link :class="slotProps.class" :href="route('provinces.index')">
                    จังหวัด
                </Link>
            </Button>
            <Button variant="link" asChild v-slot="slotProps">
                <Link
                    :class="slotProps.class"
                    :href="route('destinations.index')"
                >
                    สถานที่ท่องเที่ยว
                </Link>
            </Button>
        </div>
    </AppLayout>
</template>
