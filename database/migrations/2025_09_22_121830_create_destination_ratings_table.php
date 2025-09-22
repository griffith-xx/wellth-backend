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
        Schema::create('destination_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // คะแนนรวม (1-5)
            $table->decimal('rating', 2, 1)->comment('คะแนนรวม 1.0-5.0');

            // คะแนนแยกตามหมวดหมู่
            $table->decimal('service_quality', 2, 1)->nullable()->comment('คุณภาพการบริการ');
            $table->decimal('cleanliness', 2, 1)->nullable()->comment('ความสะอาด');
            $table->decimal('value_for_money', 2, 1)->nullable()->comment('คุณค่าต่อเงิน');
            $table->decimal('location_convenience', 2, 1)->nullable()->comment('ความสะดวกของสถานที่');
            $table->decimal('health_benefits', 2, 1)->nullable()->comment('ประโยชน์ต่อสุขภาพ');
            $table->decimal('staff_friendliness', 2, 1)->nullable()->comment('ความเป็นมิตรของพนักงาน');

            // รีวิวข้อความ
            $table->text('review_title')->nullable()->comment('หัวข้อรีวิว');
            $table->text('review_text')->nullable()->comment('เนื้อหารีวิว');

            // ข้อมูลเพิ่มเติม
            $table->json('pros')->nullable()->comment('จุดเด่น ["ดี1", "ดี2"]');
            $table->json('cons')->nullable()->comment('จุดด้อย ["ด้อย1", "ด้อย2"]');
            $table->json('recommended_for')->nullable()->comment('แนะนำสำหรับ ["couples", "families", "solo"]');
            $table->string('visit_month')->nullable()->comment('เดือนที่ไป');
            $table->integer('visit_year')->nullable()->comment('ปีที่ไป');
            $table->enum('trip_type', ['solo', 'couple', 'family', 'friends', 'business'])->nullable()->comment('ประเภทการเดินทาง');

            // สถานะ
            $table->boolean('is_verified')->default(false)->comment('ยืนยันแล้วหรือไม่');
            $table->boolean('is_featured')->default(false)->comment('รีวิวเด่นหรือไม่');
            $table->boolean('is_active')->default(true)->comment('แสดงหรือไม่');

            // การโต้ตอบ
            $table->integer('helpful_count')->default(0)->comment('จำนวนคนที่กด helpful');
            $table->integer('not_helpful_count')->default(0)->comment('จำนวนคนที่กด not helpful');

            $table->timestamps();

            // Indexes
            $table->index(['destination_id', 'rating']);
            $table->index(['user_id']);
            $table->index(['is_active', 'is_verified']);
            $table->index(['created_at']);
            $table->unique(['destination_id', 'user_id']); // หนึ่งคนรีวิวหนึ่งสถานที่ได้ครั้งเดียว
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_ratings');
    }
};
