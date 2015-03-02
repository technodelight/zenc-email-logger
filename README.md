zenc-email-logger
=================

Email logging functionality for Magento. Useful if you don't want to deal with sendmail/postfix/whatever setups and you want to debug/style email contents on your local environment. Note: the module may not work with other email related extensions due to the fact that the exact same classes would be overridden.

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

