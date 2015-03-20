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
