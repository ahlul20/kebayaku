<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Kebaya extends Model
{
    /** Kategori + ikon Font Awesome + deskripsi singkat (dipakai di Home & form admin). */
    public const CATEGORIES = [
        'Wisuda'      => ['icon' => 'fa-graduation-cap',    'desc' => 'Anggun di hari kelulusan'],
        'Pernikahan'  => ['icon' => 'fa-ring',              'desc' => 'Untuk akad & resepsi'],
        'Lamaran'     => ['icon' => 'fa-heart',             'desc' => 'Momen manis tunangan'],
        'Kondangan'   => ['icon' => 'fa-champagne-glasses', 'desc' => 'Tampil memukau di pesta'],
        'Tradisional' => ['icon' => 'fa-feather-pointed',   'desc' => 'Kutubaru, Kartini & lainnya'],
        'Modern'      => ['icon' => 'fa-gem',               'desc' => 'Brokat & potongan kekinian'],
    ];

    public const SIZES = ['S', 'M', 'L', 'XL', 'XXL', 'All Size'];

    protected $fillable = [
        'name', 'slug', 'category', 'sizes', 'color', 'material',
        'price', 'description', 'image_media_id', 'image_path', 'is_available',
    ];

    protected function casts(): array
    {
        return [
            'sizes'        => 'array',
            'price'        => 'integer',
            'is_available' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Kebaya $kebaya) {
            if (blank($kebaya->slug) || $kebaya->isDirty('name')) {
                $kebaya->slug = static::uniqueSlug($kebaya->name, $kebaya->id);
            }
        });

        static::deleted(fn (Kebaya $kebaya) => $kebaya->image?->delete());
    }

    public static function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'kebaya';
        $slug = $base;
        $i = 2;

        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->whereKeyNot($ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /* ---------- Relasi ---------- */

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_media_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /* ---------- Scope ---------- */

    public function scopeAvailable(Builder $q): Builder
    {
        return $q->where('is_available', true);
    }

    /* ---------- Helper ---------- */

    public function imageUrl(): string
    {
        if ($this->image_media_id) {
            return route('media.show', $this->image_media_id);
        }

        return asset($this->image_path ?: 'images/kebaya/kebaya_modern.png');
    }

    public function priceFormatted(): string
    {
        return 'Rp' . number_format($this->price, 0, ',', '.');
    }

    /** Apakah kebaya sudah dipesan pada rentang tanggal ini? */
    public function isBookedBetween(string $start, string $end, ?int $ignoreBookingId = null): bool
    {
        return $this->bookings()
            ->whereIn('status', Booking::BLOCKING_STATUSES)
            ->where('start_date', '<=', $end)
            ->where('end_date', '>=', $start)
            ->when($ignoreBookingId, fn ($q) => $q->whereKeyNot($ignoreBookingId))
            ->exists();
    }
}
