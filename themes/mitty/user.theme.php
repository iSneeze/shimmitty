<?php

declare(strict_types=1);

namespace Shimmie2;

use function MicroHTML\rawHTML;

class MittyUserPageTheme extends UserPageTheme
{
    /**
     * @param array<array{link: string, name: string}> $parts
     */
    public function display_user_block(User $user, array $parts): void
    {
        $h_name = html_escape($user->name);
        $html = " | ";
        foreach ($parts as $part) {
            $html .= "<a href='{$part["link"]}'>{$part["name"]}</a> | ";
        }
        Ctx::$page->add_block(new Block("Logged in as $h_name", rawHTML($html), "head", 90));
    }

    public function display_login_block(): void
    {
        global $config;
        $html = "
			<form action='".make_link("user_admin/login")."' method='POST'>
			<table summary='Login Form' align='center'>
			<tr><td width='70'>Name</td><td width='70'><input type='text' name='user'></td></tr>
			<tr><td>Password</td><td><input type='password' name='pass'></td></tr>
			<tr><td colspan='2'><input type='submit' name='gobu' value='Log In'></td></tr>
			</table>
			</form>
		";
        if ($config->get("login_signup_enabled")) {
            $html .= "<small><a href='".make_link("user_admin/create")."'>Create Account</a></small>";
        }
        Ctx::$page->add_block(new Block("Login", rawHTML($html), "head", 90));
    }
}