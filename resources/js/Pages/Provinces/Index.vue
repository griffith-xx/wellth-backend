<script setup>
defineProps({
    provinces: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <pre>
        {{ provinces }}
    </pre>
</template>
