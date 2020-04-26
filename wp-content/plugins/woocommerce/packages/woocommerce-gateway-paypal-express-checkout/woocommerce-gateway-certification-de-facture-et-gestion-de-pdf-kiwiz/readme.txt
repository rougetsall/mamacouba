=== Plugin Name ===
Contributors: kiwiz
Tags: certification facture, facture, invoice, credimemo, refund, certification, loi anti-fraude TVA, woocommerce
Requires at least: 4.6
Tested up to: 4.6
Requires PHP: 5.6
Stable tag: 2.1.0

== Description ==

Le module Kiwiz est un système de certification en temps réel dans la Blockchain pour se conformer à la loi anti-fraude TVA 2018. Il s’intègre à l’extension WooCommerce et permet de générer des factures et des avoirs certifiés au format pdf (sous réserve d’avoir un abonnement à la solution Kiwiz).
[youtube https://www.youtube.com/watch?v=-kPs5y-z3tM]


== Changelog ==

= 2.1.3 - 2019-09-13 =
* Fix - Fatal error when others plugins uses the same library FPDI
* Fix - Do not change the order creation date when an invoice is created
* Fix - Bug on the filters in the invoice and refunds linsting pages
* Feature - Check the email format in invoice address before create the invoice

= 2.1.2 - 2019-05-02 =
* Fix - Bug if thousand separator is a space
* Feature - Generation of the invoice to a change of order status
* Tweak - Display the error message choosing the logo, just above the field

= 2.1.1 - 2019-03-20 =
* Fix - Bug if thousand separator is defined in woocommerce settings
* Fix - Update Plugin URI

= 2.1.0 - 2019-03-04 =
* Fix - Bug of displaying the image in a pdf document
* Fix - Bug saving logo in kiwiz folder
* Tweak - Adding mass action to generate invoices on orders grid
* Tweak - Adding preview option in settings

= 2.0.9 - 2019-02-11 =
* Fix - Encrypt special characters
* Tweak - Replace the WooCommerce installation code with the internal installation of WordPress
* Tweak - Display shipping item title instead of generic shipping method title

= 2.0.8 - 2019-02-05 =
* Tweak - Add changelog file
* Tweak - Set empty value to options when desactivated extension instead of delete them
* Fix - Encrypt Kiwiz login credentials

= 2.0.7 - 2019-02-04 =
* Tweak - Add shipping method label and payment method label in the billing and refund pdf
* Tweak - Changing separating character from notification emails in settings page
* Tweak - Delete useless font from lib
* Tweak - Adding uninstall process
* Fix - Securing queries

= 2.0.6 - 2019-01-31 =
* Tweak - Shipping adresse is not anymore required to do certification
* Fix - Add deadlock on datas base on increment id value update
* Fix - Deprecated notification message

= 2.0.5 - 2019-01-30 =
* Tweak - Changes made in the backoffice (presentation of the parameters page, labels, link)
* Tweak - Export all documents, not just those on the page

= 2.0.4 - 2019-01-24 =
* Tweak - Changing the menu view and settings localisation
* Tweak - Update shipping line in total block
* Fix - Verify token status before displaying download buttons
* Fix - Verify that the document exists before adding it to the global export

= 2.0.3 - 2019-01-23 =
* Fix - Set empty value if tax name is not defined

= 2.0.2 - 2019-01-22 =
* Fix - API Kiwiz : Make the country of the addresses not mandatory (billing and shipping)

= 2.0.1 - 2019-01-21 =
* Fix - Error on create refund.
* Tweak - Changing the menu view and settings localisation