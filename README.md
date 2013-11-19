zenc-email-logger
=================

Email logging functionality for Magento

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

