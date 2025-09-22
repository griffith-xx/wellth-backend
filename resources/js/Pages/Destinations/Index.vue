<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { DataTable, Column } from "primevue";
defineProps({
    destinations: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AppLayout title="สถานที่ท่องเที่ยวทั้งหมด">
        <DataTable stripedRows :value="destinations">
            <Column field="name" header="ชื่อสถานที่ท่องเที่ยว"></Column>
            <Column header="รูปภาพปก">
                <template #body="slotProps">
                    <img :src="slotProps.data.image_url" :alt="slotProps.data.name" class="w-24 rounded" />
                </template>
            </Column>
            <Column field="province.name_th" header="จังหวัด"></Column>
            <Column field="description" header="รายละเอียด"></Column>
        </DataTable>
    </AppLayout>

</template>
