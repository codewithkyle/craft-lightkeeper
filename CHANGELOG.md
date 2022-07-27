# Lightkeeper Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

[Unreleased]

## 1.3.6 - 2022-07-27

### Fixed

- Craft 4 support

## 1.3.4 - 2022-05-22

### Added

- PHP 8 support
- Craft 4 support

## 1.3.0 - 2021-06-05

### Added

- new `{% hook 'lightkeeper-raw' %}` hook injects the asset bundles JavaScript directly into the document

### Fixed

- `lightkeeper-anonymous.js` uses the same dependency versions

### Removed

- Lightkeeper anonymouse UUID dependency (switched to the native [Crypto API](https://caniuse.com/?search=crypto))

## 1.2.0 - 2021-06-05

### Fixed

- 3rd party library import statements no longer import explicit version (they now include the `^` character)

### Removed

- Lighthouse performance auditing widget ([Explainer](https://github.com/codewithkyle/craft-lightkeeper/issues/10))

## 1.1.2 - 2020-10-26

### Fixed

- composer 2 compatibility [#9](https://github.com/codewithkyle/craft-lightkeeper/issues/9)

## 1.1.1 - 2020-09-09

### Fixed

- web vitals are no longer logged on pages when using the Live Preview functionality [#7](https://github.com/codewithkyle/craft-lightkeeper/issues/7)
- performance emails check for the developers email address before sending

## 1.1.0 - 2020-08-04

### Added

- switched `{{ craft.lightkeeper.load() }}` to a template hook `{% hook 'lightkeeper' %}` [#4](https://github.com/codewithkyle/craft-lightkeeper/issues/4)
- Anonymous Users setting -- swaps IP collection with a UUID per session [#2](https://github.com/codewithkyle/craft-lightkeeper/issues/2)
- Compact setting -- decreases the size of the Lighthouse Audit widget [#3](https://github.com/codewithkyle/craft-lightkeeper/issues/3)

### Fixed 

- overflow issues in Performance Audits section

## 1.0.3 - 2020-07-28

### Fixed

- enables new CP section navigation link

## 1.0.2 - 2020-07-28

### Fixed

- reinstallation bug -- plugin couldn't be reinstalled after being uninstalled
- updated CP navigation link location

## 1.0.1 - 2020-07-18

### Fixed

- Lighthouse audits fail with a custom error message when testing local URLs

## 1.0.0 - 2020-07-17

### Added

- Lighthouse audit component
- Minimum required Lighthouse score settings
- Email notifications when poor performance is detected
- Web Vitals library injection
- Performance audit section
