// for scroll animation
window.addEventListener("scroll", function () {
    const navbar = document.getElementById("navbar");
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });
  // for navigation 
  const menuButton = document.getElementById("menuButton");
  const mobileMenu = document.getElementById("mobileMenu");
  const hamburgerIcon = document.getElementById("hamburgerIcon");
  const crossIcon = document.getElementById("crossIcon");

  menuButton.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
    mobileMenu.classList.toggle("flex");

    hamburgerIcon.classList.toggle("hidden");
    crossIcon.classList.toggle("hidden");
  });

  // typing animation


  const textElement = document.getElementById("typing");
  const textArray = [
    "MedHub is a medical repo.",
    "Stay informed, stay healthy with MedHub.",
    "Manage your medical history effortlessly.",
    "Access your reports anytime, anywhere.",
    "Connecting patients and doctors through MedHub.",
  ];
  let arrayIndex = 0;
  let charIndex = 0;
  let isDeleting = false;
  let typingSpeed = 200;
  let deletingSpeed = 200;
  let delayBetweenTexts = 2000;
  let endOfTextPause = 2000;

  function typeText() {
    const currentText = textArray[arrayIndex];

    if (isDeleting) {
      textElement.innerHTML = currentText.substring(0, charIndex--);
      setTimeout(typeText, deletingSpeed);
    } else {
      textElement.innerHTML = currentText.substring(0, charIndex++);
      setTimeout(typeText, typingSpeed);
    }

    if (!isDeleting && charIndex === currentText.length) {
      setTimeout(() => (isDeleting = true), endOfTextPause);
    } else if (isDeleting && charIndex === 0) {
      isDeleting = false;
      arrayIndex = (arrayIndex + 1) % textArray.length;
      setTimeout(typeText, delayBetweenTexts);
    }
  }

  document.addEventListener("DOMContentLoaded", function () {
    typeText();
  });



 




  