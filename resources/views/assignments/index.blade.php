how to populate selectedFiles with the initial data thats in the existing images, because when i post the form, the selectedFiles is [] / empty

@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')

<link href="{{ asset('Modernize') }}/bootstrap/package/dist/css/filepond.css" rel="stylesheet">
<link href="{{ asset('Modernize') }}/bootstrap/package/dist/css/filepondplugin.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('Modernize') }}/bootstrap/package/dist/css/all.min.css">
<style>
    #group {
        background-color: #e9ecef;
        padding: 0.375rem 0.75rem;
        cursor: not-allowed;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    #group[readonly] {
        background-color: #e9ecef;
        cursor: not-allowed;
        border: 1px solid #ced4da;
        color: #495057;
    }

    .terbilang {
        display: block;
        text-align: right;
        margin-top: 5px;
        font-style: italic;
    }
</style>
<div class="container-fluid mw-100">
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Menu Edit Material</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="/material">Data Material</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('Modernize/bootstrap/package/dist/images/breadcrumb/ChatBc.png') }}"
                             alt="" class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card w-100 position-relative overflow-hidden">
        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
            <h5 class="card-title fw-semibold mb-0 fs-5 lh-sm">Form Edit Material</h5>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('material.update', $material->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="mat_code" class="form-label">Kode Material</label>
                        <input type="text" class="form-control" id="mat_code" name="mat_code"
                               value="{{ old('mat_code', $material->mat_code) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="mat_name" class="form-label">Nama Material</label>
                        <input type="text" class="form-control" id="mat_name" name="mat_name"
                               value="{{ old('mat_name', $material->mat_name) }}" required>
                    </div>
                </div>

                <div class="row mt-3 mb-6">
                    <div class="col-md-4">
                        <label for="price_on_created" class="form-label">Harga Saat Dibuat</label>
                        <input type="number" class="form-control" id="price_on_created" name="price_on_created"
                               min="1" data-type="currency"
                               value="{{ old('price_on_created', $material->price_on_created) }}" required>
                        <span id="terbilang_price_on_created" class="text-muted terbilang"></span>

                    </div>

                    <div class="col-md-4">
                        <label for="accumulated_price" class="form-label">Harga Terakumulasi</label>
                        <input type="number" class="form-control" id="accumulated_price" name="accumulated_price"
                               min="1" data-type="currency"
                               value="{{ old('accumulated_price', $material->accumulated_price) }}" required>
                        <span id="terbilang_accumulated_price" class="text-muted terbilang"></span>

                    </div>
                    <div class="col-md-4">
                        <label for="last_trans_price" class="form-label">Harga Transaksi Terakhir</label>
                        <input type="number" class="form-control" id="last_trans_price" name="last_trans_price"
                               min="1" data-type="currency"
                               value="{{ old('last_trans_price', $material->last_trans_price) }}" required>
                        <span id="terbilang_last_trans_price" class="text-muted terbilang"></span>

                    </div>
                </div>

                <div class="row mt-3 mb-6">
                    <div class="col-md-4">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stock" name="stock" min="0"
                               data-type="currency" value="{{ old('stock', $material->stock) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="safety_stock" class="form-label">Stok Aman</label>
                        <input type="number" class="form-control" id="safety_stock" name="safety_stock"
                               min="0" data-type="currency"
                               value="{{ old('safety_stock', $material->safety_stock) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="uom" class="form-label">Satuan</label>
                        <input type="text" class="form-control" id="uom" name="uom"
                               value="{{ old('uom', $material->uom) }}" required>
                    </div>
                </div>

                <div class="row mt-3 mb-6">
                    <div class="col-md-4">
                        <label for="group" class="form-label">Grup</label>
                        <input type="text" class="form-control" id="group" name="group_id"
                               value="{{ $groups->firstWhere('id', $material->group_id)->group_name ?? '' }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="sloc_id" class="form-label">Lokasi Penyimpanan</label>
                        <select class="form-select" id="sloc_id" name="sloc_id" required>
                            @foreach ($storageLocations as $location)
                                <option value="{{ $location->id }}"
                                    {{ $material->sloc_id == $location->id ? 'selected' : '' }}>
                                    {{ $location->sloc_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="cat_id" class="form-label">Kategori</label>
                        <select class="form-select" id="cat_id" name="cat_id">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $material->cat_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->cat_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="mb-3">
                        <label for="material_images" class="form-label">Edit Gambar Material</label>
                        <small>Seleksi Gambar untuk Mengubah atau Menambah</small>

                        <!-- Area drop zone -->
                        <div id="drop_zone" class="drop-zone p-3 mb-3" ondrop="handleDrop(event)"
                             ondragover="handleDragOver(event)">
                            <p id="drop_zone_text">Drag & drop files here or click to upload</p>
                            <!-- Form untuk upload multiple file -->
                            <input type="file" id="material_images" name="material_images[]" multiple
                                   style="display: none;" onchange="handleFiles(this.files)">

                            <!-- Preview box inside drop zone -->
                            <div id="image_preview" class="image-preview d-flex justify-content-center flex-wrap">
                                <!-- Existing Images (added as hidden input to keep them during new uploads) -->
                                {{-- @foreach ($material->images->sortBy('order_no') as $image)
                                    <div class="image-container position-relative">
                                        <img src="{{ asset('storage/' . $image->filename) }}" alt="Image"
                                            class="img-thumbnail">
                                        <button type="button" class="delete-btn"
                                            onclick="removeExistingImage('{{ $image->filename }}')">×</button>
                                        <input type="hidden" name="existing_images[]"
                                            value="{{ $image->filename }}">
                                    </div>
                                @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="/material" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('layouts.footer')

<!-- Script section remains the same -->
<script>
    let selectedFiles = [];
    let existingImages = @json($material->images->pluck('filename'));

    function handleFiles(files) {
        // Tambahkan file baru ke array selectedFiles
        for (let i = 0; i < files.length; i++) {
            selectedFiles.push(files[i]);
        }
        previewImages();
    }

    document.addEventListener('DOMContentLoaded', function() {
        previewImages();
    });

    //ERROR
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        formData.append('_method', 'PUT');

        selectedFiles.forEach((file, i) => {
            formData.append(`material_images[${i}]`, file);
        });

        fetch(this.action, {
            method: 'POST', // Menggunakan POST dengan override
            body: formData,
            headers: {
                'X-HTTP-Method-Override': 'PUT', // Menggunakan header untuk mengoverride metode
            },
        }).then(response => {
            if (response.ok) {
                window.location.href = "{{ route('material.index') }}"; // Redirect jika berhasil
            } else {
                console.error('Error updating material:', response.statusText);
            }
        }).catch(error => console.error('Fetch error:', error));
    });

    function previewImages() {
        const preview = document.getElementById('image_preview');
        preview.innerHTML = ''; // Kosongkan preview sebelumnya

        // Preview file baru
        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'image-container position-relative';

                const img = document.createElement('img');
                img.draggable = false;
                img.src = e.target.result;
                img.className = 'img-thumbnail'; // Pastikan img-thumbnail diterapkan

                // Tombol silang untuk menghapus gambar
                const deleteBtn = document.createElement('button');
                deleteBtn.innerHTML = 'X'; // Gunakan simbol silang yang sama
                deleteBtn.className = 'delete-btn'; // Pastikan class yang sama
                deleteBtn.setAttribute('data-index', index);
                deleteBtn.onclick = function(e) {
                    e.stopPropagation(); // Menghentikan event dari merambat ke drop zone
                    removeImage(index);
                };

                div.appendChild(img);
                div.appendChild(deleteBtn);
                preview.appendChild(div);
            };

            reader.readAsDataURL(file);
        });

        // Tampilkan gambar yang sudah ada
        existingImages.forEach((image, index) => {
            const div = document.createElement('div');
            div.className = 'image-container position-relative';

            const img = document.createElement('img');
            img.src = `/storage/${image}`;
            img.className = 'img-thumbnail'; // Pastikan img-thumbnail diterapkan
            img.draggable = false;

            // Tombol silang untuk menghapus gambar yang sudah ada
            const deleteBtn = document.createElement('button');
            deleteBtn.innerHTML = 'X'; // Gunakan simbol silang yang sama
            deleteBtn.className = 'delete-btn'; // Pastikan class yang sama
            deleteBtn.onclick = function(e) {
                e.stopPropagation(); // Menghentikan event dari merambat ke drop zone
                removeExistingImage(image);
            };

            div.appendChild(img);
            div.appendChild(deleteBtn);
            preview.appendChild(div);
        });

        // fill selectedFiles with existing images
        selectedFiles = existingImages.map(filename => new File([], filename));

    }


    function removeExistingImage(filename) {
        existingImages = existingImages.filter(image => image !== filename);
        previewImages();
    }

    document.getElementById('drop_zone').addEventListener('click', function() {
        document.getElementById('material_images').click();
    });

    function handleDragOver(event) {
        event.preventDefault();
        document.getElementById('drop_zone').classList.add('dragover');
    }

    function handleDrop(event) {
        event.preventDefault();
        document.getElementById('drop_zone').classList.remove('dragover');
        const files = event.dataTransfer.files;
        handleFiles(files);
    }

    document.getElementById('drop_zone').addEventListener('dragleave', function(event) {
        event.preventDefault();
        document.getElementById('drop_zone').classList.remove('dragover');
    });
</script>


<!-- Styles untuk Drop Zone dan Preview Box -->
<style>
    .drop-zone {
        border: 2px dashed #ccc;
        border-radius: 10px;
        text-align: center;
        cursor: pointer;
        position: relative;
        min-height: 200px;
    }

    .drop-zone.dragover {
        background-color: #f0f8ff;
        border-color: #007bff;
    }

    .image-preview {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        padding: 10px;
    }

    .image-preview .image-container {
        position: relative;
        margin: 10px;
        width: 150px;
        height: 150px;
        display: inline-block;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #ddd;
        cursor: move;
    }

    /* Tombol silang untuk menghapus gambar, dirapikan ke pojok kanan atas */
    .image-preview .delete-btn {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 50%;
        padding: 0 5px;
        cursor: pointer;
        font-size: 18px;
        width: 24px;
        height: 24px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Hide the default text once a file is selected */
    .drop-zone.has-files #drop_zone_text {
        display: none;
    }

    /* Show the text if there are no images */
    .drop-zone.empty #drop_zone_text {
        display: block;
    }

    /* Gaya gambar saat drag aktif */
    .dragging {
        opacity: 0.5;
    }
</style>


<script>
    function convertToWords(num) {
        const satuan = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'];
        const belasan = ['sepuluh', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas', 'enam belas',
            'tujuh belas', 'delapan belas', 'sembilan belas',
        ];
        const puluhan = ['', '', 'dua puluh', 'tiga puluh', 'empat puluh', 'lima puluh', 'enam puluh', 'tujuh puluh',
            'delapan puluh', 'sembilan puluh',
        ];
        const ribuan = ['', 'ribu', 'juta', 'miliar', 'triliun'];

        // Batas maksimum angka (15 digit: 999 triliun)
        const maxLimit = 999999999999999;

        if (num > maxLimit) {
            return 'tidak diketahui';
        }

        // Fungsi untuk menangani angka per 3 digit
        function inHundreds(num) {
            let result = '';
            const hundred = Math.floor(num / 100);
            const remainder = num % 100;

            if (hundred > 0) {
                if (hundred === 1) {
                    result += 'seratus ';
                } else {
                    result += satuan[hundred] + ' ratus ';
                }
            }

            if (remainder < 10) {
                result += satuan[remainder];
            } else if (remainder < 20) {
                result += belasan[remainder - 10];
            } else {
                result += puluhan[Math.floor(remainder / 10)] + ' ' + satuan[remainder % 10];
            }

            return result.trim();
        }

        // Fungsi untuk menggabungkan bagian ribuan, jutaan, miliar, triliun, dll.
        function groupInThousands(num) {
            let result = '';
            let i = 0;

            while (num > 0) {
                const hundredsPart = num % 1000;
                if (hundredsPart > 0) {
                    let prefix = inHundreds(hundredsPart);
                    if (i > 0 && hundredsPart === 1 && i === 1) {
                        // Penanganan khusus untuk "seribu"
                        prefix = 'seribu';
                    }
                    result = prefix + ' ' + ribuan[i] + ' ' + result;
                }
                num = Math.floor(num / 1000);
                i++;
            }

            return result.trim();
        }

        if (num === 0) {
            return 'nol rupiah';
        }

        return groupInThousands(num) + ' rupiah';
    }

    // Fungsi untuk mengupdate elemen span terbilang
    function updateTerbilang(id, terbilangId) {
        const inputValue = document.getElementById(id).value;
        const terbilangText = convertToWords(Number(inputValue));
        document.getElementById(terbilangId).innerText = terbilangText ? terbilangText : '';
    }

    // Memanggil update terbilang saat halaman dimuat pertama kali
    updateTerbilang('price_on_created', 'terbilang_price_on_created');
    updateTerbilang('accumulated_price', 'terbilang_accumulated_price');
    updateTerbilang('last_trans_price', 'terbilang_last_trans_price');

    // Menambahkan event listener pada setiap input number
    document.getElementById('price_on_created').addEventListener('input', function() {
        updateTerbilang('price_on_created', 'terbilang_price_on_created');
    });

    document.getElementById('accumulated_price').addEventListener('input', function() {
        updateTerbilang('accumulated_price', 'terbilang_accumulated_price');
    });

    document.getElementById('last_trans_price').addEventListener('input', function() {
        updateTerbilang('last_trans_price', 'terbilang_last_trans_price');
    });
</script>
