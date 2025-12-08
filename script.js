
let count = 0;
let index = 0;
let currentText = '';
let letter = '';

// Typing effect: only run if `texts` array and target exist
if (typeof texts !== 'undefined' && Array.isArray(texts) && texts.length > 0 && document.getElementById('typing')) {
  (function type(){
    if (count === texts.length) count = 0;

    currentText = texts[count];
    letter = currentText.slice(0, ++index);

    const typingEl = document.getElementById('typing');
    if (typingEl) typingEl.textContent = letter;

    if (letter.length === currentText.length) {
        count++;
        index = 0;
        setTimeout(type, 1500);
    } else {
        setTimeout(type, 100);
    }

  }());
}

// Project
function openModal(id) {
    document.getElementById(id).style.display = "block";
}
function closeModal(id) {
    document.getElementById(id).style.display = "none";
}
// Close modal if clicked outside content
// Modal functionality (safe guards)
const modal = document.getElementById("myModal");
const btn = document.getElementById("openModal");
const span = document.getElementsByClassName("close")[0];

if (btn && modal) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        modal.style.display = "block";
    });
}

if (span && modal) {
    span.addEventListener('click', function() {
        modal.style.display = "none";
    });
}

// Close any modal when clicking outside its content
window.addEventListener('click', function(event) {
    document.querySelectorAll('.modal').forEach(m => {
        if (event.target === m) m.style.display = 'none';
    });
});

// Contact
const contactForm = document.getElementById("contactForm");
if (contactForm) {
    contactForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const nameEl = document.getElementById("name");
        const emailEl = document.getElementById("email");
        const messageEl = document.getElementById("message");

        const name = nameEl ? nameEl.value : '';
        const email = emailEl ? emailEl.value : '';
        const message = messageEl ? messageEl.value : '';

        console.log("Contact Form Data:");
        console.log("Name:", name);
        console.log("Email:", email);
        console.log("Message:", message);

        alert("Thank you " + name + "! Your message has been sent.");
        this.reset();
    });
}

// Mobile nav toggle
document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.getElementById('primary-navigation');
    if (navToggle && navLinks) {
        navToggle.addEventListener('click', function() {
            const isOpen = navLinks.classList.toggle('open');
            navToggle.setAttribute('aria-expanded', isOpen);
        });
        // close nav when clicking a link (helpful on mobile)
        navLinks.addEventListener('click', function(e) {
            if (e.target.tagName === 'A') {
                navLinks.classList.remove('open');
                navToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
});