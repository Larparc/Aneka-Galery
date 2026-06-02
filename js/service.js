const serviceData = {
    printing: {
        title: 'Print Hvs',
        desc: 'Layanan cetak dokumen seperti tugas, laporan, dan file digital dengan hasil tajam dan cepat.',
        badge: 'Printing',
        highlights: [
            'Cocok untuk file PDF, Word, dan gambar',
            'Pilihan ukuran kertas lengkap',
            'Bisa hitam putih atau warna'
        ],
        fields: `
        <div class="input-group">
            <label for="ukuran">Ukuran</label>
            <select id="ukuran" required>
                <option>A4</option>
                <option>A5</option>
                <option>F4</option>
                <option>Custom</option>
            </select>
        </div>

        <div class="input-group">
            <label for="jenis">Jenis</label>
            <select id="jenis" required>
                <option>Hitam Putih</option>
                <option>Full Color</option>
            </select>
        </div>

        <div class="input-group">
            <label for="finish">Output</label>
            <select id="finish" required>
                <option>Cetak Foto</option>
                <option>Hvs</option>
                <option>Paper Glossy</option>
                <option>Matte</option>
            </select>
        </div>
        `
    },

    photocopy: {
        title: 'Print Foto',
        desc: 'Layanan cetak foto dengan kualitas tinggi, warna tajam, dan hasil profesional.',
        badge: 'Print Foto',
        highlights: [
            'Cocok untuk foto formal dan kenangan',
            'Menggunakan kertas foto berkualitas',
            'Hasil tajam dan tahan lama'
        ],
        fields: `
        <div class="input-group">
            <label for="ukuran">Ukuran Foto</label>
            <select id="ukuran" required>
                <option>2x3</option>
                <option>3x4</option>
                <option>4x6</option>
                <option>4R</option>
                <option>Custom</option>
            </select>
        </div>

        <div class="input-group">
            <label for="jenis">Jenis</label>
            <select id="jenis" required>
                <option>Hitam Putih</option>
                <option>Full Color</option>
            </select>
        </div>

        <div class="input-group">
            <label for="finish">Output</label>
            <select id="finish" required>
                <option>Cetak Foto</option>
                <option>Hvs</option>
                <option>Paper Glossy</option>
                <option>Matte</option>
            </select>
        </div>
        `
    },

    design: {
        title: 'Sticker',
        desc: 'Layanan cetak sticker untuk kebutuhan bisnis maupun personal dengan hasil tajam dan tahan lama.',
        badge: 'Sticker',
        highlights: [
            'Cocok untuk branding dan dekorasi',
            'Bisa custom ukuran dan bentuk',
            'Kualitas tahan lama'
        ],
        fields: `
        <div class="input-group">
            <label for="ukuran">Ukuran</label>
            <select id="ukuran" required>
                <option>A4</option>
                <option>A5</option>
                <option>F4</option>
                <option>Custom</option>
            </select>
        </div>

        <div class="input-group">
            <label for="jenis">Jenis</label>
            <select id="jenis" required>
                <option>Hitam Putih</option>
                <option>Full Color</option>
            </select>
        </div>

        <div class="input-group">
            <label for="finish">Output</label>
            <select id="finish" required>
                <option>Cetak Foto</option>
                <option>Hvs</option>
                <option>Paper Glossy</option>
                <option>Matte</option>
            </select>
        </div>
        `
    },

    finishing: {
        title: 'Banner',
        desc: 'Layanan cetak banner berkualitas tinggi untuk kebutuhan promosi dan acara.',
        badge: 'Banner',
        highlights: [
            'Cocok untuk promosi usaha dan event',
            'Ukuran fleksibel',
            'Bahan kuat dan tahan cuaca'
        ],
        fields: `
        <div class="input-group">
            <label for="ukuran">Ukuran</label>
            <select id="ukuran" required>
                <option>A4</option>
                <option>A5</option>
                <option>F4</option>
                <option>Custom</option>
            </select>
        </div>

        <div class="input-group">
            <label for="jenis">Jenis</label>
            <select id="jenis" required>
                <option>Hitam Putih</option>
                <option>Full Color</option>
            </select>
        </div>

        <div class="input-group">
            <label for="finish">Output</label>
            <select id="finish" required>
                <option>Cetak Foto</option>
                <option>Hvs</option>
                <option>Paper Glossy</option>
                <option>Matte</option>
            </select>
        </div>
        `
    }
};

const serviceButtons = document.querySelectorAll('.service-btn');
const layananSelect = document.getElementById('layanan');
const dynamicFields = document.getElementById('dynamicFields');
const fileUpload = document.getElementById('fileUpload');
const preview = document.getElementById('preview');
const toast = document.getElementById('toast');
const orderForm = document.getElementById('orderForm');

function setActiveService(service) {
    const data = serviceData[service];

    layananSelect.value = service;
    dynamicFields.innerHTML = data.fields;
}

serviceButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
        setActiveService(btn.dataset.service);
    });
});

layananSelect.addEventListener('change', (e) => {
    setActiveService(e.target.value);
});

fileUpload.addEventListener('change', () => {
    const file = fileUpload.files[0];

    if (!file) {
        preview.style.display = 'none';
        preview.src = '';
        return;
    }

    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (event) {
            preview.src = event.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        preview.src = '';
    }
});

orderForm.addEventListener('submit', (e) => {
    e.preventDefault();

    toast.classList.add('show');

    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);

    orderForm.reset();
    preview.style.display = 'none';
    preview.src = '';
    setActiveService('printing');
});

document.getElementById('resetBtn').addEventListener('click', () => {
    setTimeout(() => {
        preview.style.display = 'none';
        preview.src = '';
        setActiveService('printing');
    }, 0);
});

setActiveService('printing');