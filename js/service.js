const fileUpload = document.getElementById("fileUpload");
const preview = document.getElementById("preview");
const orderForm = document.getElementById("orderForm");
const resetBtn = document.getElementById("resetBtn");

if (fileUpload && preview) {
	fileUpload.addEventListener("change", function () {
		const file = this.files[0];
		if (!file) {
			preview.style.display = "none";
			preview.src = "";
			return;
		}

		if (file.type.startsWith("image/")) {
			const reader = new FileReader();
			reader.onload = function (e) {
				preview.src = e.target.result;
				preview.style.display = "block";
			};
			reader.readAsDataURL(file);
		} else {
			preview.style.display = "none";
			preview.src = "";
		}
	});
}

if (resetBtn) {
	resetBtn.addEventListener("click", function () {
		setTimeout(function () {
			preview.style.display = "none";
			preview.src = "";
		}, 100);
	});
}
