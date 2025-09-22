<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            [
                'name_th' => 'ขอนแก่น',
                'name_en' => 'Khon Kaen',
                'region' => 'northeast',
                'code' => '40',
                'latitude' => 16.4419,
                'longitude' => 102.8359,
                'capital_district' => 'เมืองขอนแก่น',
                'area_km2' => 10886,
                'population' => 1789700,
                'postal_code_range' => '40xxx',
                'description' => 'จังหวัดขอนแก่นเป็นศูนย์กลางการศึกษาและเศรษฐกิจของภาคอีสาน มีมหาวิทยาลัยขอนแก่นที่มีชื่อเสียง และเป็นเมืองที่มีการพัฒนาอย่างรวดเร็ว',
                'famous_for' => 'มหาวิทยาลัยขอนแก่น, หนองแวงโบราณคดี, ไส้กรอกอีสาน, ผ้าไหม',
                'tourist_attractions' => [
                    'บึงแก่นนคร',
                    'หนองแวงโบราณคดี',
                    'วัดเทพพิทักษ์พุนนาราม',
                    'ศูนย์วัฒนธรรมอีสาน',
                    'ตลาดต้นตาล'
                ],
                'local_specialties' => [
                    'ไส้กรอกอีสาน',
                    'แคบหมู',
                    'ข้าวเกรียบปากหม้อ',
                    'ผ้าไหมขอนแก่น',
                    'น้ำพริกแคบ'
                ],
                'climate_type' => 'warm',
                'is_popular_health_destination' => false,
            ],
            [
                'name_th' => 'อุดรธานี',
                'name_en' => 'Udon Thani',
                'region' => 'northeast',
                'code' => '41',
                'latitude' => 17.4138,
                'longitude' => 102.7870,
                'capital_district' => 'เมืองอุดรธานี',
                'area_km2' => 11730,
                'population' => 1570000,
                'postal_code_range' => '41xxx',
                'description' => 'จังหวัดอุดรธานีเป็นเมืองสำคัญของภาคอีสานตอนบน มีประวัติศาสตร์อันยาวนาน และเป็นประตูสู่ประเทศลาว',
                'famous_for' => 'บ้านเชียง, หนองประจักษ์, ผ้าไหม, อาหารเวียดนาม',
                'tourist_attractions' => [
                    'บ้านเชียง',
                    'หนองประจักษ์',
                    'วัดโพธิ์ชัย',
                    'พิพิธภัณฑ์บ้านเชียง',
                    'ตลาดกลางเมืองอุดรธานี'
                ],
                'local_specialties' => [
                    'ผ้าไหมอุดรธานี',
                    'ขนมจีนน้ำยาป่า',
                    'แกงอ่อม',
                    'ไส้กรอกอีสาน',
                    'อาหารเวียดนาม'
                ],
                'climate_type' => 'warm',
                'is_popular_health_destination' => false,
            ],
            [
                'name_th' => 'หนองคาย',
                'name_en' => 'Nong Khai',
                'region' => 'northeast',
                'code' => '43',
                'latitude' => 17.8782,
                'longitude' => 102.7412,
                'capital_district' => 'เมืองหนองคาย',
                'area_km2' => 7332,
                'population' => 515000,
                'postal_code_range' => '43xxx',
                'description' => 'จังหวัดหนองคายตั้งอยู่ริมฝั่งแม่น้ำโขง เป็นจุดผ่านแดนสำคัญไปยังประเทศลาว มีวัฒนธรรมผสมผสานระหว่างไทยและลาว',
                'famous_for' => 'สะพานมิตรภาพไทย-ลาว, ศาลาแก้วกู่, นาคพญานาค, แม่น้ำโขง',
                'tourist_attractions' => [
                    'สะพานมิตรภาพไทย-ลาว',
                    'ศาลาแก้วกู่',
                    'วัดโพธิ์ชัย',
                    'หาดทรายโขง',
                    'ตลาดอินโดจีน'
                ],
                'local_specialties' => [
                    'ปลาแดกดิบ',
                    'ไข่มดแดง',
                    'ข้าวปุ้น',
                    'ผ้าไหมหนองคาย',
                    'น้ำพริกปลาร้า'
                ],
                'climate_type' => 'warm',
                'is_popular_health_destination' => false,
            ],
        ];

        foreach ($provinces as $provinceData) {
            Province::create($provinceData);
        }
    }
}
