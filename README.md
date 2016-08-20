Sitemap generator command line application
=======

[![Build Status](https://travis-ci.org/danielemoraschi/sitemap-app.png?branch=master)](https://travis-ci.org/danielemoraschi/sitemap-app)

This is an example app based on the library [dmoraschi/sitemap-common](https://github.com/danielemoraschi/sitemap-common/tree/v1.0.0)

Usage:
-------------
```shell
bin/sitemap generate [options]
```

Options:
-------------
```shell
  -u, --url=URL                The website url to scan. This is mandatory.
  -d, --deep[=DEEP]            Follow link deep scan. [default: 1]
  -p, --priority[=PRIORITY]    Web page priority. [default: 0.3]
  -f, --frequency[=FREQUENCY]  Web page frequency. [default: "daily"]
  -o, --output[=OUTPUT]        The output filename. [default: "sitemap.xml"]
  -h, --help                   Display this help message
```