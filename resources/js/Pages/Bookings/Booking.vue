<script setup>
import axios from "axios";
import {computed, onMounted, ref} from "vue";
import Datepicker from '@vuepic/vue-datepicker';

import ScaryBat from '@/../assets/images/scary-bat.jpg'

import SimpleCenteredPage from "@/Layouts/SimpleCenteredPage.vue";
import TimeSlot from "@/Components/Bookings/TimeSlot.vue";

const booking = ref({
    name: null,
    email: null,
    phone: null,
    make: null,
    model: null,
    date: null,
    timeSlotId: null,
});
const validationErrors = ref(null);
const availableTimeSlots = ref(null);
const disabledDates = ref([]);
const calculatedDisabledDates = computed(() => disabledDates.value);

onMounted(() => {
    getDisabledDates();
})
const getDisabledDates = async () => {
    const response = await axios.get('/api/blocked-days');
    disabledDates.value = response.data.data.blockedDays;
    disabledDates.value = disabledDates.value.map(date => new Date(Date.parse(date.date)));
}

const getAvailableTimes = async () => {
    const response = await axios.get('/api/available-time-slots', {
        params: {
            date: booking.value.date
        }
    });
    availableTimeSlots.value = response.data.data.timeSlots;
    booking.value.timeSlotId = null;
}
const makeBooking = async () => {
    const reponse = await axios.post('/api/booking', {...booking.value})
        .catch(error => {
            if (error.response.status === 422) {
                validationErrors.value = error.response.data.errors
            }
        })

    if (reponse.status === 200) {
        Object.keys(booking.value).forEach(item => booking.value[item] = null);
    }
}
</script>

<template>
    <SimpleCenteredPage>
        <div class="flex flex-col w-[450px] mb-10">
            <div class="text-3xl text-center">Book now or I'll bite!</div>
            <img :src="ScaryBat" class="w-[200px] h-auto mx-auto"/>
            <label for="name" class="text-[12px] md:text-[16px]">Full Name</label>
            <input
                v-model="booking.name"
                :class="[validationErrors?.name ? 'border border-[red]' : 'mb-4 border-0']"
                id="name"
                type="text"
                class="mt-4 h-[45px] bg-[#D1FFF1] text-[#7D7D7DFF] text-[16px] w-full rounded-[4px] px-4"
                placeholder="Your full name here"
            />
            <div v-if="validationErrors?.name" class="mt-2 mb-4 text-[red]">{{ validationErrors?.name[0] }}</div>

            <label for="email" class="text-[12px] md:text-[16px]">Email</label>
            <input
                v-model="booking.email"
                :class="[validationErrors?.email ? 'border border-[red]' : 'mb-4 border-0']"
                id="email"
                type="email"
                class="mt-4 h-[45px] bg-[#D1FFF1] text-[#7D7D7DFF] text-[16px] w-full rounded-[4px] px-4"
                placeholder="Enter your email here"
            />
            <div v-if="validationErrors?.email" class="mt-2 mb-4 text-[red]">{{ validationErrors?.email[0] }}</div>

            <label for="phone" class="text-[12px] md:text-[16px]">Phone number</label>
            <input
                v-model="booking.phone"
                :class="[validationErrors?.phone ? 'border border-[red]' : 'mb-4 border-0']"
                id="phone"
                type="text"
                class="mt-4 h-[45px] bg-[#D1FFF1] text-[#7D7D7DFF] text-[16px] w-full rounded-[4px] px-4"
                placeholder="Enter your phone number here"
            />
            <div v-if="validationErrors?.phone" class="mt-2 mb-4 text-[red]">{{ validationErrors?.phone[0] }}</div>

            <label for="make" class="text-[12px] md:text-[16px]">Vehicle Make</label>
            <input
                v-model="booking.make"
                :class="[validationErrors?.make ? 'border border-[red]' : 'mb-4 border-0']"
                id="make"
                type="text"
                class="mt-4 h-[45px] bg-[#D1FFF1] text-[#7D7D7DFF] text-[16px] w-full rounded-[4px] px-4"
                placeholder="Enter your vehicle make here"
            />
            <div v-if="validationErrors?.make" class="mt-2 mb-4 text-[red]">{{ validationErrors?.make[0] }}</div>

            <label for="model" class="text-[12px] md:text-[16px]">Vehicle Model</label>
            <input
                v-model="booking.model"
                :class="[validationErrors?.model ? 'border border-[red]' : 'mb-4 border-0']"
                id="model"
                type="text"
                class="mt-4 h-[45px] bg-[#D1FFF1] text-[#7D7D7DFF] text-[16px] w-full rounded-[4px] px-4"
                placeholder="Enter your vehicle model here"
            />
            <div v-if="validationErrors?.model" class="mt-2 mb-4 text-[red]">{{ validationErrors?.model[0] }}</div>

            <label for="email" class="text-[12px] md:text-[16px] mb-4">When would you like to pop in?</label>
            <Datepicker
                v-model="booking.date"
                :class="[validationErrors?.date ? 'border border-[red]' : 'mb-4 border-0']"
                @update:model-value="getAvailableTimes"
                @cleared="getAvailableTimes = null"
                :disabled-dates="calculatedDisabledDates"
                :enable-time-picker="false"
                :disabled-week-days="[6, 0]"
                :min-date="new Date()"
                class="w-full mb-4"
            />
            <div v-if="validationErrors?.date" class="mt-2 mb-4 text-[red]">{{ validationErrors?.date[0] }}</div>

            <div
                v-if="availableTimeSlots?.length"
                class="flex flex-wrap justify-around gap-[10px]"
            >
                <TimeSlot
                    v-for="timeSlot in availableTimeSlots"
                    @slot:selected="booking.timeSlotId = $event"
                    :key="timeSlot.id"
                    :slot="timeSlot"
                    :class="{'text-white bg-[darkgreen]': booking.timeSlotId === timeSlot.id}"
                />
                <div v-if="validationErrors?.timeSlotId" class="w-full text-[red] mt-2 mb-4">{{ validationErrors?.timeSlotId[0] }}</div>
            </div>
            <div
                @click="makeBooking"
                class="px-[10px] py-[7px] bg-[green] border border-[green] mt-4 text-center text-white font-bold hover:bg-[darkgreen] cursor-pointer">
                BOOK NOW! (BEFORE GARY THE BAT GETS YOU)
            </div>
        </div>
    </SimpleCenteredPage>
</template>
