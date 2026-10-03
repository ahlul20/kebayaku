<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Media extends Model
{
    protected $fillable = ['mime', 'size', 'data', 'is_private'];

    protected $hidden = ['data'];

    protected function casts(): array
    {
        return ['is_private' => 'boolean'];
    }

    /** Simpan file upload ke database. */
    public static function fromUpload(UploadedFile $file, bool $private = false): self
    {
        return self::create([
            'mime'       => $file->getMimeType() ?: 'application/octet-stream',
            'size'       => $file->getSize(),
            'data'       => base64_encode($file->get()),
            'is_private' => $private,
        ]);
    }

    /** Ganti media lama dengan upload baru, hapus yang lama. */
    public static function replace(?self $old, UploadedFile $file, bool $private = false): self
    {
        $new = self::fromUpload($file, $private);
        $old?->delete();

        return $new;
    }

    public function url(): string
    {
        return route('media.show', $this);
    }
}
