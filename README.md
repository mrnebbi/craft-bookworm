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

## Usage

In your template add the following line to pull a list from Bookworm.

```
{% set books = craft.bookworm.fetch({'limit': 25}) %}
```
