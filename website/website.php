<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Amiel Jake Personal Website
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <script src="https://unpkg.com/three@0.152.2/build/three.min.js">
  </script>
  <script src="https://unpkg.com/gsap@3.12.2/dist/gsap.min.js">
  </script>
  <script src="https://unpkg.com/gsap@3.12.2/dist/ScrollTrigger.min.js">
  </script>
  <script src="https://unpkg.com/three@0.152.2/examples/js/controls/OrbitControls.js">
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&amp;display=swap" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   /* Reset and base */
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #ECE6CD;
      color: #3A3F58;
      overflow-x: hidden;
      scroll-behavior: smooth;
    }
    a {
      text-decoration: none;
    }
    /* Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    ::-webkit-scrollbar-track {
      background: #ECE6CD;
    }
    ::-webkit-scrollbar-thumb {
      background-color: #EE6A59;
      border-radius: 10px;
      border: 2px solid #ECE6CD;
    }
    /* Theme toggle */
    .dark {
      --bg-color: #3A3F58;
      --text-color: #ECE6CD;
      --accent-color: #F9AC67;
      --accent-color-2: #EE6A59;
      --card-bg: #2c3145;
      --input-bg: #454a6b;
      --input-text: #ECE6CD;
    }
    .light {
      --bg-color: #ECE6CD;
      --text-color: #3A3F58;
      --accent-color: #F9AC67;
      --accent-color-2: #EE6A59;
      --card-bg: #fff;
      --input-bg: #f9f6f0;
      --input-text: #3A3F58;
    }
    body {
      background-color: var(--bg-color);
      color: var(--text-color);
      transition: background-color 0.6s ease, color 0.6s ease;
    }
    /* Container max width */
    .container {
      max-width: 1200px;
      margin-left: auto;
      margin-right: auto;
      padding-left: 1.5rem;
      padding-right: 1.5rem;
    }
    /* Scroll down arrow animation */
    .scroll-down {
      position: absolute;
      bottom: 2rem;
      left: 50%;
      transform: translateX(-50%);
      font-size: 2rem;
      color: var(--accent-color-2);
      animation: bounce 2.5s infinite;
      cursor: pointer;
      z-index: 10;
    }
    @keyframes bounce {
      0%, 100% {
        transform: translateX(-50%) translateY(0);
      }
      50% {
        transform: translateX(-50%) translateY(15px);
      }
    }
    /* Entrance animations */
    .fade-in-up {
      opacity: 0;
      transform: translateY(30px);
      animation-fill-mode: forwards;
      animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
      animation-duration: 1s;
    }
    /* 3D card style for skills */
    .skill-card {
      background: var(--card-bg);
      border-radius: 1rem;
      box-shadow: 0 10px 20px rgb(0 0 0 / 0.1);
      cursor: pointer;
      perspective: 1000px;
      transition: box-shadow 0.3s ease;
      will-change: transform;
      position: relative;
      overflow: visible;
    }
    .skill-card-inner {
      border-radius: 1rem;
      transition: transform 0.4s ease;
      transform-style: preserve-3d;
      padding: 2rem 1.5rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
      user-select: none;
    }
    .skill-card:hover {
      box-shadow: 0 20px 40px rgb(238 106 89 / 0.4);
    }
    .skill-card:hover .skill-card-inner {
      transform: rotateY(15deg) rotateX(10deg) scale(1.05);
    }
    /* Floating music notes */
    .music-note {
      position: absolute;
      font-size: 1.5rem;
      color: var(--accent-color-2);
      opacity: 0.7;
      animation: floatUp 6s linear infinite;
      user-select: none;
      pointer-events: none;
    }
    @keyframes floatUp {
      0% {
        transform: translateY(0) translateX(0) rotate(0deg);
        opacity: 0.7;
      }
      100% {
        transform: translateY(-150px) translateX(20px) rotate(360deg);
        opacity: 0;
      }
    }
    /* Cursor effect */
    .cursor {
      position: fixed;
      top: 0;
      left: 0;
      width: 24px;
      height: 24px;
      border: 2px solid var(--accent-color-2);
      border-radius: 50%;
      pointer-events: none;
      transform: translate(-50%, -50%);
      transition: width 0.3s ease, height 0.3s ease, background-color 0.3s ease, border-color 0.3s ease;
      z-index: 9999;
      mix-blend-mode: difference;
      background-color: transparent;
      will-change: transform, width, height, background-color, border-color;
    }
    .cursor.hovered {
      width: 48px;
      height: 48px;
      background-color: var(--accent-color-2);
      border-color: var(--accent-color-2);
      mix-blend-mode: normal;
    }
    /* Lightbox styles */
    .lightbox {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.85);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 10000;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
    }
    .lightbox.active {
      opacity: 1;
      pointer-events: auto;
    }
    .lightbox img {
      max-width: 90vw;
      max-height: 90vh;
      border-radius: 1rem;
      box-shadow: 0 0 40px rgba(255, 255, 255, 0.3);
    }
    .lightbox-close {
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
      font-size: 2rem;
      color: white;
      cursor: pointer;
      user-select: none;
      z-index: 10001;
    }
    /* Typewriter effect */
    .typewriter {
      overflow: hidden;
      border-right: 0.15em solid var(--accent-color-2);
      white-space: nowrap;
      animation: typing 4s steps(40, end) infinite, blink-caret 0.75s step-end infinite;
      font-weight: 600;
      font-size: 1.5rem;
      color: var(--accent-color-2);
      max-width: 100%;
    }
    @keyframes typing {
      0%, 50% {
        width: 0;
      }
      100% {
        width: 100%;
      }
    }
    @keyframes blink-caret {
      0%, 100% {
        border-color: transparent;
      }
      50% {
        border-color: var(--accent-color-2);
      }
    }
    /* Scroll reveal */
    .reveal {
      opacity: 0;
      transform: translateY(40px);
      transition: opacity 0.8s ease, transform 0.8s ease;
    }
    .reveal.active {
      opacity: 1;
      transform: translateY(0);
    }
    /* Animated timeline */
    .timeline {
      position: relative;
      margin: 2rem 0;
      padding-left: 2rem;
      border-left: 4px solid var(--accent-color-2);
    }
    .timeline-item {
      position: relative;
      margin-bottom: 2rem;
      padding-left: 1.5rem;
    }
    .timeline-item:last-child {
      margin-bottom: 0;
    }
    .timeline-item::before {
      content: '';
      position: absolute;
      left: -10px;
      top: 0.5rem;
      width: 16px;
      height: 16px;
      background: var(--accent-color-2);
      border-radius: 50%;
      border: 3px solid var(--bg-color);
      box-sizing: content-box;
    }
    .timeline-year {
      font-weight: 700;
      font-size: 1.25rem;
      color: var(--accent-color-2);
      margin-bottom: 0.25rem;
    }
    /* Testimonials slider */
    .testimonials-container {
      overflow: hidden;
      position: relative;
    }
    .testimonials-slider {
      display: flex;
      gap: 2rem;
      transition: transform 0.5s ease;
      will-change: transform;
    }
    .testimonial-card {
      background: var(--card-bg);
      border-radius: 1rem;
      padding: 2rem;
      min-width: 280px;
      box-shadow: 0 10px 20px rgb(0 0 0 / 0.1);
      flex-shrink: 0;
      cursor: grab;
      user-select: none;
      perspective: 1000px;
      transition: box-shadow 0.3s ease;
    }
    .testimonial-card:hover {
      box-shadow: 0 20px 40px rgb(238 106 89 / 0.4);
      transform: translateZ(20px);
    }
    .testimonial-text {
      font-style: italic;
      margin-bottom: 1rem;
      color: var(--text-color);
    }
    .testimonial-author {
      font-weight: 700;
      color: var(--accent-color-2);
    }
    /* Contact form */
    .input-group {
      position: relative;
      margin-bottom: 1.5rem;
    }
    .input-group input,
    .input-group textarea {
      width: 100%;
      padding: 1rem 1rem 1rem 1rem;
      border-radius: 0.75rem;
      border: 2px solid var(--accent-color-2);
      background: var(--input-bg);
      color: var(--input-text);
      font-size: 1rem;
      outline: none;
      transition: border-color 0.3s ease;
      resize: vertical;
    }
    .input-group input:focus,
    .input-group textarea:focus {
      border-color: var(--accent-color);
    }
    .input-group label {
      position: absolute;
      top: 50%;
      left: 1rem;
      transform: translateY(-50%);
      color: var(--accent-color-2);
      font-weight: 600;
      pointer-events: none;
      transition: all 0.3s ease;
      background: var(--input-bg);
      padding: 0 0.25rem;
      border-radius: 0.25rem;
    }
    .input-group input:focus + label,
    .input-group input:not(:placeholder-shown) + label,
    .input-group textarea:focus + label,
    .input-group textarea:not(:placeholder-shown) + label {
      top: -0.5rem;
      font-size: 0.75rem;
      color: var(--accent-color);
    }
    /* Social icons */
    .social-icons {
      display: flex;
      gap: 1.5rem;
      justify-content: center;
      margin-top: 1rem;
    }
    .social-icons a {
      font-size: 1.75rem;
      color: var(--accent-color-2);
      transition: transform 0.3s ease, color 0.3s ease;
    }
    .social-icons a:hover {
      color: var(--accent-color);
      transform: scale(1.2);
    }
    /* Responsive */
    @media (max-width: 768px) {
      .skill-card-inner {
        padding: 1.5rem 1rem;
      }
      .testimonial-card {
        min-width: 240px;
      }
    }
    /* Add smooth scroll offset for fixed header */
section {
  scroll-margin-top: 100px;
}
/* Smooth fade for navbar and theme toggle */
#navbar,
#theme-toggle {
  transition: opacity 0.4s ease-in-out, background-color 0.6s ease;
}

#navbar.transparent,
#theme-toggle.transparent {
  opacity: 0;
  background-color: transparent !important;
}

#navbar.visible,
#theme-toggle.visible {
  opacity: 1;
}
 /* Smooth scrolling for the whole page */
  html {
    scroll-behavior: smooth;
  }

  /* Optional: Add a little offset so content doesn't stick to top */
  section[id] {
    scroll-margin-top: 80px; /* Adjust based on your header height */
  }
  </style>
 </head>
 <body class="light">
  <!-- Cursor -->
  <div class="cursor" id="cursor">
  </div>
  <!-- Theme toggle button -->
  <button 
  aria-label="Toggle Dark/Light Mode" 
  class="fixed top-20 right-6 z-50 bg-[#EE6A59] text-[#ECE6CD] p-3 rounded-full shadow-lg hover:bg-[#F9AC67] transition-colors" 
  id="theme-toggle" 
  title="Toggle Dark/Light Mode">
  <i class="fas fa-moon"></i>
</button>
  <!-- Navbar -->
   <header id="navbar" class="fixed top-0 left-0 w-full bg-transparent z-40">
   <nav class="container flex justify-between items-center py-6">
    <a class="text-3xl font-extrabold tracking-wide text-[#EE6A59] select-none" href="#home">
     Amiel Jake
    </a>
    <ul class="hidden md:flex gap-10 font-semibold text-lg text-[#3A3F58] dark:text-[#ECE6CD]">
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#about">
       About Me
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#skills">
       Skills
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#music">
       Music
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#portfolio">
       Portfolio
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#gallery">
       Gallery
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#quote">
       Quote
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#resume">
       Resume
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#testimonials">
       Testimonials
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#contact">
       Contact
      </a>
     </li>
    </ul>
    <button aria-label="Open menu" class="md:hidden text-[#EE6A59] text-2xl focus:outline-none" id="mobile-menu-btn">
     <i class="fas fa-bars">
     </i>
    </button>
   </nav>
   <div class="hidden md:hidden bg-[#3A3F58] dark:bg-[#2c3145] text-[#ECE6CD]" id="mobile-menu">
    <ul class="flex flex-col gap-6 p-6 font-semibold text-lg">
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#about">
       About Me
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#skills">
       Skills
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#music">
       Music
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#portfolio">
       Portfolio
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#gallery">
       Gallery
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#quote">
       Quote
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#resume">
       Resume
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#testimonials">
       Testimonials
      </a>
     </li>
     <li>
      <a class="hover:text-[#F9AC67] transition-colors" href="#contact">
       Contact
      </a>
     </li>
    </ul>
   </div>
  </header>
  <!-- Hero Section -->
  <section class="relative w-full h-screen flex flex-col justify-center items-center overflow-hidden select-none" id="home">
   <canvas class="absolute inset-0 w-full h-full z-0" id="hero-canvas">
   </canvas>
   <div class="relative z-10 text-center max-w-4xl px-6">
    <h1 class="text-5xl md:text-7xl font-extrabold text-[#EE6A59] mb-4 opacity-0 translate-y-10" id="hero-name">
     Hwan-yeong
    </h1>
    <p class="text-xl md:text-2xl font-semibold text-[#F9AC67] opacity-0 translate-y-10" id="hero-title">
     IT Student | Developer | Designer | Music Lover | 
     Building Interactive Experiences with Code, Creativity, 
     and a Touch of Sound
    </p>
   </div>
   <div aria-label="Scroll Down" class="scroll-down" id="scroll-down" role="button" tabindex="0">
    <i class="fas fa-chevron-down">
    </i>
   </div>
  </section>
  <!-- About Me Section -->
  <section class="container py-20" id="about">
   <h2 class="text-4xl font-bold text-center mb-12 text-[#EE6A59]">
    About Me
   </h2>
   <div class="flex flex-col md:flex-row items-center gap-12">
    <div class="w-72 h-72 md:w-96 md:h-96 relative mx-auto">
     <canvas class="w-full h-full rounded-xl shadow-lg" id="about-blob">
     </canvas>
     <img class="absolute top-1/2 left-1/2 w-64 h-64 md:w-80 md:h-80 rounded-full object-cover shadow-2xl border-8 border-[#F9AC67] -translate-x-1/2 -translate-y-1/2" loading="lazy" src="../images/Jake.png"/>
    </div>
    <div class="max-w-xl space-y-6 text-[#3A3F58] dark:text-[#ECE6CD]">
     <p class="text-lg leading-relaxed">
      Hello! I'm Amiel Jake, a passionate creative developer who loves blending technology with art. I enjoy crafting immersive digital experiences, exploring music, and building dreams through code and design. My journey has been filled with learning, growth, and a relentless pursuit of creativity.
     </p>
     <div aria-label="Experience timeline" class="timeline">
      <div class="timeline-item reveal">
       <div class="timeline-year">
        2024
       </div>
       <div>
        <strong>
         Frontend Developer
        </strong>
        - Creative Agency
       </div>
       <p class="text-sm opacity-80">
        Building interactive web apps with React and Three.js.
       </p>
      </div>
      <div class="timeline-item reveal" style="transition-delay: 0.1s">
       <div class="timeline-year">
        2022
       </div>
       <div>
        <strong>
         Internship
        </strong>
        - Tech Startup
       </div>
       <p class="text-sm opacity-80">
        Worked on UI/UX design and animation projects.
       </p>
      </div>
      <div class="timeline-item reveal" style="transition-delay: 0.2s">
       <div class="timeline-year">
        2020
       </div>
       <div>
        <strong>
         Graduated
        </strong>
        - Computer Science
       </div>
       <p class="text-sm opacity-80">
        Completed degree with focus on graphics and web development.
       </p>
      </div>
     </div>
    </div>
   </div>
  </section>
  <!-- Skills Section -->
  <section class="bg-[#F9AC67] dark:bg-[#EE6A59] py-20" id="skills">
   <div class="container">
    <h2 class="text-4xl font-bold text-center mb-12 text-[#3A3F58] dark:text-[#ECE6CD]">
     Skills
    </h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8">
     <div aria-label="Skill HTML" class="skill-card" tabindex="0">
      <div class="skill-card-inner">
       <i class="fab fa-html5 text-[#EE6A59] text-6xl">
       </i>
       <span class="text-xl font-semibold text-[#3A3F58] dark:text-[#ECE6CD]">
        HTML
       </span>
      </div>
     </div>
     <div aria-label="Skill CSS" class="skill-card" tabindex="0">
      <div class="skill-card-inner">
       <i class="fab fa-css3-alt text-[#3A3F58] dark:text-[#ECE6CD] text-6xl">
       </i>
       <span class="text-xl font-semibold text-[#3A3F58] dark:text-[#ECE6CD]">
        CSS
       </span>
      </div>
     </div>
     <div aria-label="Skill JavaScript" class="skill-card" tabindex="0">
      <div class="skill-card-inner">
       <i class="fab fa-js-square text-[#F9AC67] text-6xl">
       </i>
       <span class="text-xl font-semibold text-[#3A3F58] dark:text-[#ECE6CD]">
        JavaScript
       </span>
      </div>
     </div>
     <div aria-label="Skill React" class="skill-card" tabindex="0">
      <div class="skill-card-inner">
       <i class="fab fa-react text-[#3A3F58] dark:text-[#ECE6CD] text-6xl">
       </i>
       <span class="text-xl font-semibold text-[#3A3F58] dark:text-[#ECE6CD]">
        React
       </span>
      </div>
     </div>
     <div aria-label="Skill Blender" class="skill-card" tabindex="0">
      <div class="skill-card-inner">
       <img alt="Blender 3D software icon" class="w-16 h-16" height="64" src="https://storage.googleapis.com/a1aa/image/bd4a50dd-26b9-49a5-946e-3b735c38e709.jpg" width="64"/>
       <span class="text-xl font-semibold text-[#3A3F58] dark:text-[#ECE6CD]">
        Blender
       </span>
      </div>
     </div>
     <div aria-label="Skill Git" class="skill-card" tabindex="0">
      <div class="skill-card-inner">
       <i class="fab fa-git-alt text-[#EE6A59] text-6xl">
       </i>
       <span class="text-xl font-semibold text-[#3A3F58] dark:text-[#ECE6CD]">
        Git
       </span>
      </div>
     </div>
     <div aria-label="Skill Node.js" class="skill-card" tabindex="0">
      <div class="skill-card-inner">
       <i class="fab fa-node-js text-[#3A3F58] dark:text-[#ECE6CD] text-6xl">
       </i>
       <span class="text-xl font-semibold text-[#3A3F58] dark:text-[#ECE6CD]">
        Node.js
       </span>
      </div>
     </div>
     <div aria-label="Skill WebGL" class="skill-card" tabindex="0">
      <div class="skill-card-inner">
       <img alt="WebGL icon" class="w-16 h-16" height="64" src="https://storage.googleapis.com/a1aa/image/c04ce5e9-6147-4a75-02c0-035e0dc80764.jpg" width="64"/>
       <span class="text-xl font-semibold text-[#3A3F58] dark:text-[#ECE6CD]">
        WebGL
       </span>
      </div>
     </div>
    </div>
   </div>
  </section>
  <!-- Favorite Music Section -->
  <section class="container py-20" id="music">
   <h2 class="text-4xl font-bold text-center mb-12 text-[#EE6A59]">
    My Favorite Music
   </h2>
   <div class="relative flex justify-center mb-12">
    <canvas aria-hidden="true" height="200" id="vinyl-canvas" style="border-radius: 50%; box-shadow: 0 0 30px #00bd13ff;" width="200">
    </canvas>
   </div>
   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
    <!-- Luke Chiang Songs -->
    <div class="bg-[#ECE6CD] dark:bg-[#2c3145] rounded-xl shadow-lg p-6 flex flex-col gap-4">
      <h3 class="text-2xl font-semibold text-[#3A3F58] dark:text-[#ECE6CD] border-b-4 border-[#EE6A59] pb-2 mb-4">
        Luke Chiang
      </h3>
     <div class="flex flex-col gap-3 overflow-y-auto max-h-72 pr-2" id="luke-chiang-songs">
      <songcard artist="Luke Chiang" spotify="https://open.spotify.com/track/7F6PtLP6fJPVtA1FWVkl8K?si=dab6986d0151499e" title="Shouldn't Be">
      </songcard>
      <songcard artist="Luke Chiang" spotify="https://open.spotify.com/track/3BajoSb3TjPbcOC873OjbD?si=ce64025ad4864519" title="May I Ask">
      </songcard>
      <songcard artist="Luke Chiang" spotify="https://open.spotify.com/track/2p9Ac0KQAUfOIXXWAxlzmM?si=6949ca9293c74094" title="Paragraph">
      </songcard>
      <songcard artist="Luke Chiang" spotify="https://open.spotify.com/track/72Vu0dhVlpjtdPdli224Nf?si=234b36a68fe34094" title="Never Tell">
      </songcard>
      <songcard artist="Luke Chiang" spotify="https://open.spotify.com/track/0wEqNUKF9MH4pk5va6HNCt?si=3eea258f3ff34bd8" title="Bittersweet">
      </songcard>
     </div>
    </div>
    <!-- Jesse Barrera Songs (dating Sarah Kang) -->
    <div class="bg-[#ECE6CD] dark:bg-[#2c3145] rounded-xl shadow-lg p-6 flex flex-col gap-4">
      <h3 class="text-2xl font-semibold text-[#3A3F58] dark:text-[#ECE6CD] border-b-4 border-[#EE6A59] pb-2 mb-4">
        Jesse Barrera
      </h3>
      <div class="flex flex-col gap-3 overflow-y-auto max-h-72 pr-2" id="jesse-barrera-songs">
     
      <songcard artist="Jesse Barrera" spotify="https://open.spotify.com/track/8e1e1e1e1e1e1e1e1e1e1e1" title="Pretend">
      </songcard>
      <songcard artist="Jesse Barrera" spotify="https://open.spotify.com/track/9f2f2f2f2f2f2f2f2f2f2f2" title="Strawberry Soju">
      </songcard>
      <songcard artist="Jesse Barrera" spotify="https://open.spotify.com/track/0a3a3a3a3a3a3a3a3a3a3a3" title="Chase">
      </songcard>
      <songcard artist="Jesse Barrera" spotify="https://open.spotify.com/track/1b4b4b4b4b4b4b4b4b4b4b4" title="Mars">
      </songcard>
      <songcard artist="Jesse Barrera" spotify="https://open.spotify.com/track/2c5c5c5c5c5c5c5c5c5c5c5" title="Tapioca">
      </songcard>
     </div>
    </div>
    <!-- RINI Songs (dating Jesse Barrera) -->
    <div class="bg-[#ECE6CD] dark:bg-[#2c3145] rounded-xl shadow-lg p-6 flex flex-col gap-4">
      <h3 class="text-2xl font-semibold text-[#3A3F58] dark:text-[#ECE6CD] border-b-4 border-[#EE6A59] pb-2 mb-4">
        RINI
      </h3>
       <div class="flex flex-col gap-3 overflow-y-auto max-h-72 pr-2" id="rini-songs">
      <songcard artist="RINI" spotify="https://open.spotify.com/track/8e1e1e1e1e1e1e1e1e1e1e1" title="Gone With The Wind">
      </songcard>
      <songcard artist="RINI" spotify="https://open.spotify.com/track/9f2f2f2f2f2f2f2f2f2f2f2" title="Strawberry Blossom">
      </songcard>
      <songcard artist="RINI" spotify="https://open.spotify.com/track/0a3a3a3a3a3a3a3a3a3a3a3" title="Out Of The Blue">
      </songcard>
      <songcard artist="RINI" spotify="https://open.spotify.com/track/1b4b4b4b4b4b4b4b4b4b4b4" title="Scars">
      </songcard>
      <songcard artist="RINI" spotify="https://open.spotify.com/track/2c5c5c5c5c5c5c5c5c5c5c5" title="For Days">
      </songcard>
    </div>
   </div>
      </div>
   
  </section>
  <!-- Portfolio Section -->
  <section class="bg-[#3A3F58] dark:bg-[#2c3145] py-20" id="portfolio">
   <div class="container">
    <h2 class="text-4xl font-bold text-center mb-12 text-[#F9AC67]">
     Portfolio Projects
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
     <projectcard description="A modern web app with 3D animations." img="https://placehold.co/400x250/png?text=Project+One" link="#" title="Project One">
     </projectcard>
     <projectcard description="Creative portfolio with interactive UI." img="https://placehold.co/400x250/png?text=Project+Two" link="#" title="Project Two">
     </projectcard>
     <projectcard description="Music visualization and player." img="https://placehold.co/400x250/png?text=Project+Three" link="#" title="Project Three">
     </projectcard>
     <projectcard description="3D modeling and animation showcase." img="https://placehold.co/400x250/png?text=Project+Four" link="#" title="Project Four">
     </projectcard>
     <projectcard description="Interactive resume with timeline." img="https://placehold.co/400x250/png?text=Project+Five" link="#" title="Project Five">
     </projectcard>
     <projectcard description="Personal blog with smooth animations." img="https://placehold.co/400x250/png?text=Project+Six" link="#" title="Project Six">
     </projectcard>
    </div>
   </div>
  </section>
  <!-- Gallery Section -->
  <section class="container py-20" id="gallery">
   <h2 class="text-4xl font-bold text-center mb-12 text-[#EE6A59]">
    Gallery &amp; Life Moments
   </h2>
   <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
    <galleryimage alt="Travel photo of Amiel at a mountain peak during sunset" src="../images/1.jpg">
    </galleryimage>
    <galleryimage alt="Amiel playing guitar in a cozy room with warm lighting" src="../images/2.jpg">
    </galleryimage>
    <galleryimage alt="Amiel walking on a beach with waves and blue sky" src="../images/3.jpg">
    </galleryimage>
    <galleryimage alt="Amiel painting on a canvas in a bright art studio" src="../images/4.jpg">
    </galleryimage>
    <galleryimage alt="Amiel exploring a vibrant city street at night with neon lights" src="../images/5.jpg">
    </galleryimage>
    <galleryimage alt="Amiel laughing with friends at a cafe outdoor" src="../images/6.jpg">
    </galleryimage>
    <galleryimage alt="Amiel working on a laptop with headphones on in a cozy workspace" src="../images/7.jpg">
    </galleryimage>
    <galleryimage alt="Amiel hiking through a lush green forest trail" src="../images/8.jpg">
    </galleryimage>
   </div>
  </section>
  <!-- Quote of the Day Section -->
  <section class="bg-[#F9AC67] dark:bg-[#EE6A59] py-20" id="quote">
   <div class="container max-w-3xl text-center">
    <h2 class="text-4xl font-bold mb-8 text-[#3A3F58] dark:text-[#ECE6CD]">
     Quote of the Day
    </h2>
    <p class="text-xl md:text-2xl font-semibold text-white opacity-0 translate-y-10" id="hero-title">
     "In a world that can be harsh and uncertain, 'With a Smile' reminds us that strength isn’t in never falling—but in rising with grace, facing struggles with hope, and choosing to smile not because everything is perfect… but because we believe it can still be okay." 
    </p>
    <button aria-label="Toggle inspirational background music" class="mt-8 bg-[#3A3F58] dark:bg-[#ECE6CD] text-[#F9AC67] dark:text-[#3A3F58] px-6 py-3 rounded-lg shadow-md hover:bg-[#EE6A59] dark:hover:bg-[#F9AC67] transition-colors" id="music-toggle">
     <i class="fas fa-music mr-2">
     </i>
     Toggle Music
    </button>
    <audio id="background-music" loop="" preload="auto" src="https://cdn.pixabay.com/download/audio/2022/03/23/audio_0a7a3a3a3a.mp3?filename=relaxing-ambient-11047.mp3">
    </audio>
   </div>
  </section>
  <!-- Resume / Timeline Section -->
<section class="container py-20" id="resume">
  <h2 class="text-4xl font-bold text-center mb-12 text-[#EE6A59]">Resume & Timeline</h2>
  <div aria-label="Interactive 3D timeline" class="relative w-full max-w-5xl mx-auto" id="resume-timeline"></div>

  <!-- View Certificate Button -->
  <div class="text-center mt-12">
    <button 
      aria-label="View certificate" 
      class="bg-[#3A3F58] dark:bg-[#ECE6CD] text-[#F9AC67] dark:text-[#3A3F58] px-6 py-3 rounded-lg shadow-md hover:bg-[#EE6A59] dark:hover:bg-[#F9AC67] transition-colors"
      id="view-certificate-btn">
      View Certificate
    </button>
  </div>
</section>

<!-- Hidden Certificate Image for Lightbox -->
<img 
  src="../images/resume.jpg" 
  alt="Sample Certificate of Achievement" 
  id="certificate-img" 
  class="hidden">

  <script>
function setupCertificateButton() {
  const btn = document.getElementById('view-certificate-btn');
  const img = document.getElementById('certificate-img');
  const lightbox = document.getElementById('lightbox');
  const lightboxImg = document.getElementById('lightbox-img');

  if (!btn || !img || !lightbox || !lightboxImg) return;

  btn.addEventListener('click', () => {
    lightboxImg.src = img.src;
    lightboxImg.alt = img.alt;
    lightbox.classList.add('active');
    lightbox.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  });
}

document.addEventListener('DOMContentLoaded', setupCertificateButton);
</script>

  <!-- Testimonials Section -->
  <section class="bg-[#3A3F58] dark:bg-[#2c3145] py-20" id="testimonials">
   <div class="container max-w-5xl">
    <h2 class="text-4xl font-bold text-center mb-12 text-[#F9AC67]">
     Testimonials
    </h2>
    <div aria-label="Testimonials slider" class="testimonials-container" tabindex="0">
     <div class="testimonials-slider" id="testimonials-slider">
      <div aria-label="Testimonial from John Doe" class="testimonial-card" tabindex="0">
       <p class="testimonial-text">
        "Amiel's creativity and technical skills are outstanding. A true professional who delivers beyond expectations."
       </p>
       <p class="testimonial-author">
        - John Doe
       </p>
      </div>
      <div aria-label="Testimonial from Jane Smith" class="testimonial-card" tabindex="0">
       <p class="testimonial-text">
        "Working with Amiel was a pleasure. His passion for music and design shines through every project."
       </p>
       <p class="testimonial-author">
        - Jane Smith
       </p>
      </div>
      <div aria-label="Testimonial from Alex Johnson" class="testimonial-card" tabindex="0">
       <p class="testimonial-text">
        "Highly recommend Amiel for any creative development work. His 3D animations are mesmerizing."
       </p>
       <p class="testimonial-author">
        - Alex Johnson
       </p>
      </div>
     </div>
    </div>
   </div>
  </section>
  <!-- Contact Section -->
  <section class="container py-20" id="contact">
   <h2 class="text-4xl font-bold text-center mb-12 text-[#EE6A59]">
    Let's Connect
   </h2>
   <form class="max-w-3xl mx-auto space-y-8" id="contact-form" novalidate="">
    <div class="input-group">
     <input aria-required="true" id="name" name="name" placeholder=" " required="" type="text"/>
     <label for="name">
      Your Name
     </label>
    </div>
    <div class="input-group">
     <input aria-required="true" id="email" name="email" placeholder=" " required="" type="email"/>
     <label for="email">
      Your Email
     </label>
    </div>
    <div class="input-group">
     <textarea aria-required="true" id="message" name="message" placeholder=" " required="" rows="5"></textarea>
     <label for="message">
      Your Message
     </label>
    </div>
    <button class="bg-[#EE6A59] text-[#ECE6CD] font-semibold py-3 rounded-lg shadow-md hover:bg-[#F9AC67] transition-colors w-full md:w-auto px-10" type="submit">
     Send Message
    </button>
   </form>
   <div aria-label="Social media links" class="social-icons mt-12" role="list">
    <a aria-label="GitHub" href="https://github.com/amieljake929" rel="noopener" role="listitem" target="_blank">
     <i class="fab fa-github">
     </i>
    </a>
    <a aria-label="Facebook" href="https://www.facebook.com/AmielJakeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee/" rel="noopener" role="listitem" target="_blank">
     <i class="fab fa-facebook">
     </i>
    </a>
    <a aria-label="Instagram" href="https://www.instagram.com/lukessssz/" rel="noopener" role="listitem" target="_blank">
     <i class="fab fa-instagram">
     </i>
    </a>
    <a aria-label="Twitter" href="https://x.com/amieljake11" rel="noopener" role="listitem" target="_blank">
     <i class="fab fa-twitter">
     </i>
    </a>
   </div>
  </section>
  <!-- Lightbox -->
  <div aria-hidden="true" aria-label="Image preview" aria-modal="true" class="lightbox" id="lightbox" role="dialog">
   <span aria-label="Close image preview" class="lightbox-close" id="lightbox-close" role="button" tabindex="0">
    ×
   </span>
   <img alt="" id="lightbox-img" src=""/>
  </div>
  <script type="text/javascript">
   // Helper function to create song cards
    function SongCard({ title, artist, spotify }) {
      const container = document.createElement('div');
      container.className = 'flex items-center justify-between bg-[#F9AC67]/30 rounded-md px-4 py-2 hover:bg-[#F9AC67]/50 transition-colors cursor-pointer text-[#3A3F58] dark:text-[#ECE6CD]';
      container.tabIndex = 0;
      container.setAttribute('aria-label', `Song ${title} by ${artist}`);

      const span = document.createElement('span');
      span.textContent = title;

      const link = document.createElement('a');
      link.href = spotify;
      link.target = '_blank';
      link.rel = 'noopener';
      link.className = 'text-[#EE6A59] hover:text-[#3A3F58] dark:hover:text-[#F9AC67]';
      link.setAttribute('aria-label', `Listen to ${title} on Spotify`);
      link.innerHTML = '<i class="fab fa-spotify fa-lg"></i>';

      container.appendChild(span);
      container.appendChild(link);
      return container;
    }

    // Helper function to create project cards
    function ProjectCard({ title, description, img, link }) {
      const card = document.createElement('a');
      card.href = link;
      card.target = '_blank';
      card.rel = 'noopener';
      card.className = 'group block rounded-xl overflow-hidden shadow-lg bg-[#ECE6CD] dark:bg-[#2c3145] transform transition-transform hover:scale-105 focus:scale-105 focus:outline-none';
      card.setAttribute('aria-label', `Project: ${title}`);

      const imgEl = document.createElement('img');
      imgEl.src = img;
      imgEl.alt = `${title} project thumbnail`;
      imgEl.className = 'w-full h-48 object-cover transition-transform group-hover:scale-110 group-focus:scale-110';

      const content = document.createElement('div');
      content.className = 'p-6';

      const h3 = document.createElement('h3');
      h3.className = 'text-xl font-semibold mb-2 text-[#3A3F58] dark:text-[#ECE6CD]';
      h3.textContent = title;

      const p = document.createElement('p');
      p.className = 'text-[#3A3F58] dark:text-[#ECE6CD]/90';
      p.textContent = description;

      content.appendChild(h3);
      content.appendChild(p);
      card.appendChild(imgEl);
      card.appendChild(content);

      return card;
    }

    // Helper function to create gallery images
    function GalleryImage({ src, alt }) {
      const container = document.createElement('div');
      container.className = 'relative overflow-hidden rounded-xl cursor-pointer shadow-lg transform transition-transform hover:scale-105 focus:scale-105 focus:outline-none';

      const img = document.createElement('img');
      img.src = src;
      img.alt = alt;
      img.loading = 'lazy';
      img.className = 'w-full h-full object-cover';

      container.appendChild(img);
      container.tabIndex = 0;
      container.setAttribute('aria-label', alt);

      container.addEventListener('click', () => openLightbox(src, alt));
      container.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          openLightbox(src, alt);
        }
      });

      return container;
    }

    // Append song cards dynamically
    const lukeChiangSongs = [
  { title: "Shouldn't Be", artist: "Luke Chiang", spotify: "https://open.spotify.com/track/7F6PtLP6fJPVtA1FWVkl8K?si=dab6986d0151499e" },
  { title: "May I Ask", artist: "Luke Chiang", spotify: "https://open.spotify.com/track/3BajoSb3TjPbcOC873OjbD?si=ce64025ad4864519" },
  { title: "Paragraph", artist: "Luke Chiang", spotify: "https://open.spotify.com/track/2p9Ac0KQAUfOIXXWAxlzmM?si=6949ca9293c74094 " },
  { title: "Never Tell", artist: "Luke Chiang", spotify: "https://open.spotify.com/track/72Vu0dhVlpjtdPdli224Nf?si=234b36a68fe34094 " },
      { title: "Bittersweet", artist: "Luke Chiang", spotify: "https://open.spotify.com/track/0wEqNUKF9MH4pk5va6HNCt?si=df998f37a916453c" },

];

const jesseBarreraSongs = [
  { title: "Pretend", artist: "Jesse Barrera", spotify: "https://open.spotify.com/track/8e1e1e1e1e1e1e1e1e1e1e1 " },
  { title: "Strawberry Soju", artist: "Jesse Barrera", spotify: "https://open.spotify.com/track/9f2f2f2f2f2f2f2f2f2f2f2 " },
  { title: "Chase", artist: "Jesse Barrera", spotify: "https://open.spotify.com/track/0a3a3a3a3a3a3a3a3a3a3a3 " },
  { title: "Mars", artist: "Jesse Barrera", spotify: "https://open.spotify.com/track/1b4b4b4b4b4b4b4b4b4b4b4 " },
  { title: "Tapioca", artist: "Jesse Barrera", spotify: "https://open.spotify.com/track/2c5c5c5c5c5c5c5c5c5c5c5 " },
];

const riniSongs = [
  { title: "Gone With The Wind", artist: "RINI", spotify: "https://open.spotify.com/track/7d7d7d7d7d7d7d7d7d7d7d7 " },
  { title: "Strawberry Blossom", artist: "RINI", spotify: "https://open.spotify.com/track/8e8e8e8e8e8e8e8e8e8e8e8 " },
  { title: "Out Of The Blue", artist: "RINI", spotify: "https://open.spotify.com/track/9f9f9f9f9f9f9f9f9f9f9f9 " },
  { title: "Scars", artist: "RINI", spotify: "https://open.spotify.com/track/0a0a0a0a0a0a0a0a0a0a0a0 " },
  { title: "For Days", artist: "RINI", spotify: "https://open.spotify.com/track/1b1b1b1b1b1b1b1b1b1b1b1 " },
];

    function appendSongs(containerSelector, songs) {
      const container = document.querySelector(containerSelector);
      if (!container) return;
      songs.forEach(({ title, artist, spotify }) => {
        const card = SongCard({ title, artist, spotify });
        container.appendChild(card);
      });
    }

    window.addEventListener('DOMContentLoaded', () => {
  appendSongs('#luke-chiang-songs', lukeChiangSongs);
  appendSongs('#jesse-barrera-songs', jesseBarreraSongs);
  appendSongs('#rini-songs', riniSongs);

      // Append project cards
      const portfolioGrid = document.querySelector('#portfolio > div > div.grid');
      if (portfolioGrid) {
        const projects = [
          { title: "Project One", description: "A modern web app with 3D animations.", img: "https://placehold.co/400x250/png?text=Project+One", link: "#" },
          { title: "Project Two", description: "Creative portfolio with interactive UI.", img: "https://placehold.co/400x250/png?text=Project+Two", link: "#" },
          { title: "Project Three", description: "Music visualization and player.", img: "https://placehold.co/400x250/png?text=Project+Three", link: "#" },
          { title: "Project Four", description: "3D modeling and animation showcase.", img: "https://placehold.co/400x250/png?text=Project+Four", link: "#" },
          { title: "Project Five", description: "Interactive resume with timeline.", img: "https://placehold.co/400x250/png?text=Project+Five", link: "#" },
          { title: "Project Six", description: "Personal blog with smooth animations.", img: "https://placehold.co/400x250/png?text=Project+Six", link: "#" },
        ];
        projects.forEach(p => {
          portfolioGrid.appendChild(ProjectCard(p));
        });
      }

      // Append gallery images
      const galleryGrid = document.querySelector('#gallery > div.grid');
      if (galleryGrid) {
        const galleryImages = [
          { src: "../images/1.jpg", alt: "Travel photo of Amiel at a mountain peak during sunset" },
          { src: "../images/2.jpg", alt: "Amiel playing guitar in a cozy room with warm lighting" },
          { src: "../images/3.jpg", alt: "Amiel walking on a beach with waves and blue sky" },
          { src: "../images/4.jpg", alt: "Amiel painting on a canvas in a bright art studio" },
          { src: "../images/5.jpg", alt: "Amiel exploring a vibrant city street at night with neon lights" },
          { src: "../images/6.jpg", alt: "Amiel laughing with friends at a cafe outdoor" },
          { src: "../images/7.jpg", alt: "Amiel working on a laptop with headphones on in a cozy workspace" },
          { src: "../images/8.jpg", alt: "Amiel hiking through a lush green forest trail" },
        ];
        galleryImages.forEach(img => {
          galleryGrid.appendChild(GalleryImage(img));
        });
      }
    });

    // Lightbox functionality
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxClose = document.getElementById('lightbox-close');

    function openLightbox(src, alt) {
      lightboxImg.src = src;
      lightboxImg.alt = alt;
      lightbox.classList.add('active');
      lightbox.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
      lightboxClose.focus();
    }
    function closeLightbox() {
      lightbox.classList.remove('active');
      lightbox.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }
    lightboxClose.addEventListener('click', closeLightbox);
    lightboxClose.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        closeLightbox();
      }
    });
    lightbox.addEventListener('click', e => {
      if (e.target === lightbox) closeLightbox();
    });
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape' && lightbox.classList.contains('active')) {
        closeLightbox();
      }
    });

    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });

    // Scroll down button scrolls to About section
    const scrollDownBtn = document.getElementById('scroll-down');
    scrollDownBtn.addEventListener('click', () => {
      document.getElementById('about').scrollIntoView({ behavior: 'smooth' });
    });
    scrollDownBtn.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        document.getElementById('about').scrollIntoView({ behavior: 'smooth' });
      }
    });

    // Cursor effect
    const cursor = document.getElementById('cursor');
    document.addEventListener('mousemove', e => {
      cursor.style.left = e.clientX + 'px';
      cursor.style.top = e.clientY + 'px';
    });
    // Hover effect on interactive elements
    const hoverables = document.querySelectorAll('a, button, .skill-card, .testimonial-card, .input-group input, .input-group textarea');
    hoverables.forEach(el => {
      el.addEventListener('mouseenter', () => cursor.classList.add('hovered'));
      el.addEventListener('mouseleave', () => cursor.classList.remove('hovered'));
    });

    // Theme toggle
    const themeToggleBtn = document.getElementById('theme-toggle');
    function setTheme(theme) {
      if (theme === 'dark') {
        document.body.classList.add('dark');
        document.body.classList.remove('light');
        themeToggleBtn.innerHTML = '<i class="fas fa-sun"></i>';
      } else {
        document.body.classList.add('light');
        document.body.classList.remove('dark');
        themeToggleBtn.innerHTML = '<i class="fas fa-moon"></i>';
      }
      localStorage.setItem('theme', theme);
    }
    themeToggleBtn.addEventListener('click', () => {
      if (document.body.classList.contains('dark')) {
        setTheme('light');
      } else {
        setTheme('dark');
      }
    });
    // Load theme from localStorage or system preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
      setTheme(savedTheme);
    } else {
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      setTheme(prefersDark ? 'dark' : 'light');
    }

    // Entrance animations for hero text
    window.addEventListener('load', () => {
      gsap.to('#hero-name', { opacity: 1, y: 0, duration: 1, ease: 'power3.out' });
      gsap.to('#hero-title', { opacity: 1, y: 0, duration: 1, delay: 0.5, ease: 'power3.out' });
    });

    // Scroll reveal for timeline items and other reveals
    const revealEls = document.querySelectorAll('.reveal');
    function revealOnScroll() {
      const windowBottom = window.innerHeight + window.scrollY;
      revealEls.forEach(el => {
        if (el.offsetTop < windowBottom - 100) {
          el.classList.add('active');
        }
      });
    }
    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll();

    // Background 3D animated hero canvas with floating geometric shapes
    (() => {
      const canvas = document.getElementById('hero-canvas');
      const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
      renderer.setSize(window.innerWidth, window.innerHeight);
      renderer.setPixelRatio(window.devicePixelRatio);

      const scene = new THREE.Scene();

      const camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
      camera.position.z = 30;

      // Lights
      const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
      scene.add(ambientLight);
      const directionalLight = new THREE.DirectionalLight(0xff6a59, 0.8);
      directionalLight.position.set(5, 10, 7);
      scene.add(directionalLight);

      // Floating geometric shapes group
      const shapesGroup = new THREE.Group();
      scene.add(shapesGroup);

      // Create shapes: cubes, tetrahedrons, octahedrons with coral, gold, slate colors
      const colors = [0xEE6A59, 0xF9AC67, 0x3A3F58];
      const geometries = [
        new THREE.BoxGeometry(3, 3, 3),
        new THREE.TetrahedronGeometry(2.5),
        new THREE.OctahedronGeometry(2.5),
      ];

      const shapes = [];
      for (let i = 0; i < 20; i++) {
        const geo = geometries[i % geometries.length];
        const mat = new THREE.MeshStandardMaterial({
          color: colors[i % colors.length],
          roughness: 0.4,
          metalness: 0.7,
          transparent: true,
          opacity: 0.85,
        });
        const mesh = new THREE.Mesh(geo, mat);
        mesh.position.set(
          (Math.random() - 0.5) * 50,
          (Math.random() - 0.5) * 30,
          (Math.random() - 0.5) * 40
        );
        mesh.rotation.set(Math.random() * Math.PI, Math.random() * Math.PI, 0);
        shapesGroup.add(mesh);
        shapes.push(mesh);
      }

      // Animate shapes floating and rotating
      function animate() {
        requestAnimationFrame(animate);
        const time = Date.now() * 0.001;
        shapes.forEach((shape, i) => {
          shape.rotation.x += 0.002 + i * 0.0001;
          shape.rotation.y += 0.003 + i * 0.0001;
          shape.position.y += Math.sin(time + i) * 0.002;
          if (shape.position.y > 20) shape.position.y = -20;
        });
        renderer.render(scene, camera);
      }
      animate();

      // Resize handler
      window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
      });
    })();

    // About Me blob canvas with subtle morphing animation
    (() => {
      const canvas = document.getElementById('about-blob');
      const ctx = canvas.getContext('2d');
      let width, height, centerX, centerY, radius;
      let points = [];
      const pointCount = 8;
      const baseRadius = 140;
      const noiseAmplitude = 20;
      const noiseFrequency = 0.002;
      let time = 0;

      function resize() {
        width = canvas.clientWidth * devicePixelRatio;
        height = canvas.clientHeight * devicePixelRatio;
        canvas.width = width;
        canvas.height = height;
        centerX = width / 2;
        centerY = height / 2;
        radius = baseRadius * devicePixelRatio;
        points = [];
        for (let i = 0; i < pointCount; i++) {
          const angle = (i / pointCount) * Math.PI * 2;
          points.push({
            angle,
            baseX: Math.cos(angle) * radius,
            baseY: Math.sin(angle) * radius,
            offset: Math.random() * 1000,
          });
        }
      }
      resize();
      window.addEventListener('resize', resize);

      function drawBlob() {
        ctx.clearRect(0, 0, width, height);
        ctx.fillStyle = '#EE6A59';
        ctx.shadowColor = '#F9AC67';
        ctx.shadowBlur = 30;
        ctx.beginPath();
        points.forEach((point, i) => {
          const noise = Math.sin(time * 2 + point.offset) * noiseAmplitude * devicePixelRatio;
          const x = centerX + point.baseX + Math.cos(point.angle) * noise;
          const y = centerY + point.baseY + Math.sin(point.angle) * noise;
          if (i === 0) ctx.moveTo(x, y);
          else ctx.lineTo(x, y);
        });
        ctx.closePath();
        ctx.fill();
        ctx.shadowBlur = 0;
      }

      function animate() {
        time += noiseFrequency * 1000;
        drawBlob();
        requestAnimationFrame(animate);
      }
      animate();
    })();

    // Vinyl record 3D rotating canvas in music section
    (() => {
      const canvas = document.getElementById('vinyl-canvas');
      if (!canvas) return;
      const ctx = canvas.getContext('2d');
      const size = canvas.width;
      const center = size / 2;
      let rotation = 0;

      function drawVinyl() {
        ctx.clearRect(0, 0, size, size);

        // Outer black circle
        ctx.beginPath();
        ctx.arc(center, center, center - 10, 0, Math.PI * 2);
        ctx.fillStyle = '#111';
        ctx.fill();

        // Grooves
        for (let i = 0; i < 30; i++) {
          ctx.beginPath();
          ctx.arc(center, center, center - 15 - i * 3, 0, Math.PI * 2);
          ctx.strokeStyle = 'rgba(255,255,255,0.05)';
          ctx.lineWidth = 1;
          ctx.stroke();
        }

        // Center label
        ctx.save();
        ctx.translate(center, center);
        ctx.rotate(rotation);
        ctx.beginPath();
        ctx.arc(0, 0, 50, 0, Math.PI * 2);
        ctx.fillStyle = '#EE6A59';
        ctx.fill();

        // Label text
        ctx.fillStyle = '#3A3F58';
        ctx.font = 'bold 14px Poppins';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('Amiel Jake', 0, -10);
        ctx.fillText('Favorite Music', 0, 10);
        ctx.restore();
      }

      function animate() {
        rotation += 0.01;
        drawVinyl();
        requestAnimationFrame(animate);
      }
      animate();
    })();

    // Quote of the day with fade and typewriter effect
    (() => {
      const quotes = [
        "Creativity is intelligence having fun. – Albert Einstein",
        "Music is the universal language of mankind. – Henry Wadsworth Longfellow",
        "The only way to do great work is to love what you do. – Steve Jobs",
        "Dream big and dare to fail. – Norman Vaughan",
        "Design is not just what it looks like and feels like. Design is how it works. – Steve Jobs",
        "The future belongs to those who believe in the beauty of their dreams. – Eleanor Roosevelt",
      ];
      const quoteText = document.getElementById('quote-text');
      let index = 0;

      function typeWriter(text, i = 0) {
        if (i <= text.length) {
          quoteText.textContent = text.substring(0, i);
          setTimeout(() => typeWriter(text, i + 1), 50);
        } else {
          setTimeout(() => fadeOut(), 4000);
        }
      }
      function fadeOut() {
        quoteText.style.opacity = 0;
        setTimeout(() => {
          index = (index + 1) % quotes.length;
          quoteText.style.opacity = 1;
          typeWriter(quotes[index]);
        }, 1000);
      }
      typeWriter(quotes[index]);

      // Background music toggle
      const musicToggle = document.getElementById('music-toggle');
      const bgMusic = document.getElementById('background-music');
      let musicPlaying = false;
      musicToggle.addEventListener('click', () => {
        if (musicPlaying) {
          bgMusic.pause();
          musicToggle.innerHTML = '<i class="fas fa-music mr-2"></i>Toggle Music';
        } else {
          bgMusic.play();
          musicToggle.innerHTML = '<i class="fas fa-pause mr-2"></i>Pause Music';
        }
        musicPlaying = !musicPlaying;
      });
    })();

    // Interactive 3D timeline using Three.js
    (() => {
      const container = document.getElementById('resume-timeline');
      if (!container) return;

      const width = container.clientWidth;
      const height = 400;

      const scene = new THREE.Scene();
      const camera = new THREE.PerspectiveCamera(50, width / height, 0.1, 1000);
      camera.position.set(0, 0, 50);

      const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
      renderer.setSize(width, height);
      container.appendChild(renderer.domElement);

      // Controls
      const controls = new THREE.OrbitControls(camera, renderer.domElement);
      controls.enablePan = false;
      controls.minDistance = 30;
      controls.maxDistance = 80;
      controls.maxPolarAngle = Math.PI / 2;

      // Timeline points data
      const timelineData = [
        { year: '2024', title: 'Frontend Developer', desc: 'Building interactive web apps with React and Three.js.' },
        { year: '2022', title: 'Internship', desc: 'Worked on UI/UX design and animation projects.' },
        { year: '2020', title: 'Graduated', desc: 'Completed degree with focus on graphics and web development.' },
      ];

      // Materials
      const pointMaterial = new THREE.MeshStandardMaterial({ color: 0xEE6A59, metalness: 0.7, roughness: 0.3 });
      const lineMaterial = new THREE.LineBasicMaterial({ color: 0xF9AC67 });

      // Create timeline points
      const points = [];
      const group = new THREE.Group();
      scene.add(group);

      timelineData.forEach((item, i) => {
        const geometry = new THREE.SphereGeometry(1.2, 32, 32);
        const sphere = new THREE.Mesh(geometry, pointMaterial);
        sphere.position.set(i * 10 - 10, 0, 0);
        group.add(sphere);
        points.push({ mesh: sphere, data: item });
      });

      // Create connecting lines
      const linePoints = points.map(p => p.mesh.position);
      const lineGeometry = new THREE.BufferGeometry().setFromPoints(linePoints);
      const line = new THREE.Line(lineGeometry, lineMaterial);
      group.add(line);

      // Labels using HTML overlay
      const labelsContainer = document.createElement('div');
      labelsContainer.style.position = 'absolute';
      labelsContainer.style.top = '0';
      labelsContainer.style.left = '0';
      labelsContainer.style.width = '100%';
      labelsContainer.style.height = '100%';
      labelsContainer.style.pointerEvents = 'none';
      container.style.position = 'relative';
      container.appendChild(labelsContainer);

      const labelElements = [];

      points.forEach(({ mesh, data }) => {
        const label = document.createElement('div');
        label.className = 'bg-[#F9AC67] dark:bg-[#EE6A59] text-[#3A3F58] dark:text-[#ECE6CD] rounded-md px-3 py-1 text-sm font-semibold shadow-lg select-none';
        label.style.position = 'absolute';
        label.style.whiteSpace = 'nowrap';
        label.innerHTML = `<strong>${data.year}</strong>: ${data.title}`;
        labelsContainer.appendChild(label);
        labelElements.push({ el: label, mesh });
      });

      // Animate timeline points with subtle floating
      let clock = new THREE.Clock();

      function animate() {
        requestAnimationFrame(animate);
        const elapsed = clock.getElapsedTime();

        group.rotation.y = elapsed * 0.2;

        points.forEach(({ mesh }, i) => {
          mesh.position.y = Math.sin(elapsed * 2 + i) * 1.5;
        });

        // Update label positions
        labelElements.forEach(({ el, mesh }) => {
          const vector = mesh.position.clone();
          vector.project(camera);

          const x = (vector.x * 0.5 + 0.5) * container.clientWidth;
          const y = (-vector.y * 0.5 + 0.5) * container.clientHeight;

          el.style.transform = `translate(-50%, -50%) translate(${x}px,${y}px)`;
          el.style.zIndex = vector.z > 1 ? '-1' : '10';
          el.style.opacity = vector.z > 1 ? '0' : '1';
        });

        controls.update();
        renderer.render(scene, camera);
      }
      animate();

      // Resize handler
      window.addEventListener('resize', () => {
        const w = container.clientWidth;
        const h = 400;
        renderer.setSize(w, h);
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
      });
    })();

    // Testimonials slider with drag support
    (() => {
      const slider = document.getElementById('testimonials-slider');
      if (!slider) return;

      let isDown = false;
      let startX;
      let scrollLeft;

      slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
        slider.style.cursor = 'grabbing';
      });
      slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('active');
        slider.style.cursor = 'grab';
      });
      slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('active');
        slider.style.cursor = 'grab';
      });
      slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2;
        slider.scrollLeft = scrollLeft - walk;
      });
      slider.style.cursor = 'grab';
    })();

    // Contact form validation and submission (dummy)
    (() => {
      const form = document.getElementById('contact-form');
      form.addEventListener('submit', e => {
        e.preventDefault();
        const name = form.name.value.trim();
        const email = form.email.value.trim();
        const message = form.message.value.trim();
        if (!name || !email || !message) {
          alert('Please fill in all fields.');
          return;
        }
        if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
          alert('Please enter a valid email address.');
          return;
        }
        alert('Thank you for your message, ' + name + '! I will get back to you soon.');
        form.reset();
      });
    })();

    // Floating music notes near music section
    (() => {
      const musicSection = document.getElementById('music');
      if (!musicSection) return;
      const notesCount = 15;
      const notes = [];

      for (let i = 0; i < notesCount; i++) {
        const note = document.createElement('div');
        note.className = 'music-note';
        note.style.left = Math.random() * 100 + '%';
        note.style.bottom = Math.random() * 50 + 'px';
        note.style.animationDelay = (Math.random() * 6) + 's';
        note.style.fontSize = (12 + Math.random() * 12) + 'px';
        note.innerHTML = '<i class="fas fa-music"></i>';
        musicSection.appendChild(note);
        notes.push(note);
      }
    })();
  </script>

  <script>

    // Smart Navbar & Theme Toggle Show/Hide on Scroll
const navbar = document.getElementById('navbar');
const themeToggle = document.getElementById('theme-toggle');

let lastScrollTop = 0;

window.addEventListener('scroll', () => {
  const currentScrollTop = window.scrollY;

  // Only hide if scrolled down more than 50px
  if (currentScrollTop > 50 && currentScrollTop > lastScrollTop) {
    // Scrolling down
    navbar.classList.remove('visible');
    navbar.classList.add('transparent');
    themeToggle.classList.remove('visible');
    themeToggle.classList.add('transparent');
  } 
  // Only show again when back at the very top
  else if (currentScrollTop === 0) {
    navbar.classList.add('visible');
    navbar.classList.remove('transparent');
    themeToggle.classList.add('visible');
    themeToggle.classList.remove('transparent');
  }

  lastScrollTop = currentScrollTop;
});

    </script>

    <script>

      // Vinyl record 3D rotating canvas in music section
(() => {
  const canvas = document.getElementById('vinyl-canvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  const size = canvas.width;
  const center = size / 2;
  let rotation = 0;

  // Load the Spotify image
  const img = new Image();
  img.src = '../images/Spotify.png';
  img.onload = () => {
    drawVinyl(); // Draw immediately once image is loaded
  };

  function drawVinyl() {
    ctx.clearRect(0, 0, size, size);

    // Save context before rotation
    ctx.save();
    ctx.translate(center, center);
    ctx.rotate(rotation);
    ctx.translate(-center, -center);

    // Outer black circle (vinyl)
    ctx.beginPath();
    ctx.arc(center, center, center - 10, 0, Math.PI * 2);
    ctx.fillStyle = '#111';
    ctx.fill();

    // Inner silver circle (label)
    ctx.beginPath();
    ctx.arc(center, center, 40, 0, Math.PI * 2);
    ctx.fillStyle = '#ccc'; // Light gray for label
    ctx.fill();

    // Draw Spotify logo in the center
    const imgSize = 50;
    ctx.drawImage(
      img,
      center - imgSize / 2,
      center - imgSize / 2,
      imgSize,
      imgSize
    );

    // Restore context
    ctx.restore();

    // Increment rotation for animation
    rotation += 0.005;

    // Request next frame
    requestAnimationFrame(drawVinyl);
  }

  // Start drawing
  drawVinyl();
})();

      </script>

      <script>

        // === Smooth Scroll & Mobile Menu Close for Nav Links ===
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const targetId = this.getAttribute('href');
    
    // Skip if it's an empty hash or external link
    if (targetId === '#' || targetId === '') return;

    const targetElement = document.querySelector(targetId);

    // Prevent default only if target exists
    if (targetElement) {
      e.preventDefault();

      // Close mobile menu if open
      const mobileMenu = document.getElementById('mobile-menu');
      if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.add('hidden');
      }

      // Manual smooth scroll with offset
      window.scrollTo({
        top: targetElement.offsetTop - 80, // Offset for fixed header
        behavior: 'smooth'
      });
    }
  });
});

        </script>
 
 </body>
</html>
