# Lightkeeper

Lightkeeper integrates Google Lighthouse testing alongside continuous performance monitoring.

## Requirements

This plugin requires Craft CMS 3.4.0 or later.

## Usage

#### Web Vitals

Record web vitals by adding `{{ craft.lightkeeper.load() }}` to the documents HEAD within your base template.

#### Lighthouse Audits

The Lighthouse audit widget is available for all Entries and Categories that contain publicly accessible URLs. Audits are performed in the cloud and local websites/applications will not be auditable.

## Lightkeeper Roadmap

* Lighthouse Testing ✔️
    * Minimum scores before developers are notified ✔️
        * Perfromance ✔️
        * Accessability ✔️
        * Best Practices ✔️
    * Send email on poor performance ✔️
    * Developer email address ✔️
    * Side panel component ✔️
        * Manual test button ✔️
        * Accessability test (0/100) ✔️
        * Perf test (0/100) ✔️
        * Best Practices test (0/100) ✔️
        * SEO test (0/100) ✔️
    * Caching ✔️
* Perfromance Aduiting ✔️
    * Add Web Vitals library injection variable ✔️
    * Log Web Vitals in section labeled Performance ✔️
        * Largest Contentful Paint ✔️
        * First Input Delay ✔️
        * Cumulative Layout Shift ✔️
        * Users connection type ✔️
        * RAM ✔️
        * CPU ✔️
        * Browser ✔️
        * Window size ✔️
        * Available storage ✔️
