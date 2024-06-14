document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');

    form.addEventListener('submit', (e) => {
        // Add validation logic here
        const username = form.querySelector('input[name="username"]').value;
        const email = form.querySelector('input[name="email"]').value;
        const password = form.querySelector('input[name="password"]').value;

        if (username.length < 3) {
            alert('Username must be at least 3 characters long.');
            e.preventDefault();
        }
        if (password.length < 6) {
            alert('Password must be at least 6 characters long.');
            e.preventDefault();
        }
        // Add more validation as needed
    });
});
