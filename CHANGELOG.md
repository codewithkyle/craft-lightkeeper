# Lightkeeper Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

[Unreleased]

### Added

- switched `{{ craft.lightkeeper.load() }}` to a template hook `{% hook 'lightkeeper' %}` [#4](https://github.com/codewithkyle/craft-lightkeeper/issues/4)
- Anonymous Users setting swaps IP collection with a UUID for the session [#2](https://github.com/codewithkyle/craft-lightkeeper/issues/2)

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