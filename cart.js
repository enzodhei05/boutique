document.addEventListener('DOMContentLoaded', () => {
    const cartToggle = document.getElementById('cart-toggle');
    const cartBox = document.querySelector('.cart__box');
    const closeCart = document.getElementById('close-cart');

    cartToggle.addEventListener('click', () => {
        cartBox.classList.toggle('open');
    });

    closeCart.addEventListener('click', () => {
        cartBox.classList.remove('open');
    });
});
