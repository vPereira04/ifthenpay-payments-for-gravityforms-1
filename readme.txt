=== ifthenpay | Payments for GravityForms ===
Contributors: ifthenpay
Tags: ifthenpay, gravityforms, payments, pay by link, gateway
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.2
Stable tag: 1.0.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Adds ifthenpay payment methods to GravityForms: cards, wallets, and local payment options; supports secure one-time payments via pay-by-link.

== Description ==

This plugin integrates the ifthenpay payment gateway with GravityForms to enable seamless payment collection directly from your forms. Payments are processed through a secure pay-by-link system, ensuring that no sensitive card or banking data is stored on your website. Customers can complete payments using their preferred method via a secure payment page.

In plain terms you get:
* One-time payments through GravityForms
* Support for orders
* Merchant backoffice (basic sales) on web + mobile
* Automatic payment confirmations (no card numbers stored)

All settings are managed within GravityForms and your ifthenpay Backoffice. The plugin is designed so store owners can handle payments without requiring advanced technical knowledge.

== Key Features ==

1. Full integration with GravityForms lite and pro payment fields
2. Secure transactions
3. Automatic payment confirmation (fast access)
4. Support for multiple payment methods (cards, wallets, transfers)
5. Real-time payment status in GravityForms
6. Multi-language support (EN, ES, FR, PT)
7. Security-first approach (no card data stored)

== Requirements ==
* An active ifthenpay merchant account.
* The payment methods you want enabled (our helpdesk team will guide you).
* WordPress 6.5+ and PHP 8.2+, with GravityForms installed and activated.
* HTTPS (SSL) enabled on your site.

== Installation ==
1. Install: Upload the plugin zip via Plugins → Add New → Upload, or install from WordPress.org and Activate.
2. Credentials: Ensure your ifthenpay account has an active GravityForms Gateway Key with desired payment methods enabled.
3. Setup: Go to GravityForms → Settings → Ifthenpay and enter your Backoffice Key.
4. Form config: Create/Edit a form → Settings → Ifthenpay → "Add New" Feed and select a Gateway Key.

== Frequently Asked Questions ==

= Does this plugin require GravityForms? =

Yes. GravityForms must be installed and active to use this plugin.

Without GravityForms, this plugin cannot function.

= Does it support recurring payments? =

No. This version supports one-time payments via pay-by-link only.

= Are payment details stored? =

No. The plugin does not store card numbers or full bank details.

Only the minimal references required for payment matching and status updates are stored.

= Which payment methods are supported? =

Any ifthenpay method attached to your Gateway Key, including Multibanco, MB WAY, Payshop, Credit Card, Cofidis, Google Pay, Apple Pay, and Pix.

= How does the payment process work? =

After form submission, users are redirected to a secure payment page hosted by ifthenpay.

Once payment is completed, the payment status is updated automatically via callback.

= What happens if a payment fails? =

The GravityForms entry is marked as Failed.

Depending on your configuration, users may retry the payment.

= Can I customize the payment experience? =

Yes. You can configure display mode, button labels, descriptions, and styling options directly within GravityForms.

= Is there a sandbox? =

ifthenpay may provide test entities for development and testing purposes.

If unavailable, we recommend using a low-value live transaction.

= How secure is the integration? =

All requests are encrypted over HTTPS and no sensitive payment data is stored on your website.

= Why are payment links failing or setup timing out? =
 
Your server firewall or VPN may be blocking outbound requests. The plugin must connect to ifthenpay APIs to function. Ensure your network administrator allows outbound HTTPS traffic to ifthenpay domains.

== External Services ==

This plugin integrates with the ifthenpay payment platform to process payments for GravityForms submissions. ifthenpay is a third-party service that provides secure payment processing for various methods including cards, wallets, and local bank transfers.

- **GravityForms**
  - **What it is and what it is used for**: A form builder plugin used to create payment forms. This plugin extends its payment functionality.

- **ifthenpay Backoffice & Integrations**
  - **What it is and what it is used for**: The ifthenpay Backoffice is the merchant dashboard used to manage integrations and payment configurations. The plugin uses the ifthenpay API to generate payment links and validate transactions.
  - **What data is sent and when**:
    - During setup: Backoffice Key and Gateway Key for authentication and configuration retrieval.
    - During payment processing: Transaction ID, amount, description, enabled payment method accounts, success/error/cancel return URLs, language, and optionally the selected payment method, customer email, customer name, and form field data.
    - During callbacks: Payment status, Transaction ID, and payment method.
  - **Network & VPN Requirements**: Outbound HTTPS requests are made to ifthenpay APIs for setup, link generation, and status validation. Servers behind strict firewalls or restrictive outbound VPNs must allowlist the following domains to prevent connection timeouts:
    - [api.ifthenpay.com](https://api.ifthenpay.com)
    - [ifthenpay.com](https://ifthenpay.com)
  - **End-User License Agreement (EULA)**: [EULA](https://ifthenpay.com/eula/)
  - **Privacy Policy**: [Privacy Policy](https://ifthenpay.com/politica-de-privacidade/)

All network requests are performed server-side over HTTPS. Sensitive credentials are stored securely and are not publicly exposed. No raw card or bank details are stored.

== Screenshots ==
1. (Admin Only) Backoffice Synchronization (GravityForms Settings -> Ifthenpay)
2. (Admin Only) Adding ifthenpay's Payment field to the selected form
2. (Admin Only) ifthenpay's Payment field options
4. (Admin Only) GravityForms's Form Feed Settings (Creation/Editing Form -> Settings)
5. (Admin Only) ifthenpay's Gateway Configuration on a Feed Setting
6. (Customers Experience) Payment Gateway field display varies by GravityForms settings
7. (Customers Experience) Payment Window
8. (Admin Only) Payment Entries
9. (Admin Only) E-mail Payment Notification

== Changelog ==

= 1.0.0 =
* Initial release: GravityForms integration, ifthenpay payments, multi-method support, modal.

== Upgrade Notice ==

= 1.0.0 =
Initial release. Review gateway settings payments before going live.

== License ==
This plugin is licensed under the GPLv3.

== Support ==

For assistance use the [WordPress.org support forum](https://wordpress.org/support/plugin):

Pre-checks before posting:
* Payment method enabled on Gateway Key AND mapped to Integration
* Running current recommended versions of WordPress, PHP & GravityForms

Commercial helpdesk available (no direct email required): [helpdesk.ifthenpay.com](https://helpdesk.ifthenpay.com/)
* ifthenpay support: [suporte@ifthenpay.com](mailto:suporte@ifthenpay.com)
* GravityForms docs: [GravityForms docs](https://gravityforms.com/docs/)
