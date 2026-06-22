<?php

declare(strict_types=1);

namespace Shimmie2;

use MicroHTML\HTMLElement;

use function MicroHTML\{emptyHTML, rawHTML, A, BR, DIV, HR, INPUT, LABEL, OPTION, SELECT, SMALL, SPAN};

class MittyUploadTheme extends UploadTheme
{
    public function display_block(): void
    {
        Ctx::$page->add_block(new Block("Upload", $this->build_upload_block(), "head", 20));
    }

    public function display_full(): void
    {
        Ctx::$page->add_block(new Block("Upload", rawHTML("Disk nearly full, uploads disabled"), "head", 20));
    }

    protected function build_upload_block(): HTMLElement
    {
        $limits = get_upload_limits();

        $accept = $this->get_accept();

        $max_size = $limits['shm_filesize'];
        $max_kb = to_shorthand_int($max_size);
        $max_total_size = $limits['shm_post'];
        $max_total_kb = to_shorthand_int($max_total_size);

        // <input type='hidden' name='max_file_size' value='$max_size' />
        $form = SHM_FORM(make_link("upload"), multipart: true);
        $form->appendChild(
            emptyHTML(
                INPUT(["id" => "data[]", "name" => "data[]", "size" => "16", "type" => "file", "accept" => $accept, "multiple" => true]),
                rawHTML('<template id="dropHintTemplate">' .
                    LABEL(["for" => "data[]", "class" => "drop-hint"],
                        SPAN(["class" => "drop-text"],"Drop file(s) anywhere here or "),
                        A(["class" => "browse-link"], "browse"),
                    ) .
                '</template>'),

                INPUT(["name" => "tags", "type" => "text", "placeholder" => "tagme", "class" => "autocomplete_tags"]),
                INPUT(["name" => "source", "type" => "text", "placeholder" => "Source URL"]),
                SELECT(["name" => "rating"],
                    OPTION(["value" => "?", "selected" => true], "(Unrated)"),
                    OPTION(["value" => "s"], "Safe"),
                    OPTION(["value" => "q"], "Questionable"),
                    OPTION(["value" => "e"], "Explicit"),
                ),

                Captcha::get_html(UploadPermission::SKIP_UPLOAD_CAPTCHA),
                INPUT(["type" => "submit", "value" => "Post"]),
            )
        );

        return DIV(
            ["class" => 'mini_upload'],
            $form,
            SMALL(
                "(",
                $max_size > 0 ? "File limit $max_kb" : null,
                $max_size > 0 && $max_total_size > 0 ? " / " : null,
                $max_total_size > 0 ? "Total limit $max_total_kb" : null,
                ")",
            ),
            HR(),
            A(["href" => make_link("upload"), "class" => "upload-more-link"], "Upload multiple files »"),

        );
    }
}