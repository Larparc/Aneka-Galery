
// Fungsi untuk membuka modal
    function openModal() {
        document.getElementById('projectModal').classList.add('show');
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        document.getElementById('projectModal').classList.remove('show');
    }

    // Menutup modal jika user mengklik area latar belakang (di luar modal box)
    document.getElementById('projectModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    })
    
    function openEditModal(cardElement) {
    // 1. Ambil data dari kartu yang di-klik
    const title = cardElement.querySelector('h4').innerText;
    const desc = cardElement.querySelector('p').innerText;
    
    // 2. Masukkan data ke dalam elemen modal edit
    document.querySelector('#editProjectModal .edit-title').innerText = title;
    document.querySelector('#editProjectModal .edit-desc-input').value = desc;
    
    // 3. Tampilkan modal
    document.getElementById('editProjectModal').classList.add('show');
}

function closeEditModal() {
    document.getElementById('editProjectModal').classList.remove('show');
}

// Menutup modal jika klik di luar area putih modal
document.getElementById('editProjectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});