<?php
namespace App\Export;

use App\Models\Room;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class RoomExport implements FromQuery
{
    use Exportable;

    public function __construct($sn, $role)
    {
      $this->sn = $sn;
      $this->role = $role;

    }

    public function query()
    {
      if ($this->role == 'admin99'){
          $rooms = Room::with([
            'users',
            'messages' => function ($query) {
                $query->orderBy('created_at', 'asc');
            }
        ])
        ->orderBy('created_at', 'desc');;
      } else {
          $rooms = Room::with([
              'users',
              'messages' => function ($query) {
                  $query->orderBy('created_at', 'asc');
              }
          ])
          ->orderBy('created_at', 'desc')
          ->whereIn('service', $this->sn);
        }
        foreach ($rooms as $room) {
          $this->last_message[$room->id] = $room->messages->last() ? $room->messages->last()->message : '';
      }
      return $rooms;
    }

    public function headings(): array
    {
        return [
            'Room ID',
            'Service',
            'Status',
            'Score',
            'Code',
            'Created At',
            'Users',
            'Messages'
        ];
    }

    public function map($room): array
    {
        $last_message = isset($this->last_message[$room->id]) ? $this->last_message[$room->id] : '';
        return [
            $room->id,
            $room->service,
            $room->status,
            $room->score,
            $room->code,
            $room->created_at->format('Y-m-d H:i:s'),
            $room->users->implode('name', ', '),
            $last_message // 修改此處
        ];
    }
}
