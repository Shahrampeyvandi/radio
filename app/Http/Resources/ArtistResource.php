<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->fullname,
            'photo' => $this->image('resize'),
            'role' => $this->role,
            'bio' => $this->bio,
            'birthday' => $this->birthday,
            'popular' => $this->popular,
            'followers' => count($this->followers)

        ];
    }
}
