# Salmon Phishing Framework

Requires a [Laravel Nova](https://nova.laravel.com/) license.

Run php artisan `storage:link`!

It uses [Mailgun](https://www.mailgun.com/) for easy multi-domain management, SPF & DKIM, and other useful features out of the box (and free).

## Environment variables

* **CONTACT**: The contact text for the phishing display message (check `resources/views/phished.blade.php`)
* **MAILGUN_SECRET**: Mailgun API secret.
* **MAILGUN_ENDPOINT**: Mailgun server.
* **MAIL_HEADER**: Mail header to send on all emails. Usefull for whitelisting in anti-spam policies.
* **DEFAULT_REDIRECT**: URL to redirect all random website visits (anything else than admin and campaing views).


### Bypassing anti-spam / anti-phishing filters

### Gmail suspicious link

>Suspicious link — This link leads to an untrusted site. Are you sure you want to proceed to xxx.yyy?

**Solution**: Add the site to Google Postmaster Tools and verify it. Also, using Mailgun click tracking (over CNAME) might help (not confirmed).

**Sources**:
* https://medium.com/@zandra.harner/how-i-fixed-suspicious-link-problem-in-google-email-a6faebdc028c
* https://support.google.com/mail/thread/4242603?hl=en
