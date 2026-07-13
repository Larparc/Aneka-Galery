// Sidebar toggle
document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.getElementById("menu-btn");
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");

    if (menuBtn && sidebar && overlay) {
        menuBtn.addEventListener("click", function () {
            sidebar.classList.toggle("active");
            overlay.classList.toggle("active");
        });

        overlay.addEventListener("click", function () {
            sidebar.classList.remove("active");
            overlay.classList.remove("active");
        });
    }
});

// notif admin
document.addEventListener("DOMContentLoaded", function () {
    const notifBtn = document.getElementById("notif-btn");
    const notifDropdown = document.getElementById("notif-dropdown");
    const notifBadge = document.getElementById("notif-badge");
    const notifItems = document.querySelectorAll("#notif-list .notif-item");

    console.log("Notif Debug:", {
        notifBtn: notifBtn,
        notifDropdown: notifDropdown,
        notifBadge: notifBadge,
        notifItems: notifItems.length
    });

    if (!notifBtn || !notifDropdown || !notifBadge) {
        console.error("Notifikasi element tidak ditemukan!");
        return;
    }

    const STORAGE_KEY = "admin_notif_last_seen";
    const lastSeen = parseInt(localStorage.getItem(STORAGE_KEY) || "0", 10);

    let unreadCount = 0;
    let newestTime = lastSeen;

    notifItems.forEach(function (item) {
        const time = parseInt(item.dataset.time || "0", 10);
        if (time > newestTime) newestTime = time;
        if (time > lastSeen) {
            item.classList.add("unread");
            unreadCount++;
        }
    });

    updateBadge(unreadCount);

    function updateBadge(count) {
        if (count > 0) {
            notifBadge.textContent = count > 9 ? "9+" : count;
            notifBadge.style.display = "flex";
        } else {
            notifBadge.style.display = "none";
        }
    }

    notifBtn.addEventListener("click", function (e) {
        e.stopPropagation();
        const willOpen = !notifDropdown.classList.contains("open");
        notifDropdown.classList.toggle("open");

        if (willOpen) {
            localStorage.setItem(STORAGE_KEY, String(newestTime));
            setTimeout(function () {
                notifItems.forEach(function (item) {
                    item.classList.remove("unread");
                });
                updateBadge(0);
            }, 600);
        }
    });

    document.addEventListener("click", function (e) {
        if (!notifDropdown.contains(e.target) && e.target !== notifBtn) {
            notifDropdown.classList.remove("open");
        }
    });
});