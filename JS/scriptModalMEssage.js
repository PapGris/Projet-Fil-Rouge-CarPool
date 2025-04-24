document.addEventListener('DOMContentLoaded', function() {
    const openModalBtns = document.querySelectorAll('.openModalBtn');
    const modal = document.getElementById('messageModal');
    const modalRecu= document.getElementById('modalRecu');
    const modalMessage = document.getElementById('modalMessage');
    const closeBtn = document.querySelector('.close-btn');

    openModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const recu = btn.getAttribute('data-recu');
            const message = btn.getAttribute('data-message');

            modalRecu.textContent = 'Message de ' + recu;
            modalMessage.textContent = message;
            modal.classList.remove('hidden');
        });
    });

    closeBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

});