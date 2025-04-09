<style>
    .content {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      color: #fff;
      height: 100vh;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      position: relative;
    }

    .neon-text {
      font-size: 8rem;
      font-weight: 700;
      text-shadow: 
        0 0 5px #00ffe0, 
        0 0 10px #00ffe0, 
        0 0 20px #00ffe0, 
        0 0 40px #00ffe0;
      animation: flicker 1.5s infinite alternate;
    }

    @keyframes flicker {
      0%   { opacity: 1; text-shadow: 0 0 5px #00ffe0; }
      50%  { opacity: 0.8; text-shadow: 0 0 20px #00ffe0; }
      100% { opacity: 1; text-shadow: 0 0 40px #00ffe0; }
    }

    .subtitle {
      font-size: 2rem;
      margin-top: -1rem;
      margin-bottom: 2rem;
      text-align: center;
      color: #b0f8ff;
    }

    .btn-animated {
      padding: 0.75rem 2rem;
      font-size: 1.2rem;
      background: linear-gradient(90deg, #00ffe0, #00bcd4);
      border: none;
      color: #000;
      border-radius: 30px;
      box-shadow: 0 0 15px #00ffe0;
      transition: all 0.3s ease-in-out;
    }

    .btn-animated:hover {
      transform: scale(1.05);
      box-shadow: 0 0 25px #00ffe0;
    }

    .background-bubbles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }

    .background-bubbles span {
      position: absolute;
      display: block;
      width: 20px;
      height: 20px;
      background: rgba(0, 255, 255, 0.2);
      border-radius: 50%;
      animation: bubble 20s linear infinite;
      bottom: -150px;
    }

    .background-bubbles span:nth-child(1) {
      left: 10%;
      animation-delay: 0s;
    }
    .background-bubbles span:nth-child(2) {
      left: 20%;
      animation-delay: 2s;
      width: 30px;
      height: 30px;
    }
    .background-bubbles span:nth-child(3) {
      left: 25%;
      animation-delay: 4s;
    }
    .background-bubbles span:nth-child(4) {
      left: 40%;
      animation-delay: 0s;
      width: 40px;
      height: 40px;
    }
    .background-bubbles span:nth-child(5) {
      left: 70%;
      animation-delay: 3s;
    }
    .background-bubbles span:nth-child(6) {
      left: 80%;
      animation-delay: 6s;
      width: 60px;
      height: 60px;
    }

    @keyframes bubble {
      0% {
        transform: translateY(0) scale(1);
        opacity: 0;
      }
      50% {
        opacity: 1;
      }
      100% {
        transform: translateY(-1000px) scale(1.5);
        opacity: 0;
      }
    }
  </style>
<div class="content">
<div class="background-bubbles">
    <span></span><span></span><span></span>
    <span></span><span></span><span></span>
  </div>

  <div class="text-center position-relative z-1">
    <div class="neon-text">404</div>
    <div class="subtitle">Oops! Role Not Found</div>
    <a href="/" class="btn btn-animated">Return to Dashboard</a>
  </div>

</div>
