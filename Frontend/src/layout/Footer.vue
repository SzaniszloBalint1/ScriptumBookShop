<template>
    <footer class="footer">
      <div class="container py-4">
        <div class="row">
          <div class="col-md-4 mb-3 mb-md-0">
            <h5 class="footer-heading">Scriptum</h5>
            <p class="footer-text">Minőségi könyvek kedvező áron, széles választékkal.</p>
            <div class="social-icons">
              <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
              <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
          <div class="col-md-4 mb-3 mb-md-0">
            <h5 class="footer-heading">Gyors linkek</h5>
            <ul class="footer-links">
              <li><router-link to="/home">Kezdőlap</router-link></li>
              <li><router-link to="/home">Kategória</router-link></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h5 class="footer-heading">Kapcsolat</h5>
            <address class="footer-text">
              <p><i class="fas fa-map-marker-alt me-2"></i>Budapest | Nem létezik az utca 18.</p>
              <p><i class="fas fa-phone me-2"></i>+36 20 502 9699</p>
              <p><i class="fas fa-phone me-2"></i>+36 20 549 0150</p>
              <p><i class="fas fa-envelope me-2"></i>Scriptum.Shop@gmail.com</p>
            </address>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-12 text-center">
              <p class="mb-0">© 2025 Könyvesbolt - Minden jog fenntartva</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </template>
  
  
  
  <style scoped>
  .footer {
    background-color: #2c3e50;
    color: #ecf0f1;
    width: 100%;
    position: relative;
    z-index: 1000;
    border-top: 4px solid #e74c3c;
  }
  
  .footer-heading {
    color: #fff;
    font-weight: 600;
    margin-bottom: 1.2rem;
    font-size: 1.2rem;
  }
  
  .footer-text {
    color: #bdc3c7;
    font-size: 0.95rem;
    line-height: 1.6;
  }
  
  .footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  .footer-links li {
    margin-bottom: 0.5rem;
  }
  
  .footer-links a {
    color: #bdc3c7;
    text-decoration: none;
    transition: color 0.2s;
    font-size: 0.95rem;
  }
  
  .footer-links a:hover {
    color: #e74c3c;
    text-decoration: none;
  }
  
  .social-icons {
    display: flex;
    gap: 15px;
    margin-top: 1.5rem;
  }
  
  .social-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: rgba(255,255,255,0.1);
    color: #ecf0f1;
    transition: all 0.3s ease;
  }
  
  .social-icon:hover {
    background-color: #e74c3c;
    color: #fff;
    transform: translateY(-3px);
  }
  
  .footer-bottom {
    background-color: rgba(0,0,0,0.2);
    padding: 15px 0;
    font-size: 0.9rem;
  }
  
  .container, .row, .col-md-4, .col-12 {
    background-color: transparent;
  }
  
  address {
    font-style: normal;
  }
  
  @media (max-width: 767px) {
    .footer-heading {
      margin-top: 1.5rem;
    }
  }
  </style>