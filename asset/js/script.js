// Smooth scroll to top
// document.querySelector(".scroll-top").addEventListener("click", function (e) {
//   e.preventDefault();
//   window.scrollTo({
//     top: 0,
//     behavior: "smooth",
//   });
// });

// Show/hide scroll to top button based on scroll position
// window.addEventListener("scroll", function () {
//   const scrollTop = document.querySelector(".scroll-top");
//   if (window.pageYOffset > 300) {
//     scrollTop.style.display = "flex";
//   } else {
//     scrollTop.style.display = "none";
//   }
// });

// Initially hide the button
// document.querySelector(".scroll-top").style.display = "none";

// swiper
const swiper = new Swiper(".bannerSwiper", {
  slidesPerView: 1,
  spaceBetween: 0,
  loop: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  effect: "fade",
  fadeEffect: {
    crossFade: true,
  },
});

function playVideo() {
  // Replace 'YOUR_VIDEO_ID' with actual YouTube video ID
  const videoId = "YOUR_VIDEO_ID";
  const youtubeUrl = `https://www.youtube.com/watch?v=${videoId}`;
  window.open(youtubeUrl, "_blank");
}

const toggleBtn = document.querySelector(".menu-toggle");
const navMenu = document.querySelector(".nav-menu");

if (toggleBtn && navMenu) {
  toggleBtn.addEventListener("click", () => {
    navMenu.classList.toggle("active");
  });
}
  
document.querySelectorAll(".mega-submenu > a").forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();
    link.parentElement.classList.toggle("open");
  });
});

// swiper

// form
document.getElementById("inquiryForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const fullname = document.getElementById("fullname").value;
  const emailaddress = document.getElementById("emailaddress").value;
  const phonenumber = document.getElementById("phonenumber").value;
  const messagesubject = document.getElementById("messagesubject").value;
  const usermessage = document.getElementById("usermessage").value;

  alert(
    `Thank you, ${fullname}! Your message has been received. We'll get back to you soon at ${emailaddress}.`
  );

  this.reset();
});

// sorting
// Sort functionality
document.getElementById("sortSelect").addEventListener("change", function () {
  console.log("Sorting by: - script.js:91", this.value);
  // Add your sorting logic here
});

// Pagination click handler
document.querySelectorAll(".page-link").forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    console.log("Page clicked: - script.js:99", this.textContent);
    // Add your pagination logic here
  });
});

// review

document.getElementById("reviewForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const rating = document.querySelector('input[name="rating"]:checked');
  if (!rating) {
    alert("Please select a rating");
    return;
  }

  alert("Thank you for your review!");
  this.reset();
});

// contact
document.getElementById("contactForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const btn = this.querySelector(".btn-submit");
  const originalContent = btn.innerHTML;

  btn.innerHTML =
    '<i class="fas fa-check-circle"></i> Message Sent Successfully!';
  btn.style.background = "#10b981";

  setTimeout(() => {
    btn.innerHTML = originalContent;
    btn.style.background = "";
    this.reset();
  }, 3000);
});

const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = "1";
      entry.target.style.transform = "translateY(0)";
    }
  });
}, observerOptions);

document.querySelectorAll(".reveal").forEach((el) => {
  el.style.opacity = "0";
  el.style.transform = "translateY(30px)";
  observer.observe(el);
});

// Refresh CAPTCHA functionality
document
  .querySelector(".captcha-refresh")
  .addEventListener("click", function () {
    const captchaChars =
      "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789";
    let newCaptcha = "";
    for (let i = 0; i < 7; i++) {
      newCaptcha += captchaChars.charAt(
        Math.floor(Math.random() * captchaChars.length)
      );
    }
    document.querySelector(".captcha-text").textContent = newCaptcha;
  });

// overview
