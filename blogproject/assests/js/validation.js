document.getElementById('registerForm').addEventListener('submit', function(event) {
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirm_password').value.trim();

    let errorMessages = [];

    if (username === '' || email === '' || password === '' || confirmPassword === '') {
        errorMessages.push('All fields are required.');
    }

    if (!validateEmail(email)) {
        errorMessages.push('Please enter a valid email address.');
    }

    if (password !== confirmPassword) {
        errorMessages.push('Passwords do not match.');
    }

    if (errorMessages.length > 0) {
        event.preventDefault();
        showError(errorMessages.join('<br>'));
    }
});

function validateEmail(email) {
    const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return re.test(String(email).toLowerCase());
}

function showError(message) {
    const errorModal = document.getElementById('errorModal');
    const errorMessage = document.getElementById('errorMessage');

    errorMessage.innerHTML = message;
    errorModal.style.display = "block";
}

document.addEventListener('DOMContentLoaded', function() {
    const errorModal = document.getElementById('errorModal');
    const closeBtn = errorModal.querySelector('.close');

    closeBtn.onclick = function() {
        errorModal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == errorModal) {
            errorModal.style.display = "none";
        }
    }
});
