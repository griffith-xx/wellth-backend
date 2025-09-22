<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'province_id',
        'description',
        'image_url',
        'gallery_images',
        'suitable_health_goals',
        'suitable_health_conditions',
        'activity_level',
        'spa_treatments_available',
        'traditional_healing_available',
        'fitness_programs_available',
        'accommodation_types',
        'price_range',
        'suitable_trip_duration',
        'suitable_travel_style',
        'nature_types',
        'climate_type',
        'best_months',
        'dietary_options_available',
        'food_restrictions_supported',
        'accessibility_features',
        'languages_supported',
        'medical_support_available',
        'social_environment',
        'expert_rating',
        'popularity_score',
        'location_details',
        'latitude',
        'longitude',
        'contact_phone',
        'website',
        'operating_hours',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            // JSON fields
            'gallery_images' => 'array',
            'suitable_health_goals' => 'array',
            'suitable_health_conditions' => 'array',
            'spa_treatments_available' => 'array',
            'traditional_healing_available' => 'array',
            'fitness_programs_available' => 'array',
            'accommodation_types' => 'array',
            'nature_types' => 'array',
            'best_months' => 'array',
            'dietary_options_available' => 'array',
            'food_restrictions_supported' => 'array',
            'accessibility_features' => 'array',
            'languages_supported' => 'array',
            'social_environment' => 'array',
            'operating_hours' => 'array',
            
            // Decimal fields
            'expert_rating' => 'decimal:2',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            
            // Integer fields
            'popularity_score' => 'integer',
            
            // Boolean fields
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the province that owns the destination
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get all ratings for this destination
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(DestinationRating::class);
    }

    /**
     * Scope for active destinations only
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for filtering by price range
     */
    public function scopeByPriceRange(Builder $query, string $priceRange): Builder
    {
        return $query->where('price_range', $priceRange);
    }

    /**
     * Scope for filtering by activity level
     */
    public function scopeByActivityLevel(Builder $query, string $activityLevel): Builder
    {
        return $query->where('activity_level', $activityLevel);
    }

    /**
     * Scope for filtering by climate type
     */
    public function scopeByClimate(Builder $query, string $climateType): Builder
    {
        return $query->where('climate_type', $climateType);
    }

    /**
     * Scope for filtering by region through province
     */
    public function scopeByRegion(Builder $query, string $region): Builder
    {
        return $query->whereHas('province', function ($q) use ($region) {
            $q->where('region', $region);
        });
    }

    /**
     * Scope for filtering by health goals
     */
    public function scopeByHealthGoals(Builder $query, array $healthGoals): Builder
    {
        return $query->where(function ($q) use ($healthGoals) {
            foreach ($healthGoals as $goal) {
                $q->orWhereJsonContains('suitable_health_goals', $goal);
            }
        });
    }

    /**
     * Scope for filtering by health conditions
     */
    public function scopeByHealthConditions(Builder $query, array $healthConditions): Builder
    {
        return $query->where(function ($q) use ($healthConditions) {
            foreach ($healthConditions as $condition) {
                $q->orWhereJsonContains('suitable_health_conditions', $condition);
            }
        });
    }

    /**
     * Scope for filtering by spa treatments
     */
    public function scopeBySpaServices(Builder $query, array $spaServices): Builder
    {
        return $query->where(function ($q) use ($spaServices) {
            foreach ($spaServices as $service) {
                $q->orWhereJsonContains('spa_treatments_available', $service);
            }
        });
    }

    /**
     * Scope for filtering by accommodation types
     */
    public function scopeByAccommodationType(Builder $query, array $accommodationTypes): Builder
    {
        return $query->where(function ($q) use ($accommodationTypes) {
            foreach ($accommodationTypes as $type) {
                $q->orWhereJsonContains('accommodation_types', $type);
            }
        });
    }

    /**
     * Scope for filtering by nature preferences
     */
    public function scopeByNatureTypes(Builder $query, array $natureTypes): Builder
    {
        return $query->where(function ($q) use ($natureTypes) {
            foreach ($natureTypes as $type) {
                $q->orWhereJsonContains('nature_types', $type);
            }
        });
    }

    /**
     * Get price range in Thai
     */
    public function getPriceRangeThAttribute(): string
    {
        return match ($this->price_range) {
            'budget' => 'ประหยัด',
            'mid_range' => 'ปานกลาง',
            'luxury' => 'หรูหรา',
            'premium' => 'พรีเมียม',
            default => $this->price_range,
        };
    }

    /**
     * Get activity level in Thai
     */
    public function getActivityLevelThAttribute(): ?string
    {
        return match ($this->activity_level) {
            'low' => 'น้อย',
            'low_moderate' => 'น้อย-ปานกลาง',
            'moderate' => 'ปานกลาง',
            'high' => 'สูง',
            'very_high' => 'สูงมาก',
            default => null,
        };
    }

    /**
     * Get climate type in Thai
     */
    public function getClimateTypeThAttribute(): ?string
    {
        return match ($this->climate_type) {
            'cool' => 'อากาศเย็น',
            'warm' => 'อากาศอบอุ่น',
            'tropical_hot' => 'อากาศร้อนชื้น',
            'sea_breeze' => 'อากาศลมทะเล',
            default => null,
        };
    }

    /**
     * Get average user rating
     */
    public function getAverageUserRatingAttribute(): float
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    /**
     * Get total ratings count
     */
    public function getTotalRatingsAttribute(): int
    {
        return $this->ratings()->count();
    }

    /**
     * Check if destination supports medical needs
     */
    public function supportsMedicalNeeds(): bool
    {
        return $this->medical_support_available;
    }

    /**
     * Check if destination is accessible
     */
    public function isAccessible(): bool
    {
        return !empty($this->accessibility_features);
    }

    /**
     * Get matching score based on user preferences
     */
    public function getMatchingScore(array $userPreferences): float
    {
        $score = 0;
        $totalCriteria = 0;

        // Health goals matching
        if (!empty($userPreferences['health_goals']) && !empty($this->suitable_health_goals)) {
            $matches = array_intersect($userPreferences['health_goals'], $this->suitable_health_goals);
            $score += (count($matches) / count($userPreferences['health_goals'])) * 20;
            $totalCriteria += 20;
        }

        // Health conditions matching
        if (!empty($userPreferences['health_conditions']) && !empty($this->suitable_health_conditions)) {
            $matches = array_intersect($userPreferences['health_conditions'], $this->suitable_health_conditions);
            $score += (count($matches) / count($userPreferences['health_conditions'])) * 15;
            $totalCriteria += 15;
        }

        // Activity level matching
        if (!empty($userPreferences['physical_activity_level']) && $this->activity_level) {
            if ($userPreferences['physical_activity_level'] === $this->activity_level) {
                $score += 15;
            }
            $totalCriteria += 15;
        }

        // Price range matching
        if (!empty($userPreferences['budget_range']) && $this->price_range) {
            if ($userPreferences['budget_range'] === $this->price_range) {
                $score += 15;
            }
            $totalCriteria += 15;
        }

        // Climate preference matching
        if (!empty($userPreferences['preferred_climate']) && $this->climate_type) {
            if ($userPreferences['preferred_climate'] === $this->climate_type) {
                $score += 10;
            }
            $totalCriteria += 10;
        }

        // Nature preferences matching
        if (!empty($userPreferences['nature_preferences']) && !empty($this->nature_types)) {
            $matches = array_intersect($userPreferences['nature_preferences'], $this->nature_types);
            if (!empty($matches)) {
                $score += (count($matches) / count($userPreferences['nature_preferences'])) * 10;
            }
            $totalCriteria += 10;
        }

        // Spa treatments matching
        if (!empty($userPreferences['spa_treatments']) && !empty($this->spa_treatments_available)) {
            $matches = array_intersect($userPreferences['spa_treatments'], $this->spa_treatments_available);
            if (!empty($matches)) {
                $score += (count($matches) / count($userPreferences['spa_treatments'])) * 10;
            }
            $totalCriteria += 10;
        }

        // Traditional healing matching
        if (!empty($userPreferences['traditional_healing']) && !empty($this->traditional_healing_available)) {
            $matches = array_intersect($userPreferences['traditional_healing'], $this->traditional_healing_available);
            if (!empty($matches)) {
                $score += (count($matches) / count($userPreferences['traditional_healing'])) * 8;
            }
            $totalCriteria += 8;
        }

        // Fitness programs matching
        if (!empty($userPreferences['fitness_programs']) && !empty($this->fitness_programs_available)) {
            $matches = array_intersect($userPreferences['fitness_programs'], $this->fitness_programs_available);
            if (!empty($matches)) {
                $score += (count($matches) / count($userPreferences['fitness_programs'])) * 8;
            }
            $totalCriteria += 8;
        }

        // Travel style matching - แก้ไขตรงนี้
        if (!empty($userPreferences['travel_style']) && $this->suitable_travel_style) {
            if ($userPreferences['travel_style'] === $this->suitable_travel_style) {
                $score += 8;
            }
            $totalCriteria += 8;
        }

        // Trip duration matching
        if (!empty($userPreferences['trip_duration']) && $this->suitable_trip_duration) {
            if ($userPreferences['trip_duration'] === $this->suitable_trip_duration) {
                $score += 5;
            }
            $totalCriteria += 5;
        }

        // Accommodation type matching - แก้ไขตรงนี้
        if (!empty($userPreferences['accommodation_type']) && !empty($this->accommodation_types)) {
            if (in_array($userPreferences['accommodation_type'], $this->accommodation_types)) {
                $score += 5;
            }
            $totalCriteria += 5;
        }

        // Dietary preferences matching
        if (!empty($userPreferences['dietary_preferences']) && !empty($this->dietary_options_available)) {
            $matches = array_intersect($userPreferences['dietary_preferences'], $this->dietary_options_available);
            if (!empty($matches)) {
                $score += (count($matches) / count($userPreferences['dietary_preferences'])) * 5;
            }
            $totalCriteria += 5;
        }

        // Language preference matching
        if (!empty($userPreferences['language_preference']) && !empty($this->languages_supported)) {
            if (in_array($userPreferences['language_preference'], $this->languages_supported)) {
                $score += 3;
            }
            $totalCriteria += 3;
        }

        // Medical support matching
        if (!empty($userPreferences['medical_support_needed']) && $userPreferences['medical_support_needed'] !== 'not_required') {
            if ($this->medical_support_available === 'required') {
                $score += 5;
            }
            $totalCriteria += 5;
        }

        // Accessibility matching
        if (!empty($userPreferences['mobility_requirements']) && !empty($this->accessibility_features)) {
            $matches = array_intersect($userPreferences['mobility_requirements'], $this->accessibility_features);
            if (!empty($matches)) {
                $score += (count($matches) / count($userPreferences['mobility_requirements'])) * 5;
            }
            $totalCriteria += 5;
        }

        return $totalCriteria > 0 ? ($score / $totalCriteria) * 100 : 0;
    }
}
