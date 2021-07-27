# wp-green-checker

This plugin consists of two main groups of functionality:

* The green web checker
* The green web directory

## The green web checker

This allows users to perform a check on the greenness of a website by searching for a URL. For a valid URL, a page displays detailing more info about that website's greenness.

## Search form options

The search form for performing a check can be displayed to the user in a few ways:

1. On the `green-web-check/` page
1. Via a shortcode, `green-checker-search-form`

### Shortcode
Use `[green-checker-search-form]` inside the content of a page.

Or `<?php echo do_shortcode( '[green-checker-search-form]' ); ?>` within theme code.

## The green web directory

This produces a listing of the green web hosts known to TGWF.

This can be presented as a map, or a list of hosts by country.



