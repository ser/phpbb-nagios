[![Build Status](https://travis-ci.org/ser/phpbb-nagios.svg?branch=master)](https://travis-ci.org/ser/phpbb-nagios)
[![Code Climate](https://codeclimate.com/github/ser/phpbb-nagios/badges/gpa.svg)](https://codeclimate.com/github/ser/phpbb-nagios)
###### Stage `ALPHA`, absolutely not ready for production!
# phpbb-nagios
A nagios phpBB extension for forum health monitoring.

## Main aims

This extension helps to monitor a production phpBB forum, reporting its health.

#### What is being checked?

The most basic check is done by serving any valid 200 response. It means that
web server is working. Additionally, the nagios phpBB extension checks:

- [ ] it checks and servers the version of phpBB, if the phpBB version is not up to date, the extension sends a `WARNING` with a short explanation,
- [ ] it checks if the forum is ON, if not, the extension serves a `WARNING` with a short
explanation,
- [ ] for statistical purposes, the extension provides an amount of currently registered
users.

#### What precisely do I get from this extension?

If your forum is fine, the extension simply serves you a web page consisting of one line:

`OK. Board is enabled. phpBB version 3.1.3 is up to date. 45993 from 67887 registered
users activated their accounts. Topics: 8473. Posts: 299845. Files: 7634.`

If something is wrong, it servers a line like that:

`WARNING. phpBB forum is ON. The current 3.1.2 version is NOT up to date. 45993
from 67887 registered users activated their accounts. Topics: 8473. Posts:
299845. Files: 7634.`

#### How do I connect nagios/icinga to this information?

For all monitoring I am personally using passive checks. This is a script I am running from cron every five minutes:

## The author

Serge Victor, https://keybase.io/ser

The discuss about the extension is on phpBB forum:
https://www.phpbb.com/community/viewtopic.php?f=456&t=2294286

Please do not hesitate to send github pull requests or create issues :-)

Thanks to #phpbb IRC channel members for consultations during all stages of
development of this extension.

## License

[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)
