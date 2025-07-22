
document.addEventListener('DOMContentLoaded', function() {
    const createBtn = document.getElementById('create-specialization-card');
    const wrapper = document.getElementById('specialization-card-wrapper');

    createBtn.addEventListener('click', function() {
        const newCard = document.createElement('div');
        newCard.classList.add('card-section', 'rounded-3', 'p-4', 'mt-3');

        newCard.innerHTML = `
            <div class="mb-4 d-flex justify-content-end" >
                <button type="button" class="btn btn-danger close-specialization-card">X</button>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold text-dark">Specialization Card Title</label>
                <input type="text" class="form-control rounded-3 specialization-title" name="specialization_cards_title[]" placeholder="e.g. Engine Diagnostics">
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold text-dark">Specialization Card Description</label>
                <textarea class="form-control rounded-3 specialization-desc" name="specialization_cards_description[]" placeholder="e.g. We use advanced tools for engine diagnostics..." rows="4"></textarea>
            </div>
        `;
        wrapper.appendChild(newCard);
        cardRemove();
    });

    function cardRemove() {
        const btnremove = document.querySelectorAll('.close-specialization-card');
        btnremove.forEach((removeBtn) => {
            removeBtn.addEventListener("click", (e) => {
                const removeCard = e.target.closest('.card-section');
                removeCard.remove();
            })
        })
    }

    const faqsCreate = document.getElementById('create-faqs-card');
    const faqsWrapper = document.getElementById('faqs-card-wrapper');

    if (faqsCreate && faqsWrapper) {
        faqsCreate.addEventListener("click", function () {
            const newFaqsCard = document.createElement('div');
            newFaqsCard.classList.add('faqs-section', 'p-4', 'rounded-3', 'bg-white', 'mb-3', 'border', 'position-relative');

            newFaqsCard.innerHTML = `
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3 close-faqs-card" aria-label="Close"></button>

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Question</label>
                    <input type="text" class="form-control rounded-3" name="question[]" placeholder="e.g. Enter Question">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Answer</label>
                    <input type="text" class="form-control rounded-3" name="answer[]" placeholder="e.g. Enter Answer">
                </div>
            `;

            faqsWrapper.appendChild(newFaqsCard);
        });

        // ✅ Event delegation for remove functionality (works even on dynamically added cards)
        faqsWrapper.addEventListener('click', function (e) {
            if (e.target.classList.contains('close-faqs-card')) {
                const removeCard = e.target.closest('.faqs-section');
                if (removeCard) removeCard.remove();
            }
        });
    }

    const tipsBtn = document.getElementById('create-tips');
    const tipsWrapper = document.querySelector('.tips-wrapper');

    if (tipsBtn && tipsWrapper) {
        tipsBtn.addEventListener("click", function () {
            const newtip = document.createElement('div');
            newtip.classList.add('tips-main', 'mt-3');
            newtip.innerHTML = `
                <div class="tips-list-header">
                    <h4 class="text-primary mb-2 d-none">Tips List</h4>
                    <button type="button" class="btn btn-danger remove-tips">X</button>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Tips Card Title</label>
                    <input type="text" class="form-control rounded-3" name="tips_card_title[]" placeholder="e.g. Enter Tips Card Title">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Tips Card Description</label>
                    <input type="text" class="form-control rounded-3" name="tips_card_description[]" placeholder="e.g. Enter Tips Card Description">
                </div>
            `;
            tipsWrapper.appendChild(newtip);
            newtip.querySelector('.remove-tips').addEventListener('click', () => {
                newtip.remove();
            });
        });
    }
});