Archives for a category, version 1.4b

Description
===========
Adds a cat parameter to wp_get_archives() to limit the posts used to generate the archive links to one or more categories.

Installation
============
1. Put this file in your WordPress plugin directory, <your wordpress dir>/wp-content/plugins.
2. Activate the plugin 'Archives for a category' on the Plugin Management page of the WordPress administration panel.
3. Optionally disable the canonical URLs from the menu Settings | Kwebble.

Usage
=====
After installing and activating the plugin the wp_get_archives() function accepts a 'cat' 
parameter to specify the categories of posts to show in the list of archives. The value of the 
'cat' parameter must be a list of one or more category ID's, separated by comma's. 

If you specify the value of a category ID the posts from that category will be used to create the 
list of archives. If you place a minus sign '-' in front of an ID the posts from that category 
will be excluded.

Depending on the number of categories, your use of them and selection of categories to include in 
the archive list it may be easier to specify all categories to include or just those to exclude.  

You need to make sure the template used to show each archive displays posts from the selected 
category. I'm using category specific templates on this site, like category-id where id is the ID 
of the category to display.
You can use other templates in the template hierarchy, but make sure the template shows items of 
the categories you specify.

At some WordPress version the categories ID's are no longer visible on the administration pages. 
You can find the ID of a category by opening the page to edit the category and inspect the URL of 
that page. The value after cat_ID= is the ID of the category.

Examples
========
Show the default monthly list of archives for category 1:
<?php wp_get_archives('cat=1'); ?>

The same list, but with posts from categories 1 and 3:
<?php wp_get_archives('cat=1,3'); ?>

Use posts from all categories except category 2:
<?php wp_get_archives('cat=-2'); ?>

Use posts from all categories except categories 2 and 8:
<?php wp_get_archives('cat=-2,-8'); ?>

Create a list of archives for category 1 as a dropdown box:
<?php wp_get_archives('format=option&cat=1'); ?>

For a complete description of all other parameters see the documentation of wp_get_archives().

Limitations
===========
This plugin does not work for weekly archives. The list with archive links is correct, but the 
links themselves do not include the category. So when used, WordPress will not filter the resulting 
page on the category.
The technical reason is that WordPress does not apply filters when the links for weekly archives 
are generated, so the plugin can't change them. Perhaps this is fixed in a next version of 
WordPress.

A WordPress feature added in version 2.3, called canonical URLs, redirects browsers on certain 
URLs. This also happens with the URLs for the archives with a cat parameter. This causes the 
archive pages to contain posts which do not belong to the selected period.

To solve this problem the plugin can disable canonical URLs. Go to the administration section of 
your blog, select Settings and the Kwebble option. On that page you will find a setting to disable 
canonical URLs. This is done using the same technique described in the 
<a href="http://txfx.net/files/wordpress/disable-canonical-redirects.phps">Disable Canonical URL Redirection plugin</a> 
Mark Jaquith made.

This plug-in was developed and tested to work correctly with WordPress versions 2.7.1, but it 
probably works with earlier versions back to 2.2.1.

History
=======
1.0
- Initial version, works with WordPress 2.2.1.

1.2
- Added support for WordPress 2.3.1.

1.3
- Added support for multiple categories.

1.4
- Categories can be excluded.

1.4a (bugfix)
- Corrected post count when posts belong to multiple categories.
- SQL queries now respect the configured SQL table prefix.
- Templates with multiple calls to wp_get_archives(), with and without 'cat' parameter, generate correct URL's.

1.4b (bugfix)
- Solved the bug where only the first link of an archive list included a selection by category and all other didn't. This also removes the possibility to use multiple calls to wp_get_archives(), with and without 'cat' parameter.

Copyright
=========
Copyright 2007, 2008, 2009 Rob Schlüter. All rights reserved.

Licensing terms
===============
- You may use, change and redistribute this software provided the copyright notice above is included. 
- This software is provided without warranty, you use it at your own risk. 
