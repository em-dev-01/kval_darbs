<?php

namespace App\Enums;

enum StatusEnum: string
{
  case STARTED = 'Started';
  case IN_PROGRESS = 'In progress';
  case FINISHED = 'Finished';

  public static function values(): array
  {
    return [
      self::STARTED,
      self::IN_PROGRESS,
      self::FINISHED,
    ];
  }
}
