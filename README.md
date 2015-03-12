[![Build Status](https://travis-ci.org/ser/phpbb-nagios.svg?branch=master)](https://travis-ci.org/ser/phpbb-nagios)
[![Code Climate](https://codeclimate.com/github/ser/phpbb-nagios/badges/gpa.svg)](https://codeclimate.com/github/ser/phpbb-nagios)
# phpbb-nagios
A nagios phpBB extension for forum health monitoring.

## Main aims

This extension helps to monitor a production phpBB forum, reporting its health.

#### What is being checked?

The most basic check is done by serving any valid 200 response. It means that
web server is working. Additionally, the nagios phpBB extension:

- [x] checks and serves the version of phpBB, if the phpBB version is not up to 
date, the extension sends a `WARNING` with a short explanation,
- [x] checks if the forum is ON, if not, the extension serves a `WARNING` with
a short explanation,
- [x] for statistical purposes, the extension provides an amount of currently registered
users and other useful statistical data, which can be stored by your nagios
instance.

#### What precisely do I get from this extension?

If your forum is fine, the extension simply serves you a web page consisting of one line:

`OK. Board is enabled. phpBB version 3.1.3 is up to date. 45993 from 67887 registered
users activated their accounts. Topics: 8473. Posts: 299845. Files: 7634.`

If something is wrong, it servers a line like that:

`WARNING. phpBB forum is ON. The current 3.1.2 version is NOT up to date. 45993
from 67887 registered users activated their accounts. Topics: 8473. Posts:
299845. Files: 7634.`

#### How do I connect nagios/icinga to this information?

For all monitoring I am personally using passive checks. These are scripts I am running
from cron every five minutes via nsca:

check-phpbb.sh
```bash
#!/bin/bash
curl -s https://yoursite.com/phpBB/nagios | html2text -width 800 | tail -n +2
```

send-phpbb.sh
```bash
#!/bin/bash
HOST='server'
SERVICE='phpbb'
COMMAND=check-phpbb.sh
WRAPPER=/opt/nsca_wrapper
SENDNSCA=/usr/sbin/send_nsca

$WRAPPER -H $HOST -S $SERVICE -C "$COMMAND" -b $SENDNSCA
```

Nagios server config files look like that:

```
define service {
        hostgroup_name                  www-servers
        service_description             phpbb
        active_checks_enabled           0
        check_freshness                 1
        freshness_threshold             300
        use                             generic-service
        check_command                   check_dummy!1
        notification_interval           0 ; set > 0 if you want to be renotified
}
```

```
define hostgroup {
        hostgroup_name 			www-servers
        alias 				www
        members 			server
}
```

```
define host {
        use 				nonping-host
        host_name 			server
        address 			yoursite.com
}
```
It is out of scope of this manual to explain Nagios configuration in more details.

## The author

Serge Victor, https://keybase.io/ser

The discuss about the extension is on phpBB forum:
https://www.phpbb.com/community/viewtopic.php?f=456&t=2294286

Please do not hesitate to send github pull requests or create issues :-)

Thanks to #phpbb IRC channel members for consultations during all stages of
development of this extension.

## License

[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)
