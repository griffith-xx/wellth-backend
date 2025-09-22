<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade');
            $table->text('description');
            $table->string('image_url')->nullable()->comment('รูปภาพหลัก');
            $table->json('gallery_images')->nullable()->comment('รูปภาพเพิ่มเติม ["url1", "url2", ...]');

            // จับคู่กับ health_goals
            $table->json('suitable_health_goals')->nullable()->comment('["weight_loss", "stress_relief", "fitness", "detox", "rehabilitation", "better_sleep", "skin_care", "immunity"]');

            // จับคู่กับ health_conditions
            $table->json('suitable_health_conditions')->nullable()->comment('["diabetes", "hypertension", "back_pain", "arthritis", "insomnia", "skin_problems", "digestive_issues", "none"]');

            // จับคู่กับ physical_activity_level
            $table->enum('activity_level', ['low', 'low_moderate', 'moderate', 'high', 'very_high'])->nullable();

            // จับคู่กับ spa_treatments
            $table->json('spa_treatments_available')->nullable()->comment('["thai_massage", "aromatherapy", "hot_stone", "herbal_steam", "body_scrub", "facial_treatment", "mineral_bath", "mud_therapy"]');

            // จับคู่กับ traditional_healing
            $table->json('traditional_healing_available')->nullable()->comment('["thai_traditional_medicine", "thai_herbal_medicine", "herbal_compress", "chinese_medicine", "ayurveda", "yoga_therapy", "meditation_therapy"]');

            // จับคู่กับ fitness_programs
            $table->json('fitness_programs_available')->nullable()->comment('["yoga", "pilates", "muay_thai", "fitness_camp", "swimming", "hiking", "cycling"]');

            // จับคู่กับ accommodation_type
            $table->json('accommodation_types')->nullable()->comment('["health_resort", "spa_hotel", "retreat_center", "health_homestay", "regular_hotel"]');

            // จับคู่กับ budget_range
            $table->enum('price_range', ['budget', 'mid_range', 'luxury', 'premium']);

            // จับคู่กับ trip_duration - สถานที่เหมาะกับระยะเวลาไหน
            $table->json('suitable_trip_duration')->nullable()->comment('["1-2_days", "3-4_days", "5-7_days", "more_than_week"]');

            // จับคู่กับ travel_style
            $table->json('suitable_travel_style')->nullable()->comment('["solo", "couple", "family", "group"]');

            // จับคู่กับ nature_preferences
            $table->json('nature_types')->nullable()->comment('["mountain", "beach", "forest", "waterfall", "flower_field", "hot_spring", "national_park"]');

            // จับคู่กับ preferred_climate
            $table->enum('climate_type', ['cool', 'warm', 'tropical_hot', 'sea_breeze'])->nullable();

            // จับคู่กับ preferred_months
            $table->json('best_months')->nullable()->comment('["jan_feb", "mar_may", "jun_aug", "sep_oct", "nov_dec", "flexible"]');

            // จับคู่กับ dietary_preferences
            $table->json('dietary_options_available')->nullable()->comment('["vegetarian", "vegan", "halal", "organic", "local_healthy", "herbal_supplements"]');

            // จับคู่กับ food_restrictions
            $table->json('food_restrictions_supported')->nullable()->comment('["gluten_free", "lactose_free", "nut_allergy", "diabetic", "low_sodium"]');

            // จับคู่กับ mobility_requirements
            $table->json('accessibility_features')->nullable()->comment('["wheelchair_accessible", "elderly_friendly", "child_friendly", "elevator_access"]');

            // จับคู่กับ language_preference
            $table->json('languages_supported')->nullable()->comment('["thai", "english", "chinese", "japanese", "korean"]');

            // จับคู่กับ medical_support_needed
            $table->boolean('medical_support_available')->default(false);

            // จับคู่กับ social_interaction_level
            $table->json('social_environment')->nullable()->comment('["privacy_quiet", "minimal_interaction", "meet_new_people"]');

            // คะแนนและความนิยม
            $table->decimal('expert_rating', 3, 2)->default(4.0)->comment('คะแนนจากผู้เชี่ยวชาญ');
            $table->integer('popularity_score')->default(0)->comment('คะแนนความนิยม');

            // ข้อมูลเพิ่มเติม
            $table->text('location_details')->nullable()->comment('รายละเอียดที่ตั้ง');
            $table->decimal('latitude', 10, 8)->nullable()->comment('พิกัด');
            $table->decimal('longitude', 11, 8)->nullable()->comment('พิกัด');
            $table->string('contact_phone')->nullable();
            $table->string('website')->nullable();
            $table->json('operating_hours')->nullable()->comment('เวลาเปิด-ปิด');
            $table->boolean('is_active')->default(true)->comment('เปิดให้บริการหรือไม่');

            $table->timestamps();

            // Indexes สำหรับการค้นหา
            $table->index(['province_id', 'price_range']);
            $table->index(['activity_level', 'climate_type']);
            $table->index(['is_active', 'expert_rating']);
            $table->index(['province_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
