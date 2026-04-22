<?php if (!defined('ABSPATH')) { exit; } ?>

<footer class="site-footer" role="contentinfo">
  <div class="wrap">
    <div class="footer-top">
      <div class="footer-grid">

        <!-- Col 1: Brand -->
        <div class="footer-col">
          <strong>Trilly Co.</strong>
          <p>Hands-on HR operations and hiring systems for small businesses and startups in Seattle and beyond.</p>
          <!-- Sister company link -->
          <a class="footer-trillium-link" href="https://www.trilliumhiring.com/" target="_blank" rel="noopener">
            Trillium Hiring Services
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
            </svg>
          </a>
        </div>

        <!-- Col 2: Services -->
        <div class="footer-col">
          <strong>Services</strong>
          <nav class="link-stack" aria-label="Services">
            <a href="#services">Hiring &amp; recruiting ops</a>
            <a href="#services">HR &amp; people operations</a>
            <a href="#services">Onboarding &amp; workflow</a>
            <a href="#services">Operational cleanup</a>
          </nav>
        </div>

        <!-- Col 3: Who we help -->
        <div class="footer-col">
          <strong>Who we help</strong>
          <nav class="link-stack" aria-label="Audiences">
            <a href="#who-we-help" data-route-audience="small-business">Small businesses</a>
            <a href="#who-we-help" data-route-audience="startup">Startups</a>
            <a href="https://www.trilliumhiring.com/" target="_blank" rel="noopener">Trillium Hiring</a>
          </nav>
        </div>

        <!-- Col 4: Connect -->
        <div class="footer-col">
          <strong>Connect</strong>
          <nav class="link-stack" aria-label="Contact">
            <a href="#contact">Get Started Today</a>
            <a href="mailto:info@trillycorp.com">info@trillycorp.com</a>
            <a href="https://www.linkedin.com/company/trillycorp" target="_blank" rel="noopener">LinkedIn</a>
          </nav>
        </div>

      </div><!-- .footer-grid -->

      <div class="footer-bottom">
        <span>&copy; <?php echo esc_html(date('Y')); ?> Trilly Co &middot; Seattle, WA</span>
        <span>
          <a href="https://www.trilliumhiring.com/" target="_blank" rel="noopener" style="color:inherit;">Trillium Hiring Services</a>
          &nbsp;&middot;&nbsp;
          <a href="mailto:info@trillycorp.com" style="color:inherit;">info@trillycorp.com</a>
        </span>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
