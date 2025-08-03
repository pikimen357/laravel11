<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProfileResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'nama' => $this->name,
            'email' => $this->email,

            'telepon' => $this->whenLoaded('profile', function() {
                return $this->profile->phone ?? null;
            }),
            'alamat' => $this->whenLoaded('profile', function() {
                return $this->profile->address ?? null;
            }),

            // Or if you want to use ProfileResource:
//             'profile' => new ProfileResource($this->whenLoaded('profile')),
        ];
    }
}
