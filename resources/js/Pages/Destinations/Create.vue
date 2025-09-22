<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputText from "primevue/inputtext";
import { Select, Button, Textarea, Checkbox, RadioButton } from "primevue";

import {
    healthGoalsOptions,
    healthConditionsOptions,
    physicalActivitiesOptions,
    spaTreatmentsOptions,
    traditionalHealingOptions,
    fitnessProgramsOptions,
    accommodationTypeOptions,
    budgetRangeOptions,
    tripDurationOptions,
    travelStyleOptions,
    naturePreferencesOptions,
    preferredClimateOptions,
    preferredMonthsOptions,
    dietaryPreferencesOptions,
    foodRestrictionsOptions,
    mobilityRequirementsOptions,
    languagePreferenceOptions,
    medicalSupportOptions,
    socialInteractionOptions,
} from "@/Const/userPreferenceOptions";

defineProps({
    provinces: {
        type: Object,
        required: true
    }
})

const form = useForm({
    name: "",
    province_id: null,
    description: "",
    image_url: "",
    gallery_images: "",
    suitable_health_goals: [],
    suitable_health_conditions: [],
    activity_level: "",
    spa_treatments_available: [],
    traditional_healing_available: [],
    fitness_programs_available: [],
    accommodation_types: [],
    price_range: 'budget',
    suitable_trip_duration: '1-2_days',
    suitable_travel_style: 'solo',
    nature_types: [],
    climate_type: 'cool',
    best_months: [],
    dietary_options_available: [],
    food_restrictions_supported: [],
    accessibility_features: [],
    languages_supported: ['thai'],
    medical_support_available: 'not_required',
    social_environment: [],
})

const submit = () => {
    form.post(route('destinations.store'))
}
</script>

<template>
    <AppLayout title="เพิ่มสถานที่ท่องเที่ยว">
        <form class="space-y-6" @submit.prevent="submit">
            <div class="flex flex-col gap-2">
                <label for="name">ชื่อสถานที่ท่องเที่ยว</label>
                <InputText name="name" v-model="form.name" inputId="name" />
                <InputError :message="form.errors.name" />
            </div>

            <div class="flex flex-col gap-2">
                <label for="province_id">เลือกจังหวัด</label>
                <Select filter :options="provinces" optionLabel="name_th" optionValue="id" name="province_id"
                    v-model="form.province_id" inputId="province_id" />
                <InputError :message="form.errors.province_id" />
            </div>

            <div class="flex flex-col gap-2">
                <label for="description">รายละเอียดสถานที่ท่องเที่ยว</label>
                <Textarea rows="5" description="description" v-model="form.description" inputId="description" />
                <InputError :message="form.errors.description" />
            </div>

            <div class="flex flex-col gap-2">
                <label for="image_url">รูปภาพ</label>
                <InputText name="image_url" v-model="form.image_url" inputId="image_url" />
                <InputError :message="form.errors.image_url" />
            </div>

            <div class="flex flex-col gap-2">
                <label for="gallery_images">รูปภาพเพิ่มเติม (,)</label>
                <Textarea rows="5" name="gallery_images" v-model="form.gallery_images" inputId="gallery_images" />
                <InputError :message="form.errors.gallery_images" />
            </div>

            <div class="grid grid-cols-2 gap-2 gap-y-6">

                <div class="flex flex-col gap-2">
                    <label for="suitable_health_goals">เป้าหมายสุขภาพที่ดูแล</label>
                    <div v-for="(option, index) in healthGoalsOptions" :key="index" class="flex items-center gap-2">
                        <Checkbox name="suitable_health_goals" v-model="form.suitable_health_goals"
                            :inputId="option.value" :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="suitable_health_conditions">ปัญหาสุขภาพเฉพาะที่ดูแลเป็นพิเศษ</label>
                    <div v-for="(option, index) in healthConditionsOptions" :key="index"
                        class="flex items-center gap-2">
                        <Checkbox name="suitable_health_conditions" v-model="form.suitable_health_conditions"
                            :inputId="option.value" :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="activity_level">ระดับกิจกรรมที่เหมาะสม</label>
                    <div v-for="(option, index) in physicalActivitiesOptions" :key="index"
                        class="flex items-center gap-2">
                        <RadioButton name="activity_level" v-model="form.activity_level" :inputId="option.value"
                            :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="spa_treatments_available">กิจกรรมสปาและความงามที่มี</label>
                    <div v-for="(option, index) in spaTreatmentsOptions" :key="index" class="flex items-center gap-2">
                        <Checkbox name="spa_treatments_available" v-model="form.spa_treatments_available"
                            :inputId="option.value" :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="traditional_healing_available">การรักษาแผนไทย/ทางเลือกที่มี</label>
                    <div v-for="(option, index) in traditionalHealingOptions" :key="index"
                        class="flex items-center gap-2">
                        <Checkbox name="traditional_healing_available" v-model="form.traditional_healing_available"
                            :inputId="option.value" :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="fitness_programs_available">โปรแกรมออกกำลังกาย/ฟิตเนสที่มี</label>
                    <div v-for="(option, index) in fitnessProgramsOptions" :key="index" class="flex items-center gap-2">
                        <Checkbox name="fitness_programs_available" v-model="form.fitness_programs_available"
                            :inputId="option.value" :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="accommodation_types">ประเภทที่พัก</label>
                    <div v-for="(option, index) in accommodationTypeOptions" :key="index"
                        class="flex items-center gap-2">
                        <Checkbox name="accommodation_types" v-model="form.accommodation_types" :inputId="option.value"
                            :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="price_range">งบประมาณต่อคน (ต่อการเดินทาง)</label>
                    <div v-for="(option, index) in budgetRangeOptions" :key="index" class="flex items-center gap-2">
                        <RadioButton name="price_range" v-model="form.price_range" :inputId="option.value"
                            :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="suitable_trip_duration">ระยะเวลาเดินทาง</label>
                    <div v-for="(option, index) in tripDurationOptions" :key="index" class="flex items-center gap-2">
                        <RadioButton name="suitable_trip_duration" v-model="form.suitable_trip_duration"
                            :inputId="option.value" :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="suitable_travel_style">รูปแบบการเดินทาง</label>
                    <div v-for="(option, index) in travelStyleOptions" :key="index" class="flex items-center gap-2">
                        <RadioButton name="suitable_travel_style" v-model="form.suitable_travel_style"
                            :inputId="option.value" :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="nature_types">ธรรมชาติที่มี</label>
                    <div v-for="(option, index) in naturePreferencesOptions" :key="index"
                        class="flex items-center gap-2">
                        <Checkbox name="nature_types" v-model="form.nature_types" :inputId="option.value"
                            :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="climate_type">สภาพอากาศที่เป็น</label>
                    <div v-for="(option, index) in preferredClimateOptions" :key="index"
                        class="flex items-center gap-2">
                        <RadioButton name="climate_type" v-model="form.climate_type" :inputId="option.value"
                            :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="best_months">ช่วงเวลาที่ควรเดินทาง</label>
                    <div v-for="(option, index) in preferredMonthsOptions" :key="index" class="flex items-center gap-2">
                        <Checkbox name="best_months" v-model="form.best_months" :inputId="option.value"
                            :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="dietary_options_available">อาหารเพื่อสุขภาพที่มี</label>
                    <div v-for="(option, index) in dietaryPreferencesOptions" :key="index"
                        class="flex items-center gap-2">
                        <Checkbox name="dietary_options_available" v-model="form.dietary_options_available"
                            :inputId="option.value" :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="food_restrictions_supported">ข้อจำกัดด้านอาหารที่รองรับ</label>
                    <div v-for="(option, index) in foodRestrictionsOptions" :key="index"
                        class="flex items-center gap-2">
                        <Checkbox name="food_restrictions_supported" v-model="form.food_restrictions_supported"
                            :inputId="option.value" :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="accessibility_features">การเข้าถึงและความต้องการพิเศษที่มี</label>
                    <div v-for="(option, index) in mobilityRequirementsOptions" :key="index"
                        class="flex items-center gap-2">
                        <Checkbox name="accessibility_features" v-model="form.accessibility_features"
                            :inputId="option.value" :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="languages_supported">ภาษาที่รองรับ</label>
                    <div v-for="(option, index) in languagePreferenceOptions" :key="index"
                        class="flex items-center gap-2">
                        <Checkbox name="languages_supported" v-model="form.languages_supported" :inputId="option.value"
                            :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="medical_support_available">สนับสนุนทางการแพทย์ที่มี</label>
                    <div v-for="(option, index) in medicalSupportOptions" :key="index" class="flex items-center gap-2">
                        <RadioButton name="medical_support_available" v-model="form.medical_support_available"
                            :inputId="option.value" :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="social_environment">ประสบการณ์และความคาดหวังที่จะมีให้</label>
                    <div v-for="(option, index) in socialInteractionOptions" :key="index"
                        class="flex items-center gap-2">
                        <Checkbox name="social_environment" v-model="form.social_environment" :inputId="option.value"
                            :value="option.value" />
                        <label :for="option.value">
                            {{ option.label }}
                        </label>
                    </div>
                </div>

            </div>

            <Button type="submit" label="บันทึก" icon="pi pi-save" :disabled="form.processing"
                :loading="form.processing" />
        </form>
    </AppLayout>
</template>
