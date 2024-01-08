<?php

namespace App\Enums;

enum ClientRequestStatusEnum: string
{
  case ACCEPTED = 'Apstiprināts';
  case DENIED = 'Noraidīts';
  case PENDING = 'Gaida';

  public static function values(): array
  {
    return [
      self::ACCEPTED,
      self::DENIED,
      self::PENDING,
    ];
  }
}