# Session Planner for WordCamps

- Contributors: akirk
- Tags: events, schedule, conference, planner, notes
- Requires at least: 6.0
- Requires PHP: 7.4
- Tested up to: 7.1
- Stable tag: 1.0.0
- License: GPL-2.0-or-later
- License URI: https://www.gnu.org/licenses/gpl-2.0.html

Plan the WordCamp you are attending: save sessions from the schedule, follow a live timeline through your day, and export your notes.

## Description

Session Planner for WordCamps is a logged-in WordPress app for planning the community events you attend.

It can list upcoming events from the public WordCamp Central API, open the schedule for a selected event, and save the sessions you want to attend. The companion view focuses on the next practical step: arriving at the venue, walking to the right track, following saved sessions, and seeing day boundaries for multi-day events.

Saved sessions are stored as WordPress posts owned by the current user. Event metadata is stored in a taxonomy so a site can support multiple users and multiple planned events.

Features include:

- Upcoming event selection.
- A "Plan your day" schedule view with parallel tracks rendered as columns.
- A companion timeline that uses saved sessions and locally stored event metadata.
- Inline session adding between saved-session gaps.
- Session overlap warnings for competing tracks.
- Auto-saving session notes stored with saved sessions.
- Lightweight Markdown note controls for bold, italic, links, and lists.
- Rendered Markdown export preview with copy and download actions.
- Optional debug time controls for testing the live companion view.

You can try it out and use it in [my.wordpress.net](https://my.wordpress.net/?myapps-i=session-planner-for-wordcamps) at [https://my.wordpress.net/?myapps-i=session-planner-for-wordcamps](https://my.wordpress.net/?myapps-i=session-planner-for-wordcamps).

[Try it in WordPress Playground](https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/akirk/session-planner-for-wordcamps/main/blueprint.json)

[Try it in OpenStation](https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/akirk/session-planner-for-wordcamps/main/blueprint-openstation.json) — the same app opened in desktop mode with the [OpenStation](https://github.com/WordPress/openstation) plugin.

See [my blog post](https://alex.kirk.at/2026/06/03/wordcamp-companion/) for details and screenshots!

This plugin is an independent project. It is not affiliated with, endorsed by, or sponsored by the WordPress Foundation, and it only consumes the publicly available event APIs described below.

## Installation

1. Upload the plugin files to `/wp-content/plugins/session-planner-for-wordcamps/`.
2. Activate the plugin in WordPress.
3. Open the app from the app menu or visit `/session-planner-for-wordcamps/`.
4. Choose an upcoming event, mark it as attending, and start saving sessions.

## Frequently Asked Questions

### Where are saved sessions stored?

Saved sessions are stored as `wcc_session` posts authored by the current WordPress user. The selected event is stored as a term in the `wcc_wordcamp` taxonomy.

### Does the companion page load the full remote schedule?

No. The companion page is hydrated from locally stored event metadata and saved sessions. Full schedule and gap candidate data are loaded only when needed.

### Can multiple users use this on the same site?

Yes. Saved sessions are authored by user, and each user has their own selected and attending events.

### What happens when the plugin is uninstalled?

Uninstalling deletes saved sessions, event terms and metadata, plugin user settings, and cached API responses. Deactivating the plugin does not delete data.

### Which external services does this plugin contact?

See the "External Services" section below. In short: the public WordCamp Central event list, and the public REST API of the event site you select.

## External Services

This plugin uses public REST APIs to provide event and schedule data:

- `https://central.wordcamp.org/wp-json/wp/v2/wordcamps` is used to list upcoming events. See the [terms of use](https://wordpress.org/about/privacy/) and the [privacy policy](https://wordpress.org/about/privacy/).
- The selected event site's own REST API (a `*.wordcamp.org` host) is used to load schedule, speaker, track, and category data when planning a day.

These requests are made by your WordPress site and do not require API keys. The plugin sends the selected event URL and normal REST request parameters needed to fetch public schedule data. No personal data of your site's users is transmitted.

The companion view can also display links to Google Maps and OpenStreetMap for venue addresses. Those map services are opened only when a user clicks the map links; no request is made to them otherwise.

## Screenshots

1. The companion timeline with arrival, track changes, saved sessions, and day endings.

## Changelog

### 1.0.0

- Add the app with upcoming event selection, schedule planning, companion timeline, saved sessions, notes, and export.
- Add auto-saving session notes, lightweight Markdown editing controls, and a rendered Markdown export preview.

## Upgrade Notice

### 1.0.0

Initial release.
