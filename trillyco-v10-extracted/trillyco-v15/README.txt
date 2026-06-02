Trilly Co Theme — v2.0.0
========================
WordPress theme for trillycorp.com

WHAT'S NEW IN v2.0
- Small business ICP featured first (amber accent, "Most requested" badge)
- Startup ICP second (slate blue accent)
- Full mobile hamburger navigation
- Nav "Get started" CTA button (always visible at ≥ 640px)
- HubSpot-ready audience routing on all CTAs
- Contact form AJAX with WP → HubSpot Forms API bridge
- Trillium Hiring Services cross-link band + footer links
- Fluid type scale (clamp-based — no breakpoint font jumps)
- Improved mobile touch targets (min 52px)
- Dark-mode audience accent colors

REQUIRES
- WordPress 6.0+
- PHP 7.4+
- HubSpot WP plugin (optional, recommended)

INSTALLATION
1. Upload trillyco-v10/ to /wp-content/themes/
2. Activate in Appearance → Themes
3. Add to wp-config.php (see HubSpot setup guide)

FILES
trillyco-v10/
├── style.css         — Full design system + responsive layout
├── index.php         — Landing page template
├── header.php        — Nav with mobile drawer
├── footer.php        — Footer with Trillium cross-links
├── functions.php     — Enqueue, AJAX handler, HubSpot API bridge
├── assets/
│   └── js/
│       └── main.js   — Theme toggle, mobile menu, reveals, routing, form
└── README.txt        — This file
