<?php

namespace Shimmie2;

new UserClass("moderator", "user", [
	Permissions::DELETE_IMAGE => True,
	Permissions::DELETE_COMMENT => True,
	Permissions::BYPASS_COMMENT_CHECKS => True,
	Permissions::BAN_IP => True,
	Permissions::EDIT_USER_PASSWORD => True,
	Permissions::VIEW_HELLBANNED => True,
	Permissions::VIEW_IMAGE_REPORT => True,
    Permissions::APPROVE_IMAGE => True,
    Permissions::EDIT_IMAGE_RELATIONSHIPS => true,
    Permissions::REPLACE_IMAGE => true,
]);

new UserClass("user", "base", [
    Permissions::BIG_SEARCH => true,
    Permissions::CREATE_IMAGE => true,
    Permissions::CREATE_COMMENT => true,
    Permissions::EDIT_IMAGE_TAG => true,
    Permissions::EDIT_IMAGE_SOURCE => true,
    Permissions::EDIT_IMAGE_TITLE => true,
//  Permissions::EDIT_IMAGE_RELATIONSHIPS => true,
    Permissions::EDIT_IMAGE_ARTIST => true,
    Permissions::CREATE_IMAGE_REPORT => true,
//  Permissions::EDIT_IMAGE_RATING => true,
    Permissions::EDIT_FAVOURITES => true,
    Permissions::CREATE_VOTE => true,
    Permissions::SEND_PM => true,
    Permissions::READ_PM => true,
    Permissions::SET_PRIVATE_IMAGE => true,
    Permissions::PERFORM_BULK_ACTIONS => true,
    Permissions::BULK_DOWNLOAD => true,
    Permissions::CHANGE_USER_SETTING => true,
    Permissions::FORUM_CREATE => true,
    Permissions::NOTES_CREATE => true,
    Permissions::NOTES_EDIT => true,
    Permissions::NOTES_REQUEST => true,
    Permissions::POOLS_CREATE => true,
    Permissions::POOLS_UPDATE => true,
]);
