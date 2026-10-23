import imageCompression from 'browser-image-compression';
import heic2any from 'heic2any';

/**
 * Auto-compress & auto-convert semua input file gambar
 * Cara pakai: tambahin class "auto-compress" ke <input type="file">
 */
document.addEventListener('DOMContentLoaded', function () {
    // Config kompresi
    const options = {
        maxSizeMB: 1,
        maxWidthOrHeight: 1920,
        useWebWorker: true,
        fileType: 'image/jpeg',
        initialQuality: 0.82,
    };

    const fileInputs = document.querySelectorAll('input[type="file"].auto-compress');

    fileInputs.forEach(input => {
        input.addEventListener('change', async function (e) {
            const files = Array.from(e.target.files);
            if (files.length === 0) return;

            showLoading(input, true);

            try {
                const compressedFiles = [];

                for (const file of files) {
                    let workingFile = file;

                    // ⭐ STEP 1: Cek HEIC/HEIF — convert ke JPG DULU
                    const isHeic = file.type === 'image/heic'
                        || file.type === 'image/heif'
                        || /\.heic$/i.test(file.name)
                        || /\.heif$/i.test(file.name);

                    if (isHeic) {
                        console.log(`🍎 Convert HEIC: ${file.name} (${(file.size / 1024 / 1024).toFixed(2)}MB)`);
                        try {
                            const result = await heic2any({
                                blob: file,
                                toType: 'image/jpeg',
                                quality: 0.85,
                            });

                            // heic2any kadang return array
                            const blob = Array.isArray(result) ? result[0] : result;

                            workingFile = new File(
                                [blob],
                                file.name.replace(/\.heic$|\.heif$/i, '.jpg'),
                                { type: 'image/jpeg', lastModified: Date.now() }
                            );

                            console.log(`✅ HEIC converted: ${(workingFile.size / 1024 / 1024).toFixed(2)}MB`);
                        } catch (err) {
                            console.error(`❌ Gagal convert HEIC (${file.name}):`, err);
                            alert(`Gagal convert ${file.name}. Format HEIC mungkin tidak didukung. Coba convert ke JPG di HP dulu.`);
                            continue; // Skip file ini
                        }
                    }

                    // ⭐ STEP 2: Skip SVG (jangan convert, biar tetap vektor)
                    if (workingFile.type === 'image/svg+xml' || /\.svg$/i.test(workingFile.name)) {
                        console.log(`⏭️ Skip SVG: ${workingFile.name}`);
                        compressedFiles.push(workingFile);
                        continue;
                    }

                    // ⭐ STEP 3: Skip file kecil (< 500KB) — udah kecil
                    if (workingFile.size < 500 * 1024) {
                        console.log(`⏭️ Skip file kecil: ${workingFile.name} (${(workingFile.size / 1024).toFixed(0)}KB)`);
                        compressedFiles.push(workingFile);
                        continue;
                    }

                    // ⭐ STEP 4: Kompres file
                    console.log(`📸 Kompres: ${workingFile.name} (${(workingFile.size / 1024 / 1024).toFixed(2)}MB)`);

                    try {
                        const compressed = await imageCompression(workingFile, options);

                        console.log(`✅ Hasil: ${(compressed.size / 1024 / 1024).toFixed(2)}MB`);

                        const newFile = new File(
                            [compressed],
                            workingFile.name.replace(/\.[^.]+$/, '.jpg'),
                            { type: 'image/jpeg', lastModified: Date.now() }
                        );

                        compressedFiles.push(newFile);
                    } catch (err) {
                        console.error(`❌ Gagal kompres ${workingFile.name}:`, err);
                        // Fallback: kirim file asli kalau kompres gagal
                        compressedFiles.push(workingFile);
                    }
                }

                // Ganti file di input pakai DataTransfer
                const dt = new DataTransfer();
                compressedFiles.forEach(f => dt.items.add(f));
                input.files = dt.files;

                console.log(`🎉 Total ${compressedFiles.length} file siap upload`);
            } catch (err) {
                console.error('❌ Gagal proses:', err);
                alert('Terjadi kesalahan saat memproses gambar.');
            } finally {
                showLoading(input, false);
            }
        });
    });

    function showLoading(input, show) {
        const parent = input.parentElement;
        let loader = parent.querySelector('.compress-loader');

        if (show && !loader) {
            loader = document.createElement('p');
            loader.className = 'compress-loader text-xs text-blue-600 mt-1 animate-pulse';
            loader.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Memproses gambar...';
            parent.appendChild(loader);
        } else if (!show && loader) {
            loader.remove();
        }
    }
});