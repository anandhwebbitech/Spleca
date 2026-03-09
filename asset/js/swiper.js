document.addEventListener("DOMContentLoaded", () => {
  if (typeof Swiper === "undefined") return;

  /* ================= HOME BANNER ================= */
  const homeBannerEl = document.querySelector("#wb-home-banner");
  if (homeBannerEl) {
    new Swiper("#wb-home-banner", {
      slidesPerView: 1,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: "#wb-home-banner .wb-home-next",
        prevEl: "#wb-home-banner .wb-home-prev",
      },
      pagination: {
        el: "#wb-home-banner .wb-home-pagination",
        clickable: true,
      },
    });
  }

  /* ================= MAIN PRODUCT SLIDER ================= */
  const mainSwiperEl = document.querySelector(".main-swiper");
  if (mainSwiperEl) {
    new Swiper(".main-swiper", {
      slidesPerView: 1,
      spaceBetween: 15,
      loop: true,
      navigation: {
        nextEl: ".main-swiper .swiper-button-next",
        prevEl: ".main-swiper .swiper-button-prev",
      },
      pagination: {
        el: ".main-swiper .swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        0: { slidesPerView: 1, spaceBetween: 10, centeredSlides: true },
        480: { slidesPerView: 1.3, spaceBetween: 12, centeredSlides: true },
        640: { slidesPerView: 2, spaceBetween: 15, centeredSlides: false },
        768: { slidesPerView: 3, spaceBetween: 20 },
        1024: { slidesPerView: 4, spaceBetween: 25 },
      },
    });
  }

  /* ================= PRODUCT IMAGE HOVER (SLIDER 1) ================= */
  document.querySelectorAll(".product-image-swiper").forEach((el) => {
    const card = el.closest(".product-card");
    if (!card) return;

    const swiper = new Swiper(el, {
      slidesPerView: 1,
      effect: "fade",
      allowTouchMove: false,
      loop: true,
    });

    let hoverInterval;
    card.addEventListener("mouseenter", () => {
      hoverInterval = setInterval(() => swiper.slideNext(), 1000);
    });

    card.addEventListener("mouseleave", () => {
      clearInterval(hoverInterval);
      swiper.slideTo(0);
    });
  });

  /* ================= MAIN SLIDER #2 ================= */
  const mainSwiper2El = document.querySelector("#main-swiper-2");
  if (mainSwiper2El) {
    new Swiper("#main-swiper-2", {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: "#main-swiper-2 .swiper-button-next",
        prevEl: "#main-swiper-2 .swiper-button-prev",
      },
      pagination: {
        el: "#main-swiper-2 .swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        640: { slidesPerView: 2 },
        768: { slidesPerView: 3 },
        1024: { slidesPerView: 4 },
      },
    });
  }

  /* ================= PRODUCT IMAGE HOVER (SLIDER 2) ================= */
  document.querySelectorAll(".product-image-swiper-2").forEach((el) => {
    const card = el.closest(".product-card");
    if (!card) return;

    const swiper = new Swiper(el, {
      slidesPerView: 1,
      effect: "fade",
      allowTouchMove: false,
      loop: true,
    });

    let hoverInterval;
    card.addEventListener("mouseenter", () => {
      hoverInterval = setInterval(() => swiper.slideNext(), 1000);
    });

    card.addEventListener("mouseleave", () => {
      clearInterval(hoverInterval);
      swiper.slideTo(0);
    });
  });

  /* ================= PRODUCT IMAGE ZOOM ================= */
  document.querySelectorAll(".slide img").forEach((img) => {
    const slide = img.parentElement;
    if (!slide) return;

    img.addEventListener("mouseenter", () => {
      img.style.transform = "scale(2)";
    });

    img.addEventListener("mousemove", (e) => {
      const rect = slide.getBoundingClientRect();
      const x = ((e.clientX - rect.left) / rect.width) * 100;
      const y = ((e.clientY - rect.top) / rect.height) * 100;
      img.style.transformOrigin = `${x}% ${y}%`;
    });

    img.addEventListener("mouseleave", () => {
      img.style.transform = "scale(1)";
      img.style.transformOrigin = "center center";
    });
  });

  /* ================= RADIO SLIDER ARROWS ================= */
  const radios = document.querySelectorAll('input[name="slider"]');
  const prevArrow = document.getElementById("prevArrow");
  const nextArrow = document.getElementById("nextArrow");

  if (radios.length && prevArrow && nextArrow) {
    const updateArrows = () => {
      const checked = document.querySelector(
        'input[name="slider"]:checked'
      );
      if (!checked) return;

      const slideNum = parseInt(checked.id.replace("slide", ""));
      const prevNum = slideNum === 1 ? 4 : slideNum - 1;
      const nextNum = slideNum === 4 ? 1 : slideNum + 1;

      prevArrow.setAttribute("for", `slide${prevNum}`);
      nextArrow.setAttribute("for", `slide${nextNum}`);
    };

    radios.forEach((r) => r.addEventListener("change", updateArrows));
    updateArrows();
  }
});
