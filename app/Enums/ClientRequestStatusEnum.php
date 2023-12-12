<?php

namespace App\Enums;

enum ClientRequestStatusEnum: string
{
  case ACCEPTED = 'Accepted';
  case DENIED = 'Denied';
  case PENDING = 'Pending';

  public static function values(): array
  {
    return [
      self::ACCEPTED,
      self::DENIED,
      self::PENDING,
    ];
  }
}