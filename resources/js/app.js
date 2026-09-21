// Global confirm delete
document.addEventListener('DOMContentLoaded', function() {
    // Auto-attach ke semua form delete
    document.querySelectorAll('form[data-confirm]').forEach(form => {
        form.addEventListener('submit', function(e) {
            const message = this.dataset.confirm || 'Yakin hapus data ini?';
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });
});