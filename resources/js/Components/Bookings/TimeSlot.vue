<script setup>
defineProps({
    slot: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['slot:selected']);
</script>

<template>
    <div
        @click="emit('slot:selected', slot.id)"
        class="
        bg-white
        shadow
        align-center
        p-4
        rounded
        w-[140px]
        text-center
        cursor-pointer
    "
    >
        {{ slot.slot }}
    </div>
</template>
