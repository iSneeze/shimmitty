<?php

declare(strict_types=1);

namespace Shimmie2;

use MicroHTML\HTMLElement;
use function MicroHTML\{BODY, DIV, emptyHTML, IMG, INPUT, META, rawHTML, TITLE};

class MittyHomeTheme extends HomeTheme
{
    public function display_page(string $sitename, HTMLElement $body): void
    {
        $page = Ctx::$page;
        $page->set_mode(PageMode::DATA);
        $page->add_auto_html_headers();

        $page->set_data(
            new MimeType(MimeType::HTML . "; " . MimeType::CHARSET_UTF8),
            (string)$page->html_html(
                emptyHTML(
                    TITLE($sitename),
                    META(["http-equiv" => "Content-Type", "content" => "text/html;charset=utf-8"]),
                    META(["name" => "viewport", "content" => "width=device-width, initial-scale=1"]),
                    ...$page->get_all_html_headers(),
                ),
                $body
            )
        );
    }

    public function build_body(string $sitename, HTMLElement $main_links, ?string $main_text, ?string $contact_link, int $post_count): HTMLElement
    {
        $page = Ctx::$page;
        $page->set_layout("front-page");

        $main_links_html = empty($main_links) ? "" : "<div class='space' id='links'>$main_links</div>";
        $message_html = empty($main_text) ? "" : "<div class='space' id='message'>" . format_text($main_text) . "</div>";

        // Re-implement counter logic
        $counter_html = "";
        $counter_dir = Ctx::$config->get(HomeConfig::COUNTER);
        if ($counter_dir !== 'none' && $counter_dir !== 'text-only') {
            $base_href = Url::base();
            $counter_digits = [];
            foreach (str_split((string)$post_count) as $cur) {
                $counter_digits[] = "<img class='counter-img' alt='$cur' src='$base_href/ext/home/counters/$counter_dir/$cur.gif'>";
            }
            $counter_html = "<div class='space' id='counter'>" . implode('', $counter_digits) . "</div>";
        }
        
        $contact_html = empty($contact_link) ? "" : "<br><a href='$contact_link'>Contact</a> &ndash;";
        $num_comma = number_format($post_count);

        $search_html = "
                        <div class='space' id='search'>
                                <form action='".search_link()."' method='GET'>
                                <input name='search' size='30' type='search' value='' class='autocomplete_tags' autofocus='autofocus' />
                                <input type='hidden' name='q' value='post/list'>
                                <input type='submit' value='Search'/>
                                </form>
                        </div>
                ";

        return BODY(
            $page->body_attrs(),
            rawHTML("
                <div id='front-page'>
                        <h1><a style='text-decoration: none;' href='".make_link()."'><img src='/themes/Mitty/mittyLogo.png' alt='$sitename' height='200'/></a></h1>
                        $main_links_html
                        $search_html
                        $message_html
                        $counter_html
                        <div class='space' id='foot'>
                                <small><small>
                                $contact_html
                                " . (empty($num_comma) ? "" : " Serving $num_comma posts &ndash;") . "
                                Running <a href='https://code.shishnet.org/shimmie2/'>Shimmie2</a>
                                </small></small>
                        </div>
                </div>")
        );
    }
}