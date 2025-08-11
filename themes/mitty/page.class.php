<?php

declare(strict_types=1);

namespace Shimmie2;

use MicroHTML\HTMLElement;
use function MicroHTML\{A, ARTICLE, ASIDE, BODY, DIV, FOOTER, H1, HEADER, IMG, MAIN, NAV, rawHTML, SMALL, TD, joinHTML};

class MittyPage extends Page
{
    protected function buildNavLinks(): HTMLElement
    {
        list($nav_links, $sub_links) = $this->get_nav_links();
        $links_html = [];
        foreach ($nav_links as $nav_link) {
            $links_html[] = A(["href" => $nav_link->link, "class" => $nav_link->active ? "current-page" : ""], $nav_link->description);
        }
        return joinHTML(" ", $links_html);
    }

    protected function body_html(): HTMLElement
    {
        global $config;

        $site_name = $config->get(SetupConfig::TITLE);
        $data_href = (string)Url::base();
        $main_page = $config->get(SetupConfig::MAIN_PAGE);
        $front_page = $config->get(SetupConfig::FRONT_PAGE);

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
                        A(["href" => make_link($front_page)],
                            IMG(["src" => "/themes/Mitty/mittyLogo.png",
                                "alt" => "$site_name",
                                "height" => "200"])
                        )
                    ),
                    NAV($this->buildNavLinks())
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