class MultiPendudukForm {
    constructor() {
        this.rowIndex = this.getInitialRowCount();
        this.initEventListeners();
        this.initErrorHighlighting();
        this.initRealTimeValidation();
    }

    getInitialRowCount() {
        const rows = document.querySelectorAll("#penduduk-table tbody tr");
        return rows.length;
    }

    initEventListeners() {
        // Tambah baris baru
        const addRowBtn = document.getElementById("add-row");
        if (addRowBtn) {
            addRowBtn.addEventListener("click", () => this.addNewRow());
        }

        // Hapus baris
        document.addEventListener("click", (e) => {
            if (e.target.closest(".remove-row")) {
                this.removeRow(e);
            }
        });

        // Form submission
        const form = document.getElementById("multi-penduduk-form");
        if (form) {
            form.addEventListener("submit", (e) => this.validateForm(e));
        }
    }

    addNewRow() {
        console.log("Adding new row with index:", this.rowIndex);

        const tbody = document.querySelector("#penduduk-table tbody");
        const firstRow = tbody.querySelector("tr");
        const newRow = firstRow.cloneNode(true);

        // Reset row attributes
        newRow.setAttribute("data-index", this.rowIndex);
        newRow.classList.remove("table-danger");

        // Update form field names dan reset values
        newRow.querySelectorAll("input, select, textarea").forEach((input) => {
            this.updateInputAttributes(input, this.rowIndex);
            this.resetInputValue(input);
            this.removeErrorClasses(input);
        });

        // Remove error feedback divs
        newRow
            .querySelectorAll(".invalid-feedback, .nik-feedback")
            .forEach((feedback) => {
                feedback.remove();
            });

        tbody.appendChild(newRow);
        this.rowIndex++;

        // Auto focus pada NIK input yang baru
        const newNikInput = newRow.querySelector('input[name*="[nik]"]');
        if (newNikInput) {
            setTimeout(() => newNikInput.focus(), 100);
        }
    }

    updateInputAttributes(input, index) {
        const name = input.getAttribute("name");
        if (name) {
            const newName = name.replace(/\[\d+\]/, `[${index}]`);
            input.setAttribute("name", newName);
        }
    }

    resetInputValue(input) {
        if (input.tagName === "SELECT") {
            input.selectedIndex = 0;
        } else {
            input.value = "";
        }
    }

    removeErrorClasses(input) {
        input.classList.remove("is-invalid");
        input.style.borderColor = "";
        input.style.boxShadow = "";
    }

    removeRow(e) {
        e.preventDefault();

        const row = e.target.closest("tr");
        const tbody = row.parentNode;

        if (tbody.rows.length > 1) {
            // Show confirmation for rows with data
            const hasData = this.rowHasData(row);
            if (hasData) {
                if (
                    !confirm("Baris ini memiliki data. Yakin ingin menghapus?")
                ) {
                    return;
                }
            }

            row.remove();
            this.updateRowIndices();
            console.log("Row removed");
        } else {
            this.showAlert("Minimal 1 baris harus ada!", "warning");
        }
    }

    rowHasData(row) {
        const inputs = row.querySelectorAll("input, select, textarea");
        return Array.from(inputs).some((input) => input.value.trim() !== "");
    }

    updateRowIndices() {
        const tbody = document.querySelector("#penduduk-table tbody");
        const rows = tbody.querySelectorAll("tr");

        rows.forEach((row, index) => {
            row.setAttribute("data-index", index);

            row.querySelectorAll("input, select, textarea").forEach((input) => {
                this.updateInputAttributes(input, index);
            });
        });

        this.rowIndex = rows.length;
    }

    initErrorHighlighting() {
        document.addEventListener("DOMContentLoaded", () => {
            // Scroll ke error pertama jika ada
            const firstErrorRow = document.querySelector(".table-danger");
            if (firstErrorRow) {
                firstErrorRow.scrollIntoView({
                    behavior: "smooth",
                    block: "center",
                });

                // Focus pada input pertama yang error
                const firstErrorInput =
                    firstErrorRow.querySelector(".is-invalid");
                if (firstErrorInput) {
                    setTimeout(() => firstErrorInput.focus(), 500);
                }
            }

            // Enhanced error input styling
            this.enhanceErrorInputs();
        });
    }

    enhanceErrorInputs() {
        document.querySelectorAll(".is-invalid").forEach((input) => {
            input.addEventListener("focus", function () {
                this.style.borderColor = "#dc3545";
                this.style.boxShadow = "0 0 0 0.2rem rgba(220, 53, 69, 0.25)";
            });

            input.addEventListener("blur", function () {
                this.style.borderColor = "";
                this.style.boxShadow = "";
            });

            // Remove error class when user starts typing
            input.addEventListener("input", function () {
                if (this.classList.contains("is-invalid")) {
                    this.classList.remove("is-invalid");
                    const feedback =
                        this.parentNode.querySelector(".invalid-feedback");
                    if (feedback) {
                        feedback.style.display = "none";
                    }
                }
            });
        });
    }

    initRealTimeValidation() {
        // Real-time NIK validation
        document.addEventListener("input", (e) => {
            if (e.target.name && e.target.name.includes("[nik]")) {
                this.validateNIK(e.target);
            }
        });

        // Real-time No KK validation
        document.addEventListener("input", (e) => {
            if (e.target.name && e.target.name.includes("[no_kk]")) {
                this.validateNo_kk(e.target);
            }
        });

        // Real-time nama validation
        document.addEventListener("input", (e) => {
            if (e.target.name && e.target.name.includes("[nama]")) {
                this.validateNama(e.target);
            }
        });
    }

    validateNIK(nikInput) {
        const nik = nikInput.value;
        let feedback = nikInput.parentNode.querySelector(".nik-feedback");

        // Remove existing feedback
        if (feedback) {
            feedback.remove();
        }

        if (nik.length > 0) {
            let isValid = true;
            let message = "";
            let type = "warning";

            if (!/^\d+$/.test(nik)) {
                isValid = false;
                message = "❌ NIK hanya boleh berisi angka";
                type = "error";
            } else if (nik.length < 16) {
                isValid = false;
                message = `⏳ NIK harus 16 digit (sekarang ${nik.length} digit)`;
                type = "warning";
            } else if (nik.length === 16) {
                message = "✅ NIK format sudah benar";
                type = "success";
            }

            if (message) {
                const feedbackDiv = document.createElement("div");
                feedbackDiv.className = `nik-feedback small mt-1 ${
                    type === "success"
                        ? "text-success"
                        : type === "error"
                        ? "text-danger"
                        : "text-warning"
                }`;
                feedbackDiv.innerHTML = message;
                nikInput.parentNode.appendChild(feedbackDiv);
            }
        }
    }

    validateNo_kk(no_kkInput) {
        const no_kk = no_kkInput.value;
        let feedback = no_kkInput.parentNode.querySelector(".no_kk-feedback");

        // Remove existing feedback
        if (feedback) {
            feedback.remove();
        }

        if (no_kk.length > 0) {
            let isValid = true;
            let message = "";
            let type = "warning";

            if (!/^\d+$/.test(no_kk)) {
                isValid = false;
                message = "❌ No KK hanya boleh berisi angka";
                type = "error";
            } else if (no_kk.length < 16) {
                isValid = false;
                message = `⏳ No KK harus 16 digit (sekarang ${no_kk.length} digit)`;
                type = "warning";
            } else if (no_kk.length === 16) {
                message = "✅ No KK format sudah benar";
                type = "success";
            }

            if (message) {
                const feedbackDiv = document.createElement("div");
                feedbackDiv.className = `no_kk-feedback small mt-1 ${
                    type === "success"
                        ? "text-success"
                        : type === "error"
                        ? "text-danger"
                        : "text-warning"
                }`;
                feedbackDiv.innerHTML = message;
                no_kkInput.parentNode.appendChild(feedbackDiv);
            }
        }
    }

    validateNama(namaInput) {
        const nama = namaInput.value;
        const maxLength = 255;

        let feedback = namaInput.parentNode.querySelector(".nama-feedback");
        if (feedback) {
            feedback.remove();
        }

        if (nama.length > maxLength - 20) {
            const remaining = maxLength - nama.length;
            const feedbackDiv = document.createElement("div");
            feedbackDiv.className = "nama-feedback small text-info mt-1";
            feedbackDiv.innerHTML =
                remaining > 0
                    ? `📝 Sisa ${remaining} karakter`
                    : `❌ Melebihi batas maksimal ${Math.abs(
                          remaining
                      )} karakter`;
            namaInput.parentNode.appendChild(feedbackDiv);
        } else if (/^[0-9]+$/.test(nama)) {
            let isValid = false;
            const feedbackDiv = document.createElement("div");
            feedbackDiv.className = "nama-feedback small text-danger mt-1";
            feedbackDiv.innerHTML = "❌ Nama tidak boleh angka";
            namaInput.parentNode.appendChild(feedbackDiv);
        }
    }

    validateForm(e) {
        console.log("Form validation started...");

        // Add loading state
        const submitBtn = e.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML =
            '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        submitBtn.disabled = true;

        // Client-side validation
        let hasError = false;
        let errorMessages = [];
        const rows = e.target.querySelectorAll("tr[data-index]");

        rows.forEach((row, index) => {
            const rowNumber = parseInt(row.getAttribute("data-index")) + 1;
            const errors = this.validateRow(row, rowNumber);

            if (errors.length > 0) {
                hasError = true;
                errorMessages.push(...errors);
                row.classList.add("table-danger");
            } else {
                row.classList.remove("table-danger");
            }
        });

        if (hasError) {
            e.preventDefault();

            // Reset button
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;

            // Show errors
            this.showAlert(
                "Error validasi:\n" + errorMessages.join("\n"),
                "error"
            );

            // Scroll to first error
            const firstErrorRow = document.querySelector(".table-danger");
            if (firstErrorRow) {
                firstErrorRow.scrollIntoView({
                    behavior: "smooth",
                    block: "center",
                });
            }

            return false;
        }

        // Log form data for debugging
        console.log("Submitting valid form data...");
        const formData = new FormData(e.target);
        for (let pair of formData.entries()) {
            console.log(pair[0] + ": " + pair[1]);
        }
    }

    validateRow(row, rowNumber) {
        const errors = [];

        const nik =
            row.querySelector('input[name*="[nik]"]')?.value?.trim() || "";
        const nama =
            row.querySelector('input[name*="[nama]"]')?.value?.trim() || "";
        const jk =
            row.querySelector('select[name*="[jenis_kelamin]"]')?.value || "";
        const agama = row.querySelector('select[name*="[agama]"]')?.value || "";
        const alamat =
            row
                .querySelector('textarea[name*="[alamat_tanggallahir]"]')
                ?.value?.trim() || "";

        // Validation rules
        if (!nik) {
            errors.push(`Baris ${rowNumber}: NIK harus diisi`);
        } else if (nik.length !== 16) {
            errors.push(`Baris ${rowNumber}: NIK harus 16 digit`);
        } else if (!/^\d+$/.test(nik)) {
            errors.push(`Baris ${rowNumber}: NIK hanya boleh berisi angka`);
        }

        if (!nama) {
            errors.push(`Baris ${rowNumber}: Nama harus diisi`);
        } else if (nama.length > 255) {
            errors.push(`Baris ${rowNumber}: Nama terlalu panjang`);
        }

        if (!jk) {
            errors.push(`Baris ${rowNumber}: Jenis kelamin harus dipilih`);
        }

        if (!agama) {
            errors.push(`Baris ${rowNumber}: Agama harus dipilih`);
        }

        if (!alamat) {
            errors.push(
                `Baris ${rowNumber}: Alamat dan tanggal lahir harus diisi`
            );
        }

        return errors;
    }

    showAlert(message, type = "info") {
        // Create custom alert
        const alertDiv = document.createElement("div");
        alertDiv.className = `alert alert-${
            type === "error" ? "danger" : type
        } alert-dismissible fade show`;
        alertDiv.innerHTML = `
            <strong>${type === "error" ? "Error!" : "Info:"}</strong>
            <pre style="background: none; border: none; padding: 0; margin: 0.5rem 0 0 0; font-family: inherit; white-space: pre-wrap;">${message}</pre>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        // Insert after title
        const titleDiv = document.querySelector(".border-bottom");
        titleDiv.parentNode.insertBefore(alertDiv, titleDiv.nextSibling);

        // Auto remove after 10 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 10000);
    }

    // Method untuk auto-save draft (optional)
    saveDraft() {
        const formData = new FormData(
            document.getElementById("multi-penduduk-form")
        );
        const draftData = {};

        for (let pair of formData.entries()) {
            draftData[pair[0]] = pair[1];
        }

        // Save to sessionStorage (if available)
        try {
            sessionStorage.setItem("penduduk_draft", JSON.stringify(draftData));
            console.log("Draft saved to sessionStorage");
        } catch (e) {
            console.log("SessionStorage not available");
        }
    }

    // Method untuk restore draft
    restoreDraft() {
        try {
            const draftData = sessionStorage.getItem("penduduk_draft");
            if (draftData) {
                const parsed = JSON.parse(draftData);

                Object.keys(parsed).forEach((fieldName) => {
                    const field = document.querySelector(
                        `[name="${fieldName}"]`
                    );
                    if (field) {
                        field.value = parsed[fieldName];
                    }
                });

                console.log("Draft restored from sessionStorage");
            }
        } catch (e) {
            console.log("Could not restore draft:", e);
        }
    }

    // Method untuk clear draft setelah berhasil submit
    clearDraft() {
        try {
            sessionStorage.removeItem("penduduk_draft");
        } catch (e) {
            console.log("Could not clear draft");
        }
    }
}

// Auto-save draft setiap 30 detik
class AutoSave {
    constructor(formInstance) {
        this.form = formInstance;
        this.interval = null;
        this.startAutoSave();
    }

    startAutoSave() {
        this.interval = setInterval(() => {
            this.form.saveDraft();
        }, 30000); // 30 seconds
    }

    stopAutoSave() {
        if (this.interval) {
            clearInterval(this.interval);
        }
    }
}

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    console.log("Multi Penduduk Form initializing...");

    // Initialize main form handler
    const formHandler = new MultiPendudukForm();

    // Initialize auto-save (optional)
    const autoSave = new AutoSave(formHandler);

    // Cleanup auto-save when page unloads
    window.addEventListener("beforeunload", () => {
        autoSave.stopAutoSave();
    });

    console.log("Multi Penduduk Form initialized successfully");
});

// Utility functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Export for global access if needed
window.MultiPendudukForm = MultiPendudukForm;
