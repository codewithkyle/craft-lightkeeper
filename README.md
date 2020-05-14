# Lightkeeper

Lightkeeper helps to integrate and automate Google Lighthouse testing along with automated performance monitoring and reporting.

## Requirements

This plugin requires Craft CMS 3.4.0 or later.

## Lightkeeper Roadmap

* Add settings
    * Allow developers to choose what sections/categories/singles are tracked & logged
    * API key (optional)
    * Minimum scores before developers are notified
        * Perfromance
        * Accessability
        * Best Practices
    * Email on poor performance (lightswitch)
    * Developer email address
* Add side panel component
    * Manual test button
    * Accessability test (pass/fail)
    * Perf test (0/100)
    * Best Practices test (0/100)
    * SEO test (0/100)
* Caching
    * Response cache
    * Ability to clear response cache
* Perfromance Section
    * Add Web Vitals library injection variable
    * Log Web Vitals in section labeled Performance
        * Largest Contentful Paint
        * First Input Delay
        * Cumulative Layout Shift
        * Users connection type
        * RAM
        * CPU
        * Browser
        * Window size
        * Available storage
