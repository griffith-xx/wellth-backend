<script setup>
import InputError from "@/Components/InputError.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from '@inertiajs/vue3';
import { InputText, Button, Select } from "primevue";
import { ref } from "vue";
const form = useForm({
    name_th: '',
    name_en: '',
    region: '',
    code: '',
})
const regions = ref([
    {
        name: 'ภาคเหนือ',
        code: 'north'
    },
    {
        name: 'ภาคตะวันออกเฉียงเหนือ',
        code: 'northeast'
    },
    {
        name: 'ภาคกลาง',
        code: 'central'
    },
    {
        name: 'ภาคตะวันออก',
        code: 'east'
    },
    {
        name: 'ภาคตะวันตก',
        code: 'west'
    },
    {
        name: 'ภาคใต้',
        code: 'south'
    }
])
const submit = () => {
    form.post(route('provinces.store'))
}
</script>

<template>
    <AppLayout title="เพิ่มจังหวัด">
        <form class="space-y-6" @submit.prevent="submit">
            <div class="flex flex-col gap-2">
                <label for="name_th">ชื่อจังหวัดภาษาไทย</label>
                <InputText name="name_th" v-model="form.name_th" inputId="name_th" />
                <InputError :message="form.errors.name_th" />
            </div>

            <div class="flex flex-col gap-2">
                <label for="name_en">ชื่อจังหวัดภาษาอังกฤษ</label>
                <InputText name="name_en" v-model="form.name_en" inputId="name_en" />
                <InputError :message="form.errors.name_en" />
            </div>

            <div class="flex flex-col gap-2">
                <label for="code">รหัสจังหวัด</label>
                <InputText name="code" v-model="form.code" inputId="code" type="number" />
                <InputError :message="form.errors.code" />
            </div>

            <div class="flex flex-col gap-2">
                <label for="region">ภูมิภาค</label>
                <Select name="region" optionLabel="name" optionValue="code" v-model="form.region" inputId="region"
                    :options="regions" />
                <InputError :message="form.errors.region" />
            </div>

            <Button type="submit" label="บันทึก" icon="pi pi-save" :disabled="form.processing"
                :loading="form.processing" />
        </form>
    </AppLayout>
</template>