# Salmon Phishing Framework

Requires a [Laravel Nova](https://nova.laravel.com/) license.

Run php artisan `storage:link`!

It uses [Mailgun](https://www.mailgun.com/) for easy multi-domain management, SPF & DKIM, and other useful features out of the box (and free).

### Environment variables

* **CONTACT**: The contact text for the phishing display message (check `resources/views/phished.blade.php`)
* **MAILGUN_SECRET**: Mailgun API secret.
* **MAILGUN_ENDPOINT**: Mailgun server.
* **MAIL_HEADER**: Mail header to send on all emails. Usefull for whitelisting in anti-spam policies.
* **DEFAULT_REDIRECT**: URL to redirect all random website visits (anything else than admin and campaing views).