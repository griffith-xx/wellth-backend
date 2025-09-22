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
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name_th')->comment('ชื่อจังหวัดภาษาไทย');
            $table->string('name_en')->comment('ชื่อจังหวัดภาษาอังกฤษ');
            $table->enum('region', ['north', 'west', 'central', 'east', 'north_east', 'south'])->comment('ภูมิภาค');
            $table->string('code', 2)->unique()->comment('รหัสจังหวัด 2 หลัก เช่น 10 = กรุงเทพ');
            $table->decimal('latitude', 10, 8)->nullable()->comment('พิกัดศูนย์กลางจังหวัด');
            $table->decimal('longitude', 11, 8)->nullable()->comment('พิกัดศูนย์กลางจังหวัด');
            $table->string('capital_district')->nullable()->comment('อำเภอเมือง/ศูนย์กลาง');
            $table->integer('area_km2')->nullable()->comment('พื้นที่ตารางกิโลเมตร');
            $table->integer('population')->nullable()->comment('จำนวนประชากร');
            $table->string('postal_code_range')->nullable()->comment('ช่วงรหัสไปรษณีย์ เช่น "10xxx"');
            $table->text('description')->nullable()->comment('คำอธิบายจังหวัด');
            $table->string('famous_for')->nullable()->comment('สิ่งที่มีชื่อเสียง');
            $table->json('tourist_attractions')->nullable()->comment('สถานที่ท่องเที่ยวหลัก');
            $table->json('local_specialties')->nullable()->comment('อาหาร/ของฝากพิเศษ');
            $table->enum('climate_type', ['cool', 'warm', 'tropical_hot', 'sea_breeze'])->nullable()->comment('ลักษณะอากาศ');
            $table->boolean('is_popular_health_destination')->default(false)->comment('เป็นจุดหมายสุขภาพยอดนิยมหรือไม่');
            $table->timestamps();

            // Indexes
            $table->index(['region']);
            $table->index(['is_popular_health_destination']);
            $table->index(['name_th']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
