const appointmentMethod = document.getElementById("appointment-method");
const appRatingContainer = document.getElementById("app-rating-container");
const phoneInpersonRatingContainer = document.getElementById("phone-inperson-rating-container");

appointmentMethod.addEventListener("change", () => {
    appRatingContainer.style.display = "none";
    phoneInpersonRatingContainer.style.display = "none";
    appRatingContainer.classList.remove("show");
    phoneInpersonRatingContainer.classList.remove("show");
    if (appointmentMethod.value === "app") {
        appRatingContainer.style.display = "flex";
        setTimeout(() => appRatingContainer.classList.add("show"), 10);
    } else if (appointmentMethod.value === "phone-inperson") {
        phoneInpersonRatingContainer.style.display = "flex";
        setTimeout(() => phoneInpersonRatingContainer.classList.add("show"), 10);
    }
});
document.querySelectorAll('.star-rating').forEach(rating => {
    const stars = rating.querySelectorAll('.star');
    let currentRating = 0;

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = parseInt(star.getAttribute('data-value'));
            currentRating = value;

            stars.forEach((s, index) => {
                if (index < value) s.classList.add('active');
                else s.classList.remove('active');
            });

            rating.setAttribute('data-rating', value);
        });

        star.addEventListener('mouseover', () => {
            const value = parseInt(star.getAttribute('data-value'));

            stars.forEach((s, index) => {
                s.style.color = index < value ? '#fbbf24' : '#e2e8f0';
            });
        });

        star.addEventListener('mouseout', () => {
            stars.forEach((s, index) => {
                s.style.color = index < currentRating ? '#fbbf24' : '#e2e8f0';
            });
        });
    });
});
function showModal() {
    document.getElementById('customModal').classList.add('active');
}

function closeModal() {
    document.getElementById('customModal').classList.remove('active');
}
document.getElementById('feedbackForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const ratings = {};
    document.querySelectorAll('.star-rating').forEach(rating => {
        const id = rating.id;
        const value = rating.getAttribute('data-rating') || 0;
        ratings[id] = value;
    });
    console.log('Ratings collected:', ratings);
    showModal();
    this.reset();
    document.querySelectorAll('.star').forEach(star => {
        star.classList.remove('active');
        star.style.color = '#e2e8f0';
    });
    appRatingContainer.style.display = "none";
    phoneInpersonRatingContainer.style.display = "none";
    appRatingContainer.classList.remove("show");
    phoneInpersonRatingContainer.classList.remove("show");
});