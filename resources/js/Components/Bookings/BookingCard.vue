<script setup>
import axios from "axios";

const emit = defineEmits(['booking:deleted'])

defineProps({
    bookingDetails: {
        type: Object,
        required: true
    }
})
const deleteBooking = async bookingId => {
    const response = await axios.delete(`/api/account/bookings/${bookingId}`)
    emit('booking:deleted', bookingId)
}
</script>

<template>
    <div class="flex flex-col md:flex-row gap-[10px] bg-white shadow align-center items-center justify-between p-4 rounded mx-[10px] md:mx-0">
        <div class="flex flex-col">
            <div class="text-[12px] hidden md:block text-[grey]">Name</div>
            {{ bookingDetails.name }}
        </div>
        <div class="flex flex-col">
            <div class="text-[12px] hidden md:block text-[grey]">Email</div>
            {{ bookingDetails.email }}
        </div>
        <div class="flex flex-col">
            <div class="text-[12px] hidden md:block text-[grey]">Phone</div>
            {{ bookingDetails.phone }}
        </div>
        <div class="flex flex-col">
            <div class="text-[12px] hidden md:block text-[grey]">Make</div>
            {{ bookingDetails.vehicle_make }}
        </div>
        <div class="flex flex-col">
            <div class="text-[12px] hidden md:block text-[grey]">Model</div>
            {{ bookingDetails.vehicle_model }}
        </div>
        <div class="flex flex-col">
            <div class="text-[12px] hidden md:block text-[grey]">Booking Date</div>
            {{ bookingDetails.booking_date }}
        </div>
        <div class="flex flex-col">
            <div class="text-[12px] hidden md:block text-[grey]">Slot</div>
            {{ bookingDetails.slot }}
        </div>
        <div
            @click="deleteBooking(bookingDetails.id)"
            class="border border-[red] p-2 font-bold text-white bg-[red] cursor-pointer"
        >
            DELETE
        </div>
    </div>
</template>
