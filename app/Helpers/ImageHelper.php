<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageHelper
{
    public static function uploadAndConvert(
        $file,
        $folder = 'images',
        $maxWidth = 1920,
        $quality = 82,
        $keepOriginal = false
    ) {
        $path = public_path($folder);
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $originalExt = strtolower($file->getClientOriginalExtension());

        // ⭐ SVG: skip convert
        if ($originalExt === 'svg') {
            $filename = time() . '_' . uniqid() . '.svg';
            $file->move($path, $filename);
            return $filename;
        }

        // ⭐ keepOriginal (buat logo PNG)
        if ($keepOriginal) {
            $ext = $originalExt;
            $filename = time() . '_' . uniqid() . '.' . $ext;
            $file->move($path, $filename);
            return $filename;
        }

        // ⭐ HEIC/HEIF: coba convert pakai Imagick dulu
        if (in_array($originalExt, ['heic', 'heif'])) {
            $filename = time() . '_' . uniqid() . '.jpg';
            $fullPath = $path . '/' . $filename;

            if (extension_loaded('imagick')) {
                try {
                    $imagick = new \Imagick($file->getRealPath());
                    $imagick->setImageFormat('jpeg');
                    $imagick->setImageCompressionQuality($quality);
                    $imagick->thumbnailImage($maxWidth, 0, true);
                    $imagick->writeImage($fullPath);
                    $imagick->clear();

                    return $filename;
                } catch (\Exception $e) {
                    \Log::error('HEIC convert failed (Imagick): ' . $e->getMessage());
                    // fallback ke simpan asli
                    $filename = time() . '_' . uniqid() . '.heic';
                    $file->move($path, $filename);
                    return $filename;
                }
            }

            // Imagick nggak ada → simpan asli (browser gak bisa render)
            \Log::warning('HEIC uploaded tapi Imagick tidak tersedia');
            $filename = time() . '_' . uniqid() . '.heic';
            $file->move($path, $filename);
            return $filename;
        }

        // ⭐ Selain itu (JPG/PNG/WebP/AVIF): convert ke JPG
        $filename = time() . '_' . uniqid() . '.jpg';
        $fullPath = $path . '/' . $filename;

        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file->getRealPath());
            $image->scaleDown(width: $maxWidth);
            $image->toJpeg($quality)->save($fullPath);

            return $filename;
        } catch (\Exception $e) {
            \Log::error('Convert to JPG failed: ' . $e->getMessage());
            $filename = time() . '_' . uniqid() . '.' . $originalExt;
            $file->move($path, $filename);
            return $filename;
        }
    }
}