document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.btn-increase, .btn-decrease').forEach(button => {
        button.addEventListener('click', function() {
            const cartId = this.dataset.id;
            const action = this.classList.contains('btn-increase') ? 'increase' : 'decrease';

            fetch(`/cart/${cartId}/update-quantity`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ action })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.error) {
                    // update quantity display
                    const qtySpan = document.querySelector(`.qty-display[data-id="${cartId}"]`);
                    qtySpan.textContent = data.quantity;

                    // update subtotal display
                    const subtotal = document.querySelector(`#cart-subtotal-${cartId}`);
                    subtotal.textContent = 'Rp ' + data.subtotal;

                    // update grand total
                    const grandTotal = Object.values(document.querySelectorAll('[id^="cart-subtotal-"]'))
                        .reduce((sum, el) => {
                            let num = parseInt(el.textContent.replace(/\D/g,''));
                            return sum + num;
                        }, 0);
                    document.getElementById('grand-total').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
                }
            });
        });
    });
});
