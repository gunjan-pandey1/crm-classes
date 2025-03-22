<?php

namespace App\Constants;

class CommonConstant
{
    public const ERROR = 'error';

    public const SUCCESS = 'success';

    public const ERROR_MESSAGE_UPDATE_DATA = 'An error occurred while updating data.';

    public const ERROR_MESSAGE_INSERT_DATA = 'An error occurred while inserting data.';

    public const IS_DELETED_YES = 1;

    public const IS_DELETED_NO = 0;

    public const STATUS_ACTIVE = 1;

    public const STATUS_INACTIVE = 0;

    public const USER_ROLE_ADMIN = 'ADMIN';

    public const USER_ROLE_SUB_ADMIN = 'SUB_ADMIN';

    public const USER_ROLE_VENDOR = 'VENDOR';

    public const USER_ROLE_CHANNEL_PARTNER = 'CHANNEL_PARTNER';

    public const LOG_LEVEL_DEBUG = 'debug';

    public const LOG_LEVEL_INFO = 'info';

    public const LOG_LEVEL_NOTICE = 'notice';

    public const LOG_LEVEL_WARNING = 'warning';

    public const LOG_LEVEL_ERROR = 'error';

    public const LOG_LEVEL_CRITICAL = 'critical';

    public const LOG_LEVEL_ALERT = 'alert';

    public const LOG_LEVEL_EMERGENCY = 'emergency';

    public const REQUEST_TYPE_EXPORT = 'EXPORT';

    public const REQUEST_TYPE_COUNT = 'COUNT';

    public const REQUEST_TYPE_DATA = 'DATA';

    public const IS_SND_NO = 0;

    public const IS_SND_YES = 1;

    public const CURRENCY_ICON = ['INR' => '₹', 'USD' => '$', 'AUD' => 'A$', 'GBP' => '£', 'CAD' => 'C$', 'AED' => 'د.إ'];
}
