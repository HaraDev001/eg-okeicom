<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonDetailResource extends JsonResource
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
            'id'                        => $this->id,
            'user_id'                   => $this->user_id,
            'course_id'                 => $this->course_id,
            'status'                    => $this->status,
            'number'                    => $this->number,
            'public'                    => $this->public,
            'type'                      => $this->type,
            'url'                       => $this->url,
            'slide'                     => $this->slide,
            'date'                      => $this->date,
            'start'                     => $this->start,
            'finish'                    => $this->finish,
            'price'                     => $this->price,
            'cancel_rate'               => $this->cancel_rate,
            'title'                     => $this->title,
            'finish'                    => $this->finish,
            'detail'                    => $this->detail,
            'created_at'                => $this->created_at,
            'updated_at'                => $this->updated_at,
            'deleted_at'                => $this->deleted_at,
            'lesson_course'             => $this->lessonCourse,
        ];
    }
}
