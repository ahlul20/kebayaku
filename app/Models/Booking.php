<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Booking extends Model
{
    /* ---------- Status penyewaan ---------- */
    public const STATUS_PENDING   = 'Menunggu Verifikasi';
    public const STATUS_APPROVED  = 'Disetujui';
    public const STATUS_SHIPPED   = 'Dikirim';
    public const STATUS_RENTED    = 'Disewa';
    public const STATUS_DONE      = 'Selesai';
    public const STATUS_REJECTED  = 'Ditolak';
    public const STATUS_CANCELLED = 'Dibatalkan';

    /** Urutan alur normal (untuk timeline). */
    public const FLOW = [
        self::STATUS_PENDING,
        self::STATUS_APPROVED,
        self::STATUS_SHIPPED,
        self::STATUS_RENTED,
        self::STATUS_DONE,
    ];

    public const STATUSES = [...self::FLOW, self::STATUS_REJECTED, self::STATUS_CANCELLED];

    /** Status yang membuat kebaya "terpakai" pada tanggal tersebut. */
    public const BLOCKING_STATUSES = [
        self::STATUS_PENDING, self::STATUS_APPROVED, self::STATUS_SHIPPED, self::STATUS_RENTED,
    ];

    /** Keterangan tiap status untuk pelanggan. */
    public const STATUS_INFO = [
        self::STATUS_PENDING   => ['icon' => 'fa-hourglass-half', 'color' => 'amber',  'desc' => 'Pesanan diterima, admin sedang memeriksa data & pembayaran.'],
        self::STATUS_APPROVED  => ['icon' => 'fa-circle-check',   'color' => 'green',  'desc' => 'Pesanan disetujui, kebaya sedang disiapkan.'],
        self::STATUS_SHIPPED   => ['icon' => 'fa-truck-fast',     'color' => 'blue',   'desc' => 'Kebaya dikirim / siap diambil di butik.'],
        self::STATUS_RENTED    => ['icon' => 'fa-shirt',          'color' => 'purple', 'desc' => 'Kebaya sedang kamu pakai. Selamat menikmati acaranya!'],
        self::STATUS_DONE      => ['icon' => 'fa-flag-checkered', 'color' => 'gray',   'desc' => 'Kebaya sudah dikembalikan. Deposit dikembalikan.'],
        self::STATUS_REJECTED  => ['icon' => 'fa-circle-xmark',   'color' => 'red',    'desc' => 'Pesanan ditolak. Hubungi kami untuk info lebih lanjut.'],
        self::STATUS_CANCELLED => ['icon' => 'fa-ban',            'color' => 'red',    'desc' => 'Pesanan dibatalkan.'],
    ];

    /* ---------- Aturan harga ---------- */
    public const BASE_DAYS = 3;
    public const MAX_DAYS  = 14;
    public const DEPOSIT   = 100000;

    protected $fillable = [
        'invoice_id', 'kebaya_id', 'customer_name', 'whatsapp', 'email',
        'size', 'start_date', 'end_date', 'duration_days',
        'rent_price', 'deposit', 'total_price',
        'delivery_type', 'address', 'notes',
        'ktp_media_id', 'proof_media_id', 'status',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date'   => 'date',
        ];
    }

    /* ---------- Relasi ---------- */

    public function kebaya(): BelongsTo
    {
        return $this->belongsTo(Kebaya::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(BookingLog::class)->latest('id');
    }

    public function ktp(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'ktp_media_id');
    }

    public function proof(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'proof_media_id');
    }

    /* ---------- Helper ---------- */

    /**
     * Hitung harga: harga dasar berlaku untuk 3 hari pertama,
     * tiap hari tambahan dikenakan (harga ÷ 3).
     */
    public static function calculate(Kebaya $kebaya, string $start, string $end): array
    {
        $days  = Carbon::parse($start)->diffInDays(Carbon::parse($end)) + 1;
        $extra = max(0, $days - self::BASE_DAYS);
        $rent  = $kebaya->price + (int) ceil($extra * $kebaya->price / self::BASE_DAYS);

        return [
            'duration_days' => (int) $days,
            'rent_price'    => $rent,
            'deposit'       => self::DEPOSIT,
            'total_price'   => $rent + self::DEPOSIT,
        ];
    }

    public static function generateInvoiceId(): string
    {
        do {
            // Tanpa huruf/angka yang mirip (0/O, 1/I) agar mudah diketik pelanggan
            $code = 'INV-' . collect(str_split(str_repeat('ABCDEFGHJKLMNPQRSTUVWXYZ23456789', 2)))
                ->shuffle()->take(6)->implode('');
        } while (self::where('invoice_id', $code)->exists());

        return $code;
    }

    /** Normalisasi nomor WA ke format 62xxxx. */
    public static function normalizePhone(string $phone): string
    {
        $digits = preg_replace('/\D/', '', $phone);

        return Str::startsWith($digits, '0') ? '62' . substr($digits, 1) : $digits;
    }

    public function changeStatus(string $status, ?string $note = null, ?int $userId = null): void
    {
        $this->update(['status' => $status]);
        $this->logs()->create(['status' => $status, 'note' => $note, 'user_id' => $userId]);
    }

    public function info(): array
    {
        return self::STATUS_INFO[$this->status] ?? self::STATUS_INFO[self::STATUS_PENDING];
    }

    public function isClosed(): bool
    {
        return in_array($this->status, [self::STATUS_DONE, self::STATUS_REJECTED, self::STATUS_CANCELLED], true);
    }

    public static function rupiah(int $amount): string
    {
        return 'Rp' . number_format($amount, 0, ',', '.');
    }
}
