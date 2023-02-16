<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";
import Datepicker from '@vuepic/vue-datepicker';

import AppLayout from "@/Layouts/AppLayout.vue";
import BookingCard from "@/Components/Bookings/BookingCard.vue";
import TimeSlot from "@/Components/Bookings/TimeSlot.vue";

const bookings = ref(null);

const selectedDate = ref(null)

onMounted(() => {
    getBookings();
    getTimeSlots();
})

const timeSlots = ref(null);
const selectedTimeSlots = ref([]);

const getBookings = async () => {
    const response = await axios.get('/api/account/dashboard');
    bookings.value = response.data.data.bookings;
}
const removeBooking = bookingId => {
    bookings.value = bookings.value.filter(booking => booking.id !== bookingId)
}
const getTimeSlots = async () => {
    const response = await axios.get('/api/account/time-slots');
    timeSlots.value = response.data.data.timeSlots
}

const blockBooking = async () => {
    const response = await axios.post('/api/account/block-booking', {
        date: selectedDate.value,
        timeSlotIds: selectedTimeSlots.value
    });

    console.log('BLOCKED!');
}

const toggleTimeSlots = timeSlot => {
    selectedTimeSlots.value.includes(timeSlot)
        ? selectedTimeSlots.value = selectedTimeSlots.value.filter(slot => slot !== timeSlot)
        : selectedTimeSlots.value.push(timeSlot);
}
</script>

<template>
    <AppLayout>
        <div class="flex flex-col gap-2 py-2 md:py-12 max-w-8xl md:mx-auto md:min-h-[500px] mt-[30px]">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-full">
                <div class="text-3xl mb-[10px]">IMPORTANT</div>
                <div>
                    Please watch out for comments like including this: HELLOTEST - I've left a few of them. These are
                    the places where I am explaing things.
                </div>
                <div class="text-3xl mb-[10px] mt-[10px]">Block booking</div>
                <div>
                    Select date, and optionally slot to block. If no slots selected, the whole day will be blocked.
                    If slots are selected it will block the day only for the slots. Works only for the new customers.
                    To unblock it please just truncate the <span class="font-bold">blocked_booking_date</span> table.
                    Once something is blocked it will not be available for selection during the booking process.
                    After clicking block nothing visual will happen but you can check out network tab and try to book a
                    new visit.
                </div>
                <div class="text-2xl mb-[10px] mt-3">Block date</div>
                <Datepicker
                    v-model="selectedDate"
                    :enable-time-picker="false"
                    :disabled-week-days="[6, 0]"
                    :min-date="new Date()"
                    class="w-[200px] mb-4"
                />
                <div class="text-2xl mb-[10px]">Block slots</div>
                <div class="flex flex-wrap gap-[15px] mt-5">
                    <TimeSlot
                        v-for="timeSlot in timeSlots"
                        @slot:selected="toggleTimeSlots($event)"
                        :key="timeSlot.id"
                        :slot="timeSlot"
                        :class="{'bg-[darkgreen] text-white': selectedTimeSlots.includes(timeSlot.id)}"
                    />
                </div>
                <div
                    @click="blockBooking"
                    class="border border-[red] p-2 font-bold text-white bg-[red] cursor-pointer w-[90px] text-center mt-[20px]"
                >
                    BLOCK
                </div>
                <div class="mb-[20px] text-3xl mt-5">Bookings</div>
                <BookingCard
                    v-for="booking in bookings"
                    @booking:deleted="removeBooking($event)"
                    :booking-details="booking"
                    class="mb-3"
                />
            </div>
        </div>
    </AppLayout>
</template>
