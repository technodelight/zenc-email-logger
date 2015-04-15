zenc-email-logger
=================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/technodelight/zenc-email-logger/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/technodelight/zenc-email-logger/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/technodelight/zenc-email-logger/badges/build.png?b=master)](https://scrutinizer-ci.com/g/technodelight/zenc-email-logger/build-status/master)

Email logging functionality for Magento. Useful if you don't want to deal with sendmail/postfix/whatever setups and you want to debug/style email contents on your local environment.
The logger has the following advantages over other tools:

 - Could be added easily to existing projects without requiring any special 3rd party tool
 - Logs emails with detailed (extendable) informations to database, including headers and raw email output
 - Logging through re-usable elements (A compatible `Zend_Mail` override and a custom zend mail transport for logging)
 - allow adding extra informations before saving to log instance by subscribing to the custom event zenc_emaillogger_send_mail
 - restful API to retrieve email details, with formatting capabilities (dump, html, json formats supported), allows retrieving last sent email

#### How to use
 The content's captured by the logger is now only visible via the rest controller. There's a plan to add an admin panel for this in the future.
 To retrieve the list of sent mails, visit your browser with this URL:
```
<your host>/emails/rest/list
```
 To retrieve the last email which have been sent, just go here:
```
<your host>/emails/rest/read/id/last
```
 To retrieve the contents of a specific email you can use the ID of the log record instead of `last`, like `/emails/rest/read/id/1` .
 
 The REST controller has the ability to change the format of rendering. Just append `?format=<format>` to the end of the URL. Currently available renderers:
 - dump (which does a `var_dump()` on the log item's data)
 - html (renders the email's HTML content if present)
 - json (dumps every data in a friendly format, so you could use this module in your CI)

## INSTALLATION Via Modman - Recommended (https://github.com/colinmollenhour/modman)

#### 1) Install Modman:

```
bash < <(wget -O - https://raw.github.com/colinmollenhour/modman/master/modman-installer)
```

or

```
bash < <(curl -s https://raw.github.com/colinmollenhour/modman/master/modman-installer)
source ~/.profile
```

#### 2) Install Zenc EmailLogger

<pre>
cd [magento root folder]
modman init
modman clone https://github.com/technodelight/zenc-email-logger.git
</pre>

 - Make sure you've cleaned Magento's cache to enable the new module; hit refresh

#### How to update
<pre>
modman update zenc-email-logger
</pre>

 - Clean Magento's cache to make sure new changes will be enabled.
 - Run setup scripts with n98-magerun
