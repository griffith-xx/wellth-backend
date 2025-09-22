<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
defineProps({
    provinces: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <DataTable stripedRows :value="provinces">
        <Column field="name_th" header="name_th"></Column>
        <Column field="name_en" header="name_en"></Column>
        <Column field="region" header="region"></Column>
        <Column field="code" header="code"></Column>
        <Column field="description" header="description"></Column>
        <Column field="famous_for" header="famous_for"></Column>
    </DataTable>
</template>
