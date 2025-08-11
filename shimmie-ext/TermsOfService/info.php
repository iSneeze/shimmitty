<?php
declare(strict_types=1);

namespace Shimmie2;

final class TermsOfServiceInfo extends ExtensionInfo
{
    public const KEY = "TermsOfService";
    public string $name = "Terms of Service";
    public string $description = "Displays a Terms of Service page.";
    public string $author = "User";
    public ExtensionCategory $category = ExtensionCategory::GENERAL;
}