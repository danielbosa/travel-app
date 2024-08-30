document.addEventListener('DOMContentLoaded', function() {
    // Seleziona tutti i checkbox con la classe "stop-checkbox"
    const checkboxes = document.querySelectorAll('.stop-checkbox');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const stopId = this.getAttribute('data-id');
            const isChecked = this.checked;

            // Prepara i dati da inviare al server
            const data = new URLSearchParams();
            data.append('visited', isChecked ? 1 : 0);
            data.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content')); // Token CSRF per sicurezza

            // Usa fetch per inviare una richiesta PUT al server
            fetch(`/stops/${stopId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: data.toString()
            })
            .then(response => response.json())
            .then(data => {
                console.log('Status updated successfully.');
            })
            .catch(error => {
                console.error('Error updating status:', error);
            });
        });
    });
});
