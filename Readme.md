# Fuhgeddaboudit

**Contributors:** katzgrau  
**Tags:** seo, content, hide, search engine  
**Requires at least:** 4.0  
**Tested up to:** 5.8  
**Stable tag:** 1.1  
**License:** GPLv2 or later  
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html  

Hide content from search engines using a shortcode or a simple checkbox.

## Description

Fuhgeddaboudit is a simple plugin that allows you to control the visibility of your content to search engine crawlers. You can either hide specific parts of your content using a shortcode, or you can hide an entire page or post from search engines by serving them a 404 error page.

This is useful for content that you want to be available to your users but not indexed by search engines like Google, Bing, or DuckDuckGo.

## A Note on Journalistic Integrity

This plugin was created in light of the [criminal charges brought against Kenny Katzgrau and Brian Donohue of redbankgreen](https://freedom.press/issues/nj-reporters-face-unconstitutional-charges-for-refusing-to-unpublish-news/). A judge found probable cause that their refusal to remove records of an expunged assault charge from the news archives was in violation of a New Jersey
statute. The charges were fought and eventually dropped.



How can we balance the public's right to know with an individual's right to be forgotten, especially when old news is being used for harassment?

This plugin is an attempt to solve that problem. It allows journalists to preserve the integrity of their archives by keeping articles online and available, while also protecting individuals from having their worst moments follow them around forever on search engines.

## Installation

1.  Download the plugin as a ZIP file.
2.  In your WordPress admin panel, go to **Plugins > Add New**.
3.  Click on **Upload Plugin**.
4.  Choose the downloaded ZIP file and click **Install Now**.
5.  Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

There are two ways to use Fuhgeddaboudit:

### 1. Using the Shortcode

You can hide specific parts of your content by wrapping it in a `[fuhget]` or `[forget]` shortcode.

`[fuhget]This content will be hidden from search engines.[/fuhget]`

You can also use the `start` attribute to specify a date from which the content should be hidden from crawlers.

`[fuhget start="2025-01-01"]This content will be hidden from search engines starting from January 1, 2025.[/fuhget]`

### 2. Using the "Forget It" Checkbox

When you edit a post or a page, you will see a "Fuhgeddaboudit" box in the sidebar. Inside this box, there is a "Forget It" checkbox.

If you check this box, the entire page will be hidden from search engines. When a search engine crawler tries to access the page, it will be served a 404 "Not Found" error page, and no content will be shown. This will prevent the page from being indexed. Regular users will still be able to see the page normally.

## Changelog

### 1.1
* Added the "Forget It" checkbox feature to hide entire pages from search engines.

### 1.0
* Initial release with shortcode functionality.
# fuhgeddaboudit
