<?php

use Shimmie2\Block;
use Shimmie2\Ctx;
use Shimmie2\Extension;
use Shimmie2\PageRequestEvent;
use function MicroHTML\rawHTML;

class TermsOfService extends Extension {

    public function onPageRequest(PageRequestEvent $event) {
        if ($event->page_matches('terms')) {
            $event->stop_processing = true;

            $page = Ctx::$page;
            $page->set_title("Terms of Service");

            $html_content = $this->getTermsOfServiceHTML();

            $page->add_block(new Block(null, rawHTML($html_content)));
        }
    }

    private function getTermsOfServiceHTML(): string {
        return <<<HTML
<style>
    body { font-family: sans-serif; line-height: 1.6; max-width: 800px; margin: 40px auto; padding: 0 20px; color: #333; }
    h1, h2 { color: #222; border-bottom: 1px solid #eee; padding-bottom: 10px; }
    .container { background-color: #f9f9f9; padding: 20px; border-radius: 8px; }
    .notice { background-color: #fffbe6; border-left: 4px solid #ffc107; padding: 15px; margin-bottom: 20px; }
    ul { padding-left: 20px; }
    li { margin-bottom: 10px; }
</style>
<div class="container">
    <h1>Terms of Service for Mittybooru</h1>
    <p class="notice">
        <strong>In plain English:</strong> This is a small, non-commercial fan project run by a volunteer. These terms are here to keep the community safe and to meet our obligations under EU law (like the Digital Services Act). By using this site, you agree to these simple rules.
    </p>

    <h2>1. The Basics</h2>
    <p>
        Welcome to <strong>Mittybooru</strong>! This is a community for sharing and appreciating art. We provide the platform, and you provide the content. To make sure this remains a safe and creative space, we need you to follow these rules.
    </p>

    <h2>2. Content You Cannot Post</h2>
    <p>You are responsible for the content you upload. Do not post anything that is:</p>
    <ul>
        <li><strong>Illegal in the European Union.</strong> This is the most important rule. This includes, but is not limited to, child sexual abuse material (CSAM), non-consensual sharing of private images, terrorist content, and unlawful hate speech.</li>
        <li><strong>Hateful or Harassing.</strong> Content that attacks or demeans a group based on race, ethnicity, religion, disability, gender, age, or sexual orientation is not allowed.</li>
        <li><strong>Spam or Malicious.</strong> Do not post spam, phishing links, or malware.</li>
        <li><strong>In violation of Copyright.</strong> Please respect artists and only post content you have the right to share.</li>
    </ul>

    <h2>3. Reporting and Moderation (Our DSA Commitment)</h2>
    <p>
        We rely on you to help us keep the community safe.
    </p>
    <ul>
        <li><strong>Notice and Action:</strong> If you see content that violates these rules, please use the "Report" button. This is our official notice channel.</li>
        <li><strong>Our Review:</strong> Our volunteer team will review reports in a timely manner. We are not required to monitor everything proactively, but we are required to act on what is reported to us.</li>
        <li><strong>Transparency:</strong> If we remove your content because it was reported and found to be in violation of these terms, we will do our best to notify you of the decision and the reason for it.</li>
    </ul>

    <h2>4. Banning Users</h2>
    <p>
        Users who repeatedly or severely violate these terms may have their accounts suspended or permanently banned. We reserve the right to do this to protect the health of the community.
    </p>

    <h2>5. Disclaimer</h2>
    <p>
        This service is provided "as-is" without any warranties. As the site operator, we are a "hosting service" and are not legally liable for the content posted by users. We are only responsible for acting on notices of illegal content as described above.
    </p>

    <h2>6. Point of Contact</h2>
    <p>
        As required by the EU Digital Services Act, our single point of contact for users and authorities is:
        <br>
        <strong>[Your Contact Email]</strong>
    </p>

    <hr>
    <p><em>Last Updated: August 12, 2025</em></p>
</div>
HTML;
    }
}