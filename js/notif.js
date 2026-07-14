document.addEventListener('DOMContentLoaded', function () {
    const notifBtn = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');
    const notifBadge = document.getElementById('notifBadge');
    const notifItems = document.querySelectorAll('#notifList .notif-item');
    const notifClear = document.getElementById('notifClear');

    if (!notifBtn || !notifDropdown || !notifBadge) return;

    const STORAGE_KEY = 'admin_notif_last_seen';
    let lastSeen = parseInt(localStorage.getItem(STORAGE_KEY) || '0', 10);

    let newestTime = lastSeen;
    let unreadCount = 0;

    notifItems.forEach(function (item) {
        const time = parseInt(item.dataset.time || '0', 10);
        if (time > newestTime) newestTime = time;
        if (time > lastSeen) {
            item.classList.add('unread');
            unreadCount++;
        }
    });

    updateBadge(unreadCount);

    function updateBadge(count) {
        if (count > 0) {
            notifBadge.textContent = count > 9 ? '9+' : count;
            notifBadge.style.display = 'flex';
        } else {
            notifBadge.style.display = 'none';
        }
    }

    notifBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        const willOpen = !notifDropdown.classList.contains('open');
        notifDropdown.classList.toggle('open');

        if (willOpen && unreadCount > 0) {
            // Mark as read
            localStorage.setItem(STORAGE_KEY, String(newestTime));
            notifItems.forEach(function (item) {
                item.classList.remove('unread');
            });
            updateBadge(0);
            unreadCount = 0;
        }
    });

    document.addEventListener('click', function (e) {
        if (!notifDropdown.contains(e.target) && e.target !== notifBtn && !notifBtn.contains(e.target)) {
            notifDropdown.classList.remove('open');
        }
    });

    if (notifClear) {
        notifClear.addEventListener('click', function (e) {
            e.stopPropagation();
            localStorage.setItem(STORAGE_KEY, String(newestTime));
            notifItems.forEach(function (item) {
                item.classList.remove('unread');
            });
            updateBadge(0);
            unreadCount = 0;
            notifDropdown.classList.remove('open');
        });
    }

    // Sidebar toggle (reuse from panel.js, tapi kita tambahkan di sini)
    const menuBtn = document.getElementById('menu-btn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    if (menuBtn && sidebar && overlay) {
        menuBtn.addEventListener('click', function () {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        });
        overlay.addEventListener('click', function () {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });
    }
});