<?php

declare(strict_types=1);

namespace Shimmie2;

use MicroHTML\HTMLElement;
use function MicroHTML\{A, ARTICLE, ASIDE, BODY, DIV, FOOTER, H1, HEADER, MAIN, NAV, rawHTML, SMALL, STYLE, TD, IMG};

class MittyPage extends Page
{

    // (Stolen from home/main.php)
    protected function getHomeLinks(): string {
        global $config;

        if (strlen($config->get_string('home_links', '')) > 0) {
            $main_links = $config->get_string('home_links');
        } else {
            $main_links = '[url=site://post/list]Posts[/url][url=site://comment/list]Comments[/url][url=site://tags]Tags[/url]';
            if (Extension::is_enabled(PoolsInfo::KEY)) {
                $main_links .= '[url=site://pool/list]Pools[/url]';
            }
            if (Extension::is_enabled(WikiInfo::KEY)) {
                $main_links .= '[url=site://wiki]Wiki[/url]';
            }
            $main_links .= '[url=site://ext_doc]Documentation[/url]';
        }

        return format_text($main_links);
    }

    protected function body_html(): HTMLElement
    {
        global $config;

        $site_name = $config->get_string(SetupConfig::TITLE);
        $data_href = get_base_href();
        $main_page = $config->get_string(SetupConfig::MAIN_PAGE);
        $front_page = $config->get_string(SetupConfig::FRONT_PAGE);

        $left_block_html = [];
        $main_block_html = [];
        $head_block_html = [];
        $sub_block_html = [];

        foreach ($this->blocks as $block) {
            switch ($block->section) {
                case "left":
                    $left_block_html[] = $this->block_html($block, true);
                    break;
                case "head":
                    $head_block_html[] = TD(["style" => "width: 250px;"], SMALL($this->block_html($block, false)));
                    break;
                case "main":
                    $main_block_html[] = $this->block_html($block, false);
                    break;
                case "subheading":
                    $sub_block_html[] = $block->body;
                    break;
                default:
                    print "<p>error: {$block->header} using an unknown section ({$block->section})";
                    break;
            }
        }

        $flash_html = $this->flash_html();
        $footer_html = $this->footer_html();

        return BODY(
            $this->body_attrs(),
            HEADER(
                DIV(["class" => "header-left",
                     "style" => "text-align: center;"],
                    H1(
                        A(["href" => "$data_href/$front_page"],
                            IMG(["src" => "/themes/Mitty/mittyLogo.png",
                                "alt" => "$site_name",
                                "height" => "200"])
                        )
                    ),
                    NAV(rawHTML($this->getHomeLinks()))
                ),
                DIV(
                    ["class" => "header-right"],
                    ...$head_block_html
                ),
                ...$sub_block_html
            ),
            MAIN(
                ASIDE(...$left_block_html),
                ARTICLE(
                    $flash_html,
                    ...$main_block_html
                )
            ),
            FOOTER($footer_html)
        );
    }
}
