document.addEventListener('DOMContentLoaded', function () {
    const openModalBtns = document.querySelectorAll('.openModalBtn');
    const modal = document.getElementById('messageModal');
    const modalRecu = document.getElementById('modalRecu');
    const modalMessage = document.getElementById('modalMessage');
    const closeBtn = document.querySelector('.close-btn');
    const replyButton = document.querySelector('.repondre');
    const replyContainer = document.getElementById('repContainer');
    const destinataireIdInput = document.getElementById('destinataireId');

    openModalBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const recu = btn.getAttribute('data-recu');
            const message = btn.getAttribute('data-message');
            const utilisateurId = btn.getAttribute('data-utilisateur-id');

            modalRecu.textContent = 'Message de ' + recu;
            modalMessage.textContent = message;
            destinataireIdInput.value = utilisateurId;

            replyContainer.classList.add('hidden');
            replyButton.classList.remove('hidden');
            modal.classList.remove('hidden');
        });
    });

    closeBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        replyContainer.classList.add('hidden');
        replyButton.classList.remove('hidden');
    });

    replyButton.addEventListener('click', () => {
        replyContainer.classList.remove('hidden');
        replyButton.classList.add('hidden');
    });
});
