# Lightkeeper

Continuous performance monitoring for your Craft CMS websites.

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Usage

Register the Lightkeeper asset bundle by adding `{% hook 'lightkeeper' %}` within your base template.

Alternatively you can inject the `<script>` element into your document by uising `{% hook 'lightkeeper-raw' %}` instead.
