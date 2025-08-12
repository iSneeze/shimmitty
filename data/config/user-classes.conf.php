<?php

namespace Shimmie2;

new UserClass("anonymous", "base", [
    UserAccountsPermission::CREATE_USER => true,
    UserAccountsPermission::SKIP_LOGIN_CAPTCHA => true,
    ReportImagePermission::CREATE_IMAGE_REPORT => true, 
]);

new UserClass("moderator", "user", [
	ImagePermission::DELETE_IMAGE => true,
	CommentPermission::DELETE_COMMENT => true,
	CommentPermission::BYPASS_COMMENT_CHECKS => true,
	IPBanPermission::BAN_IP => true,
	UserAccountsPermission::EDIT_USER_PASSWORD => true,
    ReportImagePermission::VIEW_IMAGE_REPORT => true,
    ApprovalPermission::APPROVE_IMAGE => true,
    RelationshipsPermission::EDIT_IMAGE_RELATIONSHIPS => true,
    ReplaceFilePermission::REPLACE_IMAGE => true,
]);

new UserClass("user", "base", [
    IndexPermission::BIG_SEARCH => true,
    ImagePermission::CREATE_IMAGE => true,
    CommentPermission::CREATE_COMMENT => true,
    PostTagsPermission::EDIT_IMAGE_TAG => true,
    PostSourcePermission::EDIT_IMAGE_SOURCE => true,
    PostTitlesPermission::EDIT_IMAGE_TITLE => true,
    ArtistsPermission::EDIT_IMAGE_ARTIST => true,
    ReportImagePermission::CREATE_IMAGE_REPORT => true,
    FavouritesPermission::EDIT_FAVOURITES => true,
    NumericScorePermission::CREATE_VOTE => true,
    PrivMsgPermission::SEND_PM => true,
    PrivMsgPermission::READ_PM => true,
    PrivateImagePermission::SET_PRIVATE_IMAGE => true,
    BulkActionsPermission::PERFORM_BULK_ACTIONS => true,
    BulkDownloadPermission::BULK_DOWNLOAD => true,
    UserAccountsPermission::CHANGE_USER_SETTING => true,
    ForumPermission::FORUM_CREATE => true,
    NotesPermission::CREATE => true,
    NotesPermission::EDIT => true,
    NotesPermission::NOTES_REQUEST => true,
    PoolsPermission::CREATE => true,
    PoolsPermission::UPDATE => true,
]);