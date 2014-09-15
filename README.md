Bookworm Goodreads plugin for Craft CMS
=======================================

Bookworm is a Craft CMS plugin to provide lists of books from your Goodreads shelves.

Pull lists of books directly into your Craft templates.

## Features:

- Any shelf name available (not just your read books)
- User defined limit to books fetched
- User defined sort order (date_read, date_added, etc)
- Provides lots of book data
-- Title
-- Author name
-- Cover image
-- Book description
-- Book URL
-- User rating

## Installation

To install Bookworm, copy the bookworm/ folder into craft/plugins/, then goto Settings > Plugins and click **Install**.

You will then need to enter your Goodreads User ID. This can be found in the address bar when viewing your Goodreads shelves. It’s the seven digit number listed after _/list/_

E.g.

https://www.goodreads.com/review/list/ **1234567** ?shelf=read


## Usage

In your template add the following line to pull a list from Bookworm. This will try to get the last 10 books from your _read_ shelf, sorted by the date read. 

```
{% set books = craft.bookworm.fetch() %}
```

You can also define optional parameters to change the results you get back.

```
{% set books = craft.bookworm.fetch({'shelf': ‘to-read','limit': 200,'sortBy': 'date_read'}) %}
```

Please note, there seems to be a limit of 200 books that can be retrieved from the Goodreads feeds.

## Changelog

### 1.0.1

- API key is now optional
- Updated README to be a little more detailed

### 1.0

- Plugin pushed to Github. This is the first public version of Bookworm to be released