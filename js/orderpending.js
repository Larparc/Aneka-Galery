(function() {
    const ordersData = window.ordersData || [];
    let currentOrders = [...ordersData];
    let currentSort = 'date_desc';
    let selectedOrderId = null;
    let selectedNewStatus = null;

    const listEl = document.getElementById('order-list');
    const filterBtn = document.getElementById('filterBtn');
    const filterLabel = document.getElementById('filterLabel');
    const filterDropdown = document.getElementById('filterDropdown');
    const filterOptions = document.querySelectorAll('.filter-option');
    const modal = document.getElementById('statusModal');
    const modalBody = document.getElementById('modalBody');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modalCancelBtn = document.getElementById('modalCancelBtn');
    const modalSaveBtn = document.getElementById('modalSaveBtn');

    function renderOrders(orders) {
        if (!orders || orders.length === 0) {
            listEl.innerHTML = `<div class="empty">Tidak ada pesanan pending.</div>`;
            return;
        }
        let html = '';
        orders.forEach(order => {
            const date = new Date(order.date);
            const formattedDate = date.toLocaleDateString('id-ID', {
                day: 'numeric', month: 'long', year: 'numeric',
                hour: '2-digit', minute: '2-digit'
            });

            let detailsHtml = '';
            if (order.details && order.details.length > 0) {
                order.details.forEach(d => {
                    detailsHtml += `
                        <span class="detail-tag">
                            <i class="fas fa-print"></i> ${d.service || 'Print'}
                            <span style="opacity:0.4;margin:0 4px;">|</span>
                            ${d.paper || 0} pcs
                            <span style="opacity:0.4;margin:0 4px;">|</span>
                            ${d.size || '-'}
                            <span style="opacity:0.4;margin:0 4px;">|</span>
                            ${d.colour || '-'}
                            <span style="opacity:0.4;margin:0 4px;">|</span>
                            ${d.output || '-'}
                        </span>
                    `;
                });
            } else {
                detailsHtml = `<span class="detail-tag" style="color:#aaa;">Tidak ada detail</span>`;
            }

            let fileHtml = '';
            if (order.details && order.details.length > 0) {
                const firstFile = order.details[0].file;
                if (firstFile) {
                    const ext = firstFile.split('.').pop().toLowerCase();
                    const isImage = ['jpg','jpeg','png','gif','webp','svg'].includes(ext);
                    if (isImage) {
                        fileHtml = `
                            <div class="file-preview">
                                <img src="${firstFile}" alt="file" onerror="this.src='../img/default.png'">
                                <span class="file-name">${firstFile.split('/').pop()}</span>
                            </div>
                        `;
                    } else {
                        fileHtml = `
                            <div class="file-preview">
                                <i class="fas fa-file" style="color:var(--teal);font-size:20px;"></i>
                                <span class="file-name">${firstFile.split('/').pop()}</span>
                            </div>
                        `;
                    }
                }
            }

            let desc = '';
            if (order.details && order.details.length > 0 && order.details[0].description) {
                desc = order.details[0].description;
            }

            const avatarUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(order.username)}&background=0c5d59&color=fff&size=40`;

            html += `
                <div class="order-card" data-order-id="${order.order_id}" onclick="openModal(${order.order_id})">
                    <div class="avatar-col">
                        <img src="${avatarUrl}" alt="${order.username}">
                    </div>
                    <div class="body-col">
                        <div class="top-row">
                            <span class="username">${order.username}</span>
                            <div class="order-meta">
                                <span class="order-id">#${order.order_id}</span>
                                <span><i class="far fa-calendar-alt"></i> ${formattedDate}</span>
                            </div>
                        </div>
                        <div class="details-row">${detailsHtml}</div>
                        ${desc ? `<div class="desc-preview"><i class="fas fa-quote-left" style="opacity:0.3;"></i> ${desc}</div>` : ''}
                        <div class="footer-row">
                            ${fileHtml}
                            <span class="status-badge pending">Pending</span>
                        </div>
                    </div>
                </div>
            `;
        });
        listEl.innerHTML = html;
    }

    function sortOrders(sortKey) {
        currentSort = sortKey;
        const sorted = [...currentOrders];
        switch (sortKey) {
            case 'date_desc': sorted.sort((a, b) => new Date(b.date) - new Date(a.date)); break;
            case 'date_asc': sorted.sort((a, b) => new Date(a.date) - new Date(b.date)); break;
            case 'username_asc': sorted.sort((a, b) => a.username.localeCompare(b.username)); break;
            case 'username_desc': sorted.sort((a, b) => b.username.localeCompare(a.username)); break;
            default: break;
        }
        renderOrders(sorted);
        const labelMap = {
            'date_desc': 'Terbaru',
            'date_asc': 'Terlama',
            'username_asc': 'A-Z',
            'username_desc': 'Z-A'
        };
        filterLabel.textContent = labelMap[sortKey] || 'Urutkan';
        filterOptions.forEach(opt => {
            opt.classList.toggle('active', opt.dataset.sort === sortKey);
        });
        filterDropdown.classList.remove('show');
    }

    if (filterBtn) {
        filterBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            filterDropdown.classList.toggle('show');
        });
    }

    document.addEventListener('click', function(e) {
        if (filterDropdown && !filterBtn.contains(e.target) && !filterDropdown.contains(e.target)) {
            filterDropdown.classList.remove('show');
        }
    });

    filterOptions.forEach(opt => {
        opt.addEventListener('click', function() {
            sortOrders(this.dataset.sort);
        });
    });

    // ========== MODAL DENGAN LABEL BAHASA INGGRIS ==========
    window.openModal = function(orderId) {
        const order = currentOrders.find(o => o.order_id === orderId);
        if (!order) return;
        selectedOrderId = orderId;
        selectedNewStatus = 'pending';

        let descText = '';
        let fileData = null;
        let detailRows = '';
        if (order.details && order.details.length > 0) {
            order.details.forEach((d, idx) => {
                detailRows += `
                    <div class="info-row">
                        <span class="label">Order Details</span>
                        <span class="value">${d.service || 'Print'} · ${d.paper || 0} pcs · ${d.size || '-'} · ${d.colour || '-'} · ${d.output || '-'}</span>
                    </div>
                `;
                if (idx === 0) {
                    descText = d.description || '';
                    fileData = d.file || null;
                }
            });
        } else {
            detailRows = `<div class="info-row"><span class="label">Order Details</span><span class="value" style="color:#aaa;">No details</span></div>`;
        }

        const date = new Date(order.date);
        const formattedDate = date.toLocaleDateString('id-ID', {
            day: 'numeric', month: 'long', year: 'numeric',
            hour: '2-digit', minute: '2-digit'
        });

        // Deskripsi
        let descHtml = '';
        if (descText) {
            descHtml = `<div class="modal-desc"><i class="fas fa-quote-left" style="opacity:0.3;margin-right:6px;"></i>${descText}</div>`;
        } else {
            descHtml = `<div style="color:#aaa;font-style:italic;margin-top:8px;">No note.</div>`;
        }

        // File preview
        let fileHtml = '';
        if (fileData) {
            const ext = fileData.split('.').pop().toLowerCase();
            const isImage = ['jpg','jpeg','png','gif','webp','svg'].includes(ext);
            const fileName = fileData.split('/').pop();
            if (isImage) {
                fileHtml = `
                    <div class="modal-file-preview">
                        <img src="${fileData}" alt="file" onerror="this.src='../img/default.png'; this.onerror=null;">
                        <span class="file-name">${fileName}</span>
                        <a href="${fileData}" download class="download-link"><i class="fas fa-download"></i> Download</a>
                    </div>
                `;
            } else {
                fileHtml = `
                    <div class="modal-file-preview">
                        <i class="fas fa-file" style="font-size:48px;color:var(--teal);display:block;margin-bottom:8px;"></i>
                        <span class="file-name">${fileName}</span>
                        <a href="${fileData}" download class="download-link"><i class="fas fa-download"></i> Download</a>
                    </div>
                `;
            }
        } else {
            fileHtml = `<div class="modal-no-file">No file attached.</div>`;
        }

        // ========== STRUKTUR MODAL DENGAN LABEL BARU ==========
        modalBody.innerHTML = `
            <div class="info-row"><span class="label">Order ID</span><span class="value">#${order.order_id}</span></div>
            <div class="info-row"><span class="label">From</span><span class="value">${order.username}</span></div>
            <div class="info-row"><span class="label">Contact Number</span><span class="value">${order.phone || '-'}</span></div>
            <div class="info-row"><span class="label">Date</span><span class="value">${formattedDate}</span></div>
            ${detailRows}
            <div class="info-row" style="border-bottom:none;padding-bottom:4px;margin-top:12px;">
                <span class="label">Note</span>
            </div>
            ${descHtml}
            <div class="info-row" style="border-bottom:none;padding-bottom:4px;margin-top:12px;">
                <span class="label">File</span>
            </div>
            ${fileHtml}
            <div class="info-row" style="border-bottom:none;padding-bottom:4px;margin-top:12px;">
                <span class="label">Status</span>
                <span class="value" style="text-transform:capitalize;color:var(--amber);">pending</span>
            </div>
            <div style="margin-top:16px;font-weight:600;font-size:14px;color:#555;">Order Status:</div>
            <div class="status-options">
                <div class="status-opt pending active" data-status="pending" onclick="selectStatus('pending')">
                    <i class="fas fa-hourglass-half"></i> Pending
                </div>
                <div class="status-opt complete" data-status="complete" onclick="selectStatus('complete')">
                    <i class="fas fa-check-circle"></i> Complete
                </div>
                <div class="status-opt cancelled" data-status="cancelled" onclick="selectStatus('cancelled')">
                    <i class="fas fa-times-circle"></i> Cancelled
                </div>
            </div>
        `;
        modal.style.display = 'block';
    };

    window.selectStatus = function(status) {
        selectedNewStatus = status;
        document.querySelectorAll('.status-opt').forEach(el => el.classList.remove('active'));
        document.querySelector(`.status-opt[data-status="${status}"]`).classList.add('active');
    };

    function closeModal() {
        modal.style.display = 'none';
        selectedOrderId = null;
        selectedNewStatus = null;
    }
    if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
    if (modalCancelBtn) modalCancelBtn.addEventListener('click', closeModal);
    window.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
    });

    if (modalSaveBtn) {
        modalSaveBtn.addEventListener('click', function() {
            if (!selectedOrderId || !selectedNewStatus) {
                alert('Please select a status.');
                return;
            }
            fetch('update_order_status.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `order_id=${selectedOrderId}&status=${selectedNewStatus}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Status updated successfully.');
                    closeModal();
                    location.reload();
                } else {
                    alert('Failed to update status: ' + data.message);
                }
            })
            .catch(err => alert('Error: ' + err.message));
        });
    }

    const menuBtn = document.getElementById('menu-btn');
    if (menuBtn) {
        menuBtn.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('show');
        });
    }
    const overlay = document.getElementById('overlay');
    if (overlay) {
        overlay.addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('overlay').classList.remove('show');
        });
    }

    sortOrders('date_desc');
})();