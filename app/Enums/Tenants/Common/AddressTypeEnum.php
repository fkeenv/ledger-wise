<?php

namespace App\Enums\Tenants\Common;

enum AddressTypeEnum: string
{
    case BILLING = 'billing';
    case SHIPPING = 'shipping';
    case BOTH = 'both';
}
